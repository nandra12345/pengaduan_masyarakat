<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /*
    |------------------------------------------------------------------
    | Konfigurasi Tabel & Primary Key
    |------------------------------------------------------------------
    */
    protected $table      = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    /*
    |------------------------------------------------------------------
    | Mass Assignable Attributes
    |------------------------------------------------------------------
    */
    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status',
    ];

    /*
    |------------------------------------------------------------------
    | Attribute Casting
    |------------------------------------------------------------------
    */
    protected function casts(): array
    {
        return [
            'tgl_pengaduan' => 'date',
            'status'        => 'string',
        ];
    }

    /*
    |------------------------------------------------------------------
    | Helper: Label status yang lebih ramah
    |------------------------------------------------------------------
    */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            '0'       => 'Menunggu',
            'proses'  => 'Diproses',
            'selesai' => 'Selesai',
            default   => 'Tidak Diketahui',
        };
    }

    /*
    |------------------------------------------------------------------
    | Helper: Warna badge Tailwind CSS berdasarkan status
    |------------------------------------------------------------------
    */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            '0'       => 'bg-yellow-100 text-yellow-800',
            'proses'  => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-green-100 text-green-800',
            default   => 'bg-gray-100 text-gray-800',
        };
    }

    /*
    |------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------
    */

    /**
     * Setiap pengaduan dimiliki oleh satu masyarakat.
     */
    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    /**
     * Satu pengaduan bisa memiliki banyak tanggapan.
     */
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Ambil tanggapan terbaru dari pengaduan ini.
     */
    public function latestTanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan')
                    ->latestOfMany('tgl_tanggapan');
    }
}
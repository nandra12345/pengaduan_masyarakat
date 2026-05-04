<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    /*
    |------------------------------------------------------------------
    | Konfigurasi Tabel & Primary Key
    |------------------------------------------------------------------
    */
    protected $table      = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';

    /*
    |------------------------------------------------------------------
    | Mass Assignable Attributes
    |------------------------------------------------------------------
    */
    protected $fillable = [
        'id_pengaduan',
        'tgl_tanggapan',
        'tanggapan',
        'id_petugas',
    ];

    /*
    |------------------------------------------------------------------
    | Attribute Casting
    |------------------------------------------------------------------
    */
    protected function casts(): array
    {
        return [
            'tgl_tanggapan' => 'date',
        ];
    }

    /*
    |------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------
    */

    /**
     * Setiap tanggapan merujuk ke satu pengaduan.
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Setiap tanggapan ditulis oleh satu petugas.
     */
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
}
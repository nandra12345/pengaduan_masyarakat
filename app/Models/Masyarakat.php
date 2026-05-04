<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |------------------------------------------------------------------
    | Konfigurasi Tabel & Primary Key
    |------------------------------------------------------------------
    */
    protected $table      = 'masyarakat';
    protected $primaryKey = 'nik';

    // Primary Key bukan integer (char 16)
    public $incrementing = false;
    protected $keyType   = 'string';

    /*
    |------------------------------------------------------------------
    | Mass Assignable Attributes
    |------------------------------------------------------------------
    */
    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp',
    ];

    /*
    |------------------------------------------------------------------
    | Hidden Attributes (tidak disertakan saat serialisasi)
    |------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |------------------------------------------------------------------
    | Attribute Casting
    |------------------------------------------------------------------
    */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /*
    |------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------
    */

    /**
     * Satu masyarakat bisa memiliki banyak pengaduan.
     */
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'nik', 'nik');
    }
}
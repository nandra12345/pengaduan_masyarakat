<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |------------------------------------------------------------------
    | Konfigurasi Tabel & Primary Key
    |------------------------------------------------------------------
    */
    protected $table      = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $incrementing  = true;
    protected $keyType    = 'int';

    /*
    |------------------------------------------------------------------
    | Mass Assignable Attributes
    |------------------------------------------------------------------
    */
    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp',
        'level',
    ];

    /*
    |------------------------------------------------------------------
    | Hidden Attributes
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
            'level'    => 'string',
        ];
    }

    /*
    |------------------------------------------------------------------
    | Helper Method: Cek apakah petugas adalah admin
    |------------------------------------------------------------------
    */
    public function isAdmin(): bool
    {
        return $this->level === 'admin';
    }

    /*
    |------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------
    */

    /**
     * Satu petugas bisa memberikan banyak tanggapan.
     */
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }
}
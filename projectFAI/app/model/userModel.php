<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    protected $connection= 'mysql';
    protected $primaryKey = 'id_akun';
    protected $table= 'user';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_akun',
        'nama_depan',
        'nama_belakang',
        'email',
        'username',
        'password',
        'alamat',
        'kota',
        'poin',
        'no_telp',
        'status'
    ];
}

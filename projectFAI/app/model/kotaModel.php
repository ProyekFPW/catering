<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class kotaModel extends Model
{
    protected $connection= 'mysql';
    protected $primaryKey = 'id_kota';
    protected $table= 'kota';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_kota',
        'nama_kota',
        'id_provinsi'
    ];
}

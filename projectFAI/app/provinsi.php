<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    protected $connection= 'mysql';
    protected $primaryKey = 'id_provinsi';
    protected $table= 'provinsi';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_provinsi',
        'nama_provinsi'
    ];
}

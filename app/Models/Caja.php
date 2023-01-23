<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = "caja";

    public $timestamps = false;

    protected $primaryKey = "id_caja";

    protected $fillable = ['id_caja','caja_name','caja_tipo','id_est','id_inst'];
}

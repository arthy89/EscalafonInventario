<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = "institucion";

    public $timestamps = false;

    protected $primaryKey = "id_inst";

    protected $fillable = ['id_inst','inst_cod_mod','inst_name','inst_lugar','id_tipo'];
}

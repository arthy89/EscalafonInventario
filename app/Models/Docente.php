<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Docente extends Model
{
    use HasFactory;

    protected $table = "docente";

    public $timestamps = false;

    protected $primaryKey = "id_dcnt";

    protected $fillable = ['dcnt_dni','dcnt_name','dcnt_apell1','dcnt_apell2','dcnt_cel','dcnt_email','id_car','id_est','id_ley','id_inst','id_caja','usuario','dcnt_fec_ces','dcnt_tip_ces','dcnt_rdr','dcnt_obs'];
}

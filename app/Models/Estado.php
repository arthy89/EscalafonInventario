<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = "estado";

    public $timestamps = false;

    protected $primaryKey = "id_est";

    protected $fillable = ['id_est','est_name'];
}

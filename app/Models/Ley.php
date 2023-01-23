<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ley extends Model
{
    use HasFactory;

    protected $table = "ley";

    public $timestamps = false;

    protected $primaryKey = "id_ley";

    protected $fillable = ['id_ley', 'ley_num','ley_name'];
}

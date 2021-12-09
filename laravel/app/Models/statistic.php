<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistic extends Model
{
    use HasFactory;
    protected $table = "statistic";
    public $timestamps = false;
    protected $primaryKey = "ID_Statistic";
}

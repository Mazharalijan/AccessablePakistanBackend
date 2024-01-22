<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locationtype extends Model
{
    use HasFactory;
    protected $table = "locationtype";
    protected $primaryKey = "LT_Id";
    protected $fillable = [
        'LT_Name'
    ];
}

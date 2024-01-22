<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disabilitytype extends Model
{
    use HasFactory;
    protected $table="disabilitytypes";
    protected $primaryKey = "disabilitytype_id";
    protected $fillable = [
        'disabilitytype'
    ];
}

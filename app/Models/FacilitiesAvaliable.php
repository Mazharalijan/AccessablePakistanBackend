<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesAvaliable extends Model
{
    use HasFactory;
    protected $table = "facilitiesavaliable";
    protected $primaryKey = "facilities_id";
    protected $fillable = [
        'facilities_title',
        'status',
        'rating',
        'fk_disabilitytype_id',
        'fk_address_id'
    ];
}

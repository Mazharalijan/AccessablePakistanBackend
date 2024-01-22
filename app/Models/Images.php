<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table="images";
    protected $primaryKey ="image_id";
    protected $fillable = [
        'image_file',
        'fk_address_id'
    ];
}

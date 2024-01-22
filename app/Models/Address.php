<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Disabilitytype;
use App\Models\FacilitiesAvaliable;
use App\Models\Images;
use App\Models\Locationtype;

class Address extends Model
{
    use HasFactory;
    protected $table = "addresses";
    protected $primaryKey = "address_id";
    protected $fillable =
    [
        'address_name',
        'address',
        'remarks',
        'lat',
        'lng',
        'fk_district_id',
        'fk_disabilitytype_id',
        'fk_LT_Id',
        'status'
    ];

    public function getDistrict(){
        return $this->hasOne(District::class, 'district_id','fk_district_id');
    }
    public function getDisabilityTypes(){
        return $this->hasOne(Disabilitytype::class, 'disabilitytype_id','fk_disabilitytype_id');
    }
    public function getLocationTypes(){
        return $this->hasOne(Locationtype::class, 'LT_Id','fk_LT_Id');
    }

    public function getFacilities()
        {
            return $this->hasMany(FacilitiesAvaliable::class, 'fk_address_id', 'address_id');
        }
        public function getImages()
        {
            return $this->hasMany(Images::class, 'fk_address_id', 'address_id');
        }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Images;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Image;
use App\Models\FacilitiesAvaliable;
use App\Models\Disabilitytype;
use App\Models\District;
use App\Models\Locationtype;
use Illuminate\Support\Facades\File;
class AddressController extends Controller
{
    //
    public function index(Request $request){

        $address =  $address = Address::with(['getDistrict','getDisabilityTypes','getFacilities','getImages','getLocationTypes']);
        if($request->get('keyword')){
            $address = $address->where('address_name','LIKE','%'.$request->get('keyword').'%');
        }

        $address = $address->paginate(10);
        $data = compact('address');
        return view('Admin.address')->with($data);
    }
    public function statusIndex($status,Request $request){

        $address =  $address = Address::with(['getDistrict','getDisabilityTypes','getFacilities','getImages','getLocationTypes'])->where('status',$status);
        if($request->get('keyword')){
            $address = $address->where('address_name','LIKE','%'.$request->get('keyword').'%');
        }

        $address = $address->paginate(10);
        $data = compact('address');
        return view('Admin.address')->with($data);
    }
    // searching address function
    public function search(Request $request){


            $name = $request->search;
            $district = $request->district;
            $disability= $request->disabilitytypeId;
            $locationtype= $request->locationtypeId;
            try{

                if(empty($request)){
                    $address = Address::with(['getDistrict','getDisabilityTypes','getFacilities','getImages','getLocationTypes'])->where('status','Active')->get();
                }else{


                $address = Address::with(['getDistrict','getDisabilityTypes','getFacilities','getImages','getLocationTypes'])->where('status','Active');
                if(!empty($name)){

                    $address = $address->where('address_name','LIKE',"%$name%");

                }
                if(!empty($district)){

                    $address = $address->where('fk_district_id','=',"$district");

                }
                if(!empty($disability)){
                    $address = $address->where('fk_disabilitytype_id','LIKE',"%$disability%");
                }
                if(!empty($locationtype)){
                    $address = $address->where('fk_LT_Id','LIKE',"%$locationtype%");
                }
                $address = $address->get();
            }

            if(!is_null($address)){
                //if record found
                return response()->json($address,200);
            }else{
                //if no record found
                return response()->json(['message'=> 'No record found!']);
            }

            }catch(\Exception $err){
                // error handling
                return response()->json(['message'=> 'Internal server error'],500);
            }

        // }
        // }
        // else{
        //     // if validation fails
        //     return response()->json(['message'=> $validator->messages()]);

        //     }



    }
    public function register(Request $request){
        // form validation
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'address' => 'required',
            'remarks' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'district' => 'required',
            'disabilitytype' => 'required',
            'locationtypeId' => 'required'
        ]);

        if($validator->passes()){
            //code here
            // address uploads section starts
            $adddata = [
                'address_name' => $request['name'],
                'address' => $request['address'],
                'remarks' => $request['remarks'],
                'lat' => $request['lat'],
                'lng' => $request['lng'],
                'fk_district_id' => $request['district'],
                'fk_disabilitytype_id' => $request['disabilitytype'],
                'fk_LT_Id' => $request['locationtypeId']
            ];

            DB::beginTransaction();
            try{
                $address = Address::create($adddata);
                //address uploads section ends

                // Avaliable facilities uploads section starts
                $data=[];
                if($request->EntranceAccessible){
                    $entrance_title = 'Entrance Accessible';
                    $entrance_status = $request->EntranceAccessible;
                    $entrance_rating = $request->EntranceAccessibleRating;
                    $data1 =[

                            'facilities_title'=>$entrance_title,
                            'status'=>$entrance_status,
                            'rating'=>$entrance_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id


                    ];
                    array_push($data,$data1);
                }
                if($request->FurnitureAccessible){
                    $furniture_title = 'Furniture Accessible';
                    $furniture_status = $request->FurnitureAccessible;
                    $furniture_rating = $request->FurnitureAccessibleRating;
                    $data2 =[

                            'facilities_title'=>$furniture_title,
                            'status'=>$furniture_status,
                            'rating'=>$furniture_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id


                    ];
                    array_push($data,$data2);
                }
                if($request->ParkingAccessible){
                    $parking_title = 'Parking Accessible';
                    $parking_status = $request->ParkingAccessible;
                    $parking_rating = $request->ParkingAccessibleRating;
                    $data3 =[

                            'facilities_title'=>$parking_title,
                            'status'=>$parking_status,
                            'rating'=>$parking_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id

                    ];
                    array_push($data,$data3);
                }
                if($request->ToiletsAccessible){
                    $toilets_title = 'Toilets Accessible';
                    $toilets_status = $request->ToiletsAccessible;
                    $toilets_rating = $request->ToiletsAccessibleRating;
                    $data4 =[
                            'facilities_title'=>$toilets_title,
                            'status'=>$toilets_status,
                            'rating'=>$toilets_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id

                    ];
                    array_push($data,$data4);
                }
                if($request->BasementAccessible){
                    $basement_title = 'Basement Accessible';
                    $basement_status = $request->BasementAccessible;
                    $basement_rating = $request->BasementAccessibleRating;
                    $data5 =[

                            'facilities_title'=>$basement_title,
                            'status'=>$basement_status,
                            'rating'=>$basement_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id

                    ];
                    array_push($data,$data5);
                }
                if($request->FloorsAccessible){
                    $floors_title = 'Floors Accessible';
                    $floors_status = $request->FloorsAccessible;
                    $floors_rating = $request->FloorsAccessibleRating;
                    $data6 =[

                            'facilities_title'=>$floors_title,
                            'status'=>$floors_status,
                            'rating'=>$floors_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id

                    ];
                    array_push($data,$data6);
                }
                if($request->SoundSystemAccessible){
                    $soundsystem_title = 'Sound System Accessible';
                    $soundsystem_status = $request->SoundSystemAccessible;
                    $soundsystem_rating = $request->SoundSystemAccessibleRating;
                    $data7 =[

                            'facilities_title'=>$soundsystem_title,
                            'status'=>$soundsystem_status,
                            'rating'=>$soundsystem_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id


                    ];
                    array_push($data,$data7);
                }
                if($request->BrailTrackAvailability){
                    $BrailTrack_title = 'Brail Track Availability';
                    $BrailTrack_status = $request->BrailTrackAvailability;
                    $BrailTrack_rating = $request->BrailTrackAvailabilityRating;
                    $data8 =[

                            'facilities_title'=>$BrailTrack_title,
                            'status'=>$BrailTrack_status,
                            'rating'=>$BrailTrack_rating,
                            'fk_disabilitytype_id'=>$request->disabilitytype,
                            'fk_address_id'=>$address->address_id


                    ];
                    array_push($data,$data8);
                }

                FacilitiesAvaliable::insert($data);
                // Avaliable uploads section ends
                // image upload section starts
                if ($request->hasFile('image')){
                    $images = [];
                        foreach($request->image as $key => $image)
                        {
                            $file = $request->file('image');
                            //give uniqe name to image
                            $filename = time().rand(1,99). '_' . $image->getClientOriginalName();

                            // test code for image resize
                            $new_image = Image::make($image->getRealPath());
                            if($new_image != null){
                                $image_width= $new_image->width();
                                $image_height= $new_image->height();
                                $new_width= 600;
                                $new_height= 400;

                                $new_image->resize($new_width, $new_height, function    ($constraint) {
                                    $constraint->aspectRatio();
                                });

                                $new_image->save(public_path('uploads/' .$filename));

                            }
                            // move image to uploads folder
                            //$image->move(public_path('uploads'), $filename);

                            //storing images in array
                            $images[]=[
                                'image_file' =>  $filename,
                                'fk_address_id' => $address->address_id
                            ];


                        }


                    }
                Images::insert($images);
                // image upload section end
                DB::commit();
                $resData =[
                    'data'=>$address,
                    'message'=>"Record Inserted Successfully!"
                ];
                $status=200;
            }catch(\Exception $err){
                DB::rollback();
                $resData=[
                    'message'=>'Record not inserted',
                    'error' =>throw $err
                ];
                $status = 501;
            }





            return response()->json($resData,$status);

        }else{
            return response()->json(['messge'=>$validator->messages()]);
        }

    }
    public function disabilitytype(){
        $disabilities = Disabilitytype::all();
        return $disabilities;
    }


    public function AdminAddressList(){
        return view('Admin.address');
    }
    public function destroy(string $id, Request $request){
        $address = Address::find($id);
        if(!is_null($address)){
            $FacilitiesAvaliable=FacilitiesAvaliable::where('fk_address_id',$address->address_id)->get();
            $faIds = [];
            foreach($FacilitiesAvaliable as $row){
                array_push($faIds,$row->facilities_id);
            }
            FacilitiesAvaliable::destroy($faIds);

            $image = Images::where('fk_address_id',$address->address_id)->get();
            $imgIds = [];
            foreach($image as $img){
                File::delete(public_path().'/uploads/'.$img->image_file);
                array_push($imgIds,$img->image_id);
            }
            Images::destroy($imgIds);
            $address->delete();

            $request->session()->flash('success','Address deleted successfully!');
            return redirect()->route('admin.addresslist');

        }else{
            $request->session()->flash('error','Address not found!');
            return redirect()->route('admin.addresslist');
        }
    }
    public function edit(string $id){
        $address = Address::find($id);
        if(!is_null($address)){
            $locationtype = Locationtype::orderBy('LT_Name','ASC')->get();
            $districts = District::orderBy('district','ASC')->get();

            $data = compact('address','locationtype','districts');

            return view('Admin.address_edit')->with($data);
        }else{
            $request->session()->flash('error','Address not found!');
            return redirect()->route('admin.addresslist');
        }

    }
    public function update(string $id, Request $request){

        $address = Address::find($id);

        if(!is_null($address)){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'district' => 'required',
                'status' => 'required',
                'locationtype' => 'required'
            ]);


            if($validator->passes()){
                $data = [
                    'address_name' => $request->name,
                    'address' => $request->address,
                    'fk_district_id' => $request->district,
                    'fk_LT_Id' => $request->locationtype,
                    'status' => $request->status
                ];

                $address = $address->update($data);
                if($address){
                    $request->session()->flash('success','Address updated successfully!');
                    return redirect()->route('admin.addresslist');
                }else{
                    $request->session()->flash('error','Address not updated!');
                    return redirect()->route('admin.addresslist');
                }

            }else{


                return redirect()->back()->withErrors($validator->errors())->withInput();

            }


        }else{
            $request->session()->flash('error','Address not found!');
            return redirect()->route('admin.addresslist');
        }
    }
    public function totalAddressCount(){

        $totaladdress = Address::get()->count();
        $activeaddress = Address::where('status','Active')->get()->count();
        $inactiveaddress = Address::where('status','In-Active')->get()->count();
        return response()->json(['total'=>$totaladdress,'active'=>$activeaddress,'inactive'=>$inactiveaddress]);
    }

}

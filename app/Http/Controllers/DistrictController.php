<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    //
    public function index(){
        $district = District::all();
        if(!is_null($district)){
            return $district;
        }else{

            return response()->json(['message' => 'No record found!'],200);

        }
    }
    public function districtList(Request $request){
        if($request->get('keyword')){
            $district = District::where('district','LIKE','%'.$request->get('keyword').'%')->paginate(10);
        }else{
            $district = District::paginate(10);
        }

            $data = compact('district');
            return view("Admin.district")->with($data);

    }
    public function create(){
      return view('Admin.district_create');
    }
    public function store(Request $request){

       $validator = Validator::make($request->all(),[
        'name' => 'required|unique:districts,district'
       ]);
       if($validator->passes()){

        $data = ['district'=>$request->name];
        $district = District::create($data);
        if($district){

            $request->session()->flash('success', 'District created successfully!');
            return redirect()->route('admin.districtlist');
        }else{
            $request->session()->flash('error', 'District not created!');
            return redirect()->route('admin.districtlist');
        }

       }else{
        return redirect()->route('district.create')->withErrors($validator)->withInput();

       }


    }
    public function edit(string $id){
        $district = District::find($id);
        if(!is_null($district)){
            $data = compact('district');
            return view('Admin.district_edit')->with($data);

        }else{
            $request->session()->flash('error', 'District not found!');
            return redirect()->route('admin.districtlist');
        }
    }
    public function update(string $id, Request $request){
        $district = District::find($id);
        if(!is_null($district)){

            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:districts,district,' . $district->district_id .',district_id'
               ]);
               if($validator->passes()){

                $data = ['district'=>$request->name];
                $district = $district->update($data);
                if($district){

                    $request->session()->flash('success', 'District updated successfully!');
                    return redirect()->route('admin.districtlist');
                }else{
                    $request->session()->flash('error', 'District not updated!');
                    return redirect()->route('admin.districtlist');
                }

               }else{
                return redirect()->route('district.create')->withErrors($validator)->withInput();

               }

        }else{
            $request->session()->flash('error', 'District not found!');
            return redirect()->route('admin.districtlist');
        }
    }
    public function destroy(string $id, Request $request){
        $district = District::find($id);
        if($district){
            $district->delete();
            $request->session()->flash('success','District deleted successfully!');
            return redirect()->route('admin.districtlist');
        }else{
            $request->session()->flash('error','District not deleted!');
            return redirect()->route('admin.districtlist');
        }
    }
}

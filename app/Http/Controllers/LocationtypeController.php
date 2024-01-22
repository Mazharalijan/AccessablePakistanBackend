<?php

namespace App\Http\Controllers;

use App\Models\Locationtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationtypeController extends Controller
{
    public function index()
    {
        $locationtype = Locationtype::all();
        if (! is_null($locationtype)) {
            return response()->json($locationtype);

        } else {
            return response()->json(['message' => 'No record found!']);
        }
    }

    public function locationList(Request $request)
    {
        if ($request->get('keyword')) {
            $locationtype = Locationtype::where('LT_Name', 'LIKE', '%'.$request->get('keyword').'%')->paginate(10);
        } else {
            $locationtype = Locationtype::paginate(10);
        }

        $data = compact('locationtype');

        return view('Admin.locationtype')->with($data);
    }

    public function create()
    {
        return view('Admin.locationtype_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:locationtype,LT_Name',
        ]);
        if ($validator->passes()) {
            $data = [
                'LT_Name' => $request->name,

            ];
            Locationtype::create($data);

            $request->session()->flash('success', 'Location type created!');

            return redirect()->route('admin.location-type');
        } else {
            $request->session()->flash('error', 'Location type not created!');
            //change route

            return redirect()->route('location-type.create')->withErrors($validator)->withInput();
        }

    }

    public function edit(string $id)
    {
        $locationtype = Locationtype::find($id);
        if (! is_null($locationtype)) {
            $data = compact('locationtype');

            return view('Admin.locationtype_edit')->with($data);
        } else {
            $request->session()->flash('error', 'Location type not found!');

            return redirect()->route('admin.location-type');
        }
    }

    public function update(string $id, Request $request)
    {
        $locationtype = Locationtype::find($id);
        if (! is_null($locationtype)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:locationtype,LT_Name,'.$locationtype->LT_Id.',LT_Id',
            ]);
            if ($validator->passes()) {
                $data = [
                    'LT_Name' => $request->name,

                ];
                $locationtype = $locationtype->update($data);
                if ($locationtype) {
                    $request->session()->flash('success', 'Location type updated successfully!');

                    return redirect()->route('admin.location-type');
                } else {
                    $request->session()->flash('error', 'Location type not updated!');

                    return redirect()->route('admin.location-type');
                }

            } else {

                return redirect()->route('location-type.create')->withErrors($validator)->withInput();
            }

        } else {
            $request->session()->flash('error', 'Location type not found!');

            return redirect()->route('admin.location-type');
        }
    }

    public function destroy(string $id, Request $request)
    {

        $locationtype = Locationtype::find($id);
        if ($locationtype) {
            $locationtype->delete();
            $request->session()->flash('success', 'Location type deleted successfully!');

            return redirect()->route('admin.location-type');
        } else {
            $request->session()->flash('error', 'Location type not deleted!');

            return redirect()->route('admin.location-type');
        }
    }
}

@extends('Admin.layout')
@section('content')

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Address</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.addresslist') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('address.update',$address->address_id) }}" method="post">
            @csrf
            @method('put')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name',$address->address_name) }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="30" placeholder="Address" class="form-control @error('address') is-invalid @enderror" rows="4">{{ old('address',$address->address) }}</textarea>
                            @error('address')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="district">District</label>
                            <select name="district" id="district" class="form-control @error('district') is-invalid @enderror">
                                <option value="">Select District</option>
                                @isset($districts)
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->district_id }}" {{ $item->district_id == old('district',$address->fk_district_id) ? 'selected' : ''}}>{{ $item->district }}</option>
                                    @endforeach
                                @endisset

                            </select>
                            @error('district')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="locationtype">Location Type</label>
                            <select name="locationtype" id="locationtype" class="form-control @error('locationtype') is-invalid @enderror">
                                <option value="">Select Location Type</option>
                                @isset($locationtype)
                                    @foreach ($locationtype as $item)
                                        <option value="{{ $item->LT_Id }}" {{ $item->LT_Id == old('locationtype',$address->fk_LT_Id)  ? 'selected' : ''}} >{{ $item->LT_Name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('locationtype')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Active" {{  old('status',$address->status) == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="In-Active" {{ old('status',$address->status) == 'In-Active' ? 'selected' : ''}}>In-Active</option>
                            </select>
                            @error('status')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.addresslist') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>

@endsection
@section('customJS')

@endsection

@extends('Admin.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>District</h1>
            </div>
             <div class="col-sm-6 text-right">
                <a href="{{ route('district.create') }}" class="btn btn-primary">New District</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    @include("Admin.message")
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin.districtlist') }}" method="get">
            <div class="card-header">
                @if(Request::get('keyword'))
                <div class="card-title">
                    <button type="button" onclick="window.location.href='{{ route("admin.districtlist") }}'" class="btn btn-default btn-sm">Reset Search</button>
                </div>
                @endif

                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>

            </div>
        </form>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($district->isNotEmpty())
                        @php

                           $page= $district->currentPage();
                           $perPage = $district->perPage();
                           $lastitem= $district->lastItem();
                           if($page > 1){
                            $a = $lastitem - $perPage;
                           }else{
                            $a='';
                           }

                        @endphp
                            @foreach ($district as $item)
                            @php
                                $a++;
                            @endphp

                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{ $item->district }}</td>
                            <td>
                                <a href="{{ route('district.edit',$item->district_id) }}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="#" onclick="deleteDistrict('{{ $item->district_id }}')" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                      </svg>
                                </a>
                            </td>
                        <form action="{{ route('district.delete',$item->district_id) }}" method="post" id="delete-district-{{ $item->district_id }}">
                            @csrf
                            @method('delete')
                        </form>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">Record not Exist!</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{--  <ul class="pagination pagination m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>  --}}
                {{ $district->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection

@section('customJS')
<script>
    function deleteDistrict(id){
        if(confirm('Are you sure to delete District?')){
        document.getElementById('delete-district-'+id).submit();
        }
    }
</script>
@endsection

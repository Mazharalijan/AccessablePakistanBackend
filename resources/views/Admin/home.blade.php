@extends('Admin.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3 id="total-address"></h3>
                        <p>Total Locations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.addresslist') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3 id="active-location"></h3>
                        <p>Active Locations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.addressstatus','Active') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3 id="pending-location"></h3>
                        <p>Pending Locations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.addressstatus','In-Active') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection

@section('customJS')
<script>
    var count = 1;
    setTimeout(function(){
        function test(){

            $.ajax({
                url:'{{ route("counts") }}',
                type: 'get',
                datatype:'JSON',
                success: function(res){
                    $("#total-address").html(res.total);
                    $("#active-location").html(res.active);
                    $("#pending-location").html(res.inactive);
                    //console.log(res);
                }

            });

            setTimeout(function(){
                test();
            },3000)
        }
        test();
     }, 0)
    {{--  $(document).ready(function(){
        $.ajax({
            url:'{{ route("counts") }}',
            type: 'get',
            datatype:'JSON',
            success: function(res){
                //$("#total-address").html(res.total);
                $("#active-location").html(res.active);
                $("#pending-location").html(res.inactive);
                //console.log(res);
            }

        });
    });  --}}
</script>
@endsection

@extends("Admin.layout")
@section("content")


    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-4">
                <div class="card card-outline card-primary mt-4">
                    <div class="card-header">
                        <h4>Change Passwod</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="form-group mb3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info">Update</button>
                        <a href="{{ route("admin.dashboard") }}">
                            <button class="btn btn-danger">Cancel</button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section("customJS")

@endsection

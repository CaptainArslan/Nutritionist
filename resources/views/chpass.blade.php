@extends('container')
@section('title','Change Password | Nutritionist')
@section('content-body')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Change Password</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('chpass')}}" method="POST">
                    @csrf
                    <input type="hidden" placeholder="Old Current" name="id" class="form-control" value="{{session('user_id')}}">

                    <div class="form-row align-items-center">
                        <div class="form-group col-md-3">
                            <input type="text" placeholder="Old Current" name="old" class="form-control" value="">
                            <span class="text-danger">@error('old'){{$message}} @enderror</span>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" placeholder="New Password" name="new" class="form-control" value="">
                            <span class="text-danger">@error('old'){{$message}} @enderror</span>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" placeholder="Current Password" name="confirm" class="form-control" value="">
                            <span class="text-danger">@error('old'){{$message}} @enderror</span>
                        </div>
                        <div class="form-group col-lg-3">
                            <button type="submit" class="btn btn-primary " name="submit" value="change">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#date').change(function() {
        var now = new Date(); //Current Date
        var past = new Date($('#date').val()); //Date of Birth
        if (past > now) {
            $('#tdate').text('Entered Date is not Greater than Current Date');
            return false;
        }
        var nowYear = now.getFullYear(); //Get current year
        var pastYear = past.getFullYear(); //Get Date of Birth year
        var age = nowYear - pastYear; //calculate the difference
        $('#user_age').val(age);
    })
</script>

@endsection
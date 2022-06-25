@extends('container')
@section('title','User Profile | Nutritionist')
@section('content-body')

<div class="container-fluid">

    @if(sizeof($admin) > 0)
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ucwords($admin[0]->name)}}, Welcome back!</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo"></div>
                        <div class="profile-photo">
                            <img src="images/profile/profile.png" class="img-fluid rounded-circle" alt="">
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 border-right-1 prf-col">
                                        <div class="profile-name">
                                            <h4 class="text-primary">{{ucwords($admin[0]->name)}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 border-right-1 prf-col">
                                        <div class="profile-email">
                                            <h4 class="text-muted">{{$admin[0]->email}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">About Me</a></li>
                                <li class="nav-item"><a href="#profile-settings " data-toggle="tab" class="nav-link">Setting</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- About me -->
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4 mt-4">Personal Information</h4>
                                        <div class="row">
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Name:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->name == '')
                                                        {{"Not Added"}}
                                                        @else
                                                        {{$admin[0]->name}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Email:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->email == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->email}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Age:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->age == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->age}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Experience:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->experience == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->experience}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Basal Metabollic Rate:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->bmr == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->bmr}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Body Mass Index:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->bmi == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->bmi}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Calories Needed Per Day:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->cpd == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->cpd}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Location:</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        @if($admin[0]->address == '')
                                                        {{"not Added Yet"}}
                                                        @else
                                                        {{$admin[0]->address}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-4">
                                            <h4 class="text-primary">About Me</h4>
                                            <p>
                                                @if($admin[0]->about == '')
                                                {{"Not Added yet"}}
                                                @else
                                                {{$admin[0]->about}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile settings -->
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Account Setting</h4>
                                            <form action="{{route('profile')}}" method="POST">
                                                @csrf
                                                <div class="form-row">
                                                    <input type="hidden" name="id" id="id" value="{{$admin[0]->id}}">
                                                    <div class="form-group col-md-3">
                                                        <h5>Name:</h5>
                                                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{$admin[0]->name}}">
                                                        <span class="text-danger">@error('name'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <h5>Email:</h5>
                                                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{$admin[0]->email}}">
                                                        <span class="text-danger">@error('email'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <h5>DOB:</h5>
                                                        <input type="date" name="date" id="date" placeholder="must be between greater than 10" class="form-control" value="{{$admin[0]->dob}}">
                                                        <span class="text-danger" id="tdate">@error('date'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <h5>Age.</h5>
                                                        <input type="text" name="yage" id="user_age" placeholder="Age" class="form-control" value="{{$admin[0]->age}}" readonly>
                                                        <span class="text-danger" id="yage">@error('yage'){{$message}} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <h5>Height:</h5>
                                                        <input type="number" id="height" name="height" placeholder="height in cm" class="form-control" value="{{$admin[0]->height}}">
                                                        <span class="text-danger">@error('height'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <h5>Weight:</h5>
                                                        <input type="number" id="weight" name="weight" placeholder="In Kg" class="form-control" value="{{$admin[0]->weight}}">
                                                        <span class="text-danger">@error('weight'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        @php
                                                        $s = $la = $m = $a = $va = '';
                                                        if($admin[0]->level != ''){
                                                        if($admin[0]->level == 'S'){
                                                        $s='selected';
                                                        }
                                                        else if($admin[0]->level == 'LA'){
                                                        $la='selected';
                                                        }
                                                        else if($admin[0]->level == 'M'){
                                                        $m='selected';
                                                        }
                                                        else if($admin[0]->level == 'A'){
                                                        $a='selected';
                                                        }
                                                        else if($admin[0]->level == 'VA'){
                                                        $va='selected';
                                                        }
                                                        }
                                                        @endphp
                                                        <h5>Activity Level:</h5>
                                                        <select class="form-control" name="level" id="activity_level" value="{{old('level')}}">
                                                            <option value="">Select</option>
                                                            <option value="S" {{$s}}>Sedentary (No Exercise)</option>
                                                            <option value="LA" {{$la}}>Light (Low Exercise)</option>
                                                            <option value="M" {{$m}}>Moderately (Normal Exercise)</option>
                                                            <option value="A" {{$a}}>Active (hard Exercise)</option>
                                                            <option value="VA" {{$va}}>Very Active (Extra Hard Exercise)</option>
                                                        </select>
                                                        <span class="text-danger">@error('level'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-3 ">
                                                        @php
                                                        $male = '';
                                                        $female = '';
                                                        if($admin[0]->gender != '' && $admin[0]->gender == 'male')
                                                        {
                                                        $male = 'checked';
                                                        }
                                                        else if($admin[0]->gender != '' && $admin[0]->gender == 'female')
                                                        {
                                                        $female = 'checked';
                                                        }
                                                        @endphp

                                                        <h5>Select Gender: </h5>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="gender" id="male" class="form-check-input" value="male" {{$male}}> Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="gender" id="female" class="form-check-input" value="female" {{$female}}> female
                                                            </label>
                                                        </div>
                                                        <span class="text-danger">@error('gender'){{$message}} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <h5>Experience:</h5>
                                                        <input type="number" id="experience" name="experience" placeholder="In years" class="form-control" value="{{$admin[0]->experience}}">
                                                        <span class="text-danger">@error('experience'){{$message}} @enderror</span>
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <h5>About or Bio:</h5>
                                                        <textarea name="about" id="about" class="form-control " placeholder="I'm web developer" rows="1">{{$admin[0]->about}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h5>Address:</h5>
                                                        <textarea name="address" id="address" class="form-control " placeholder="1234 Main St" rows="2">{{$admin[0]->address}} </textarea>
                                                    </div>
                                                </div>
                                                <center>
                                                    <button type="submit" class="btn btn-primary" name="update_profile" value="update">Update Profile</button>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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
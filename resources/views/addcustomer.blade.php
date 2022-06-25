@extends('container')
@section('title','Customers')
@section('content-body')
<script>
    function checkboxselect() {
        var selectall = document.getElementById("allcheckbox");
        if (selectall.checked == true) {
            var ele = document.getElementsByName('delete_chk[]');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
            }
        } else {
            var ele = document.getElementsByName('delete_chk[]');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = false;
            }
        }
    }
</script>
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                <span class="ml-1">Element</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
            </ol>
        </div>
    </div>

    <!-- row form card-->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Customer</h4>
                </div>
                <div class="card-body">
                    <div id="profile-settings" class="">
                        <div class="pt-3">
                            <div class="settings-form">
                                <form action="{{route('add_customer')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Username:</h5>
                                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{old('name')}}">
                                            <span class="text-danger">@error('name'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <h5>Email:</h5>
                                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{old('email')}}">
                                            <span class="text-danger">@error('email'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <h5>Password:</h5>
                                            <input type="password" name="password" id="password" placeholder="password" class="form-control" value="123">
                                            <span class="text-danger">@error('password'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <h5>DOB:</h5>
                                            <input type="date" name="date" id="date" placeholder="must be between greater than 10" class="form-control" value="{{old('date')}}">
                                            <span class="text-danger" id="tdate">@error('date'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <h5>Age.</h5>
                                            <input type="text" name="yage" id="user_age" placeholder="Age" class="form-control" value="{{old('yage')}}" readonly>
                                            <span class="text-danger" id="yage">@error('yage'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Height:</h5>
                                            <input type="number" id="height" name="height" placeholder="height in cm" class="form-control" value="{{old('height')}}">
                                            <span class="text-danger">@error('height'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <h5>Weight:</h5>
                                            <input type="number" id="weight" name="weight" placeholder="In Kg" class="form-control" value="{{old('weight')}}">
                                            <span class="text-danger">@error('weight'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <h5>Select Gender: </h5>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" id="male" class="form-check-input" value="male" @if(old( 'gender' )=='male' ) checked @endif>Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" id="female" class="form-check-input" value="female" @if(old( 'gender' )=='female' ) checked @endif>female
                                                </label>
                                            </div>
                                            <span class="text-danger">@error('gender'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <h5>Status:</h5>
                                            <select class="form-control" id="status" name="status" value="{{old('status')}}">
                                                <option value="a">Active</option>
                                                <option value="d">Deactive</option>
                                            </select>
                                            <span class="text-danger">@error('status'){{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <h5>Activity Level:</h5>
                                            <select class="form-control" name="level" id="activity_level" value="{{old('level')}}">
                                                <option value="">Select</option>
                                                <option value="S" {{ old('level') == 'S' ? 'selected' : '' }}>Sedentary (No Exercise)</option>
                                                <option value="LA" {{ old('level') == 'LA' ? 'selected' : '' }}>Light (Low Exercise)</option>
                                                <option value="M" {{ old('level') == 'M' ? 'selected' : '' }}>Moderately (Normal Exercise)</option>
                                                <option value="A" {{ old('level') == 'A' ? 'selected' : '' }}>Active (hard Exercise)</option>
                                                <option value="VA" {{ old('level') == 'VA' ? 'selected' : '' }}>Very Active (Extra Hard Exercise)</option>
                                            </select>
                                            <span class="text-danger">@error('level'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h5>Address:</h5>
                                            <textarea name="address" id="" class="form-control " placeholder="1234 Main St" value="{{old('serving')}}"></textarea>
                                        </div>

                                    </div>
                                    <center>
                                        <button class="btn btn-primary" id="" type="submit" value="add" name="addcustomer">Add Customer</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Customer Data tables -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Latest Customers</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        @if( sizeof($customer) > 0 )

                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <!-- <td>
                                        <input type="checkbox" id="allcheckbox" onclick="checkboxselect()">
                                    </td> -->
                                    <td>*</td>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Age</th>
                                    <th>Created Date</th>
                                    <!-- <td></td> -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sr = 1; @endphp
                                @foreach($customer as $row)
                                <tr>
                                    <!-- <td>
                                        <input type="checkbox" name="delete_chk[]">
                                    </td> -->
                                    <td>{{$sr}}</td>
                                    <!-- <td>
                                        <div class="round-img">
                                            <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                        </div>
                                    </td> -->
                                    @php
                                    if($row->status == 'a')
                                    $status = 'Active';
                                    else if($row->status == 'd')
                                    $status = 'Deactive';
                                    @endphp
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->role}}</td>
                                    <td>{{$row->age}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <!-- <td>{{$row->status}}</td> -->
                                    <td>
                                        {{$status}}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary get_customer" id="{{$row->id}}" value="{{$row->id}}" data-toggle="modal" data-target="#customerdetail">
                                            Manage
                                        </button>
                                    </td>
                                </tr>
                                @php $sr++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        No Customer Found
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table Ended -->
</div>
<!-- Modal -->
<div class="modal fade" id="customerdetail" tabindex="-1" role="dialog" aria-labelledby="customerdetailTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form action="{{route('add_customer')}}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @csrf
                        <input type="hidden" name="id" id="mhidden" value="">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <h5>Name:</h5>
                                <input type="text" name="mname" id="mname" placeholder="Name" class="form-control" value="{{old('name')}}">
                                <span class="text-danger" id="nameErr">@error('mname'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Email:</h5>
                                <input type="email" name="memail" id="memail" placeholder="Email" class="form-control" value="{{old('email')}}">
                                <span class="text-danger" id="emailErr">@error('memail'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Password:</h5>
                                <input type="password" name="mpassword" id="mpass" placeholder="password" class="form-control" readonly value="123">
                                <span class="text-danger" id="passErr">@error('mpassword'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-2">
                                <h5>DOB:</h5>
                                <input type="date" name="mdate" id="mdate" placeholder="must be between greater than 10" class="form-control" value="{{old('date')}}">
                                <span class="text-danger" id="dateErr">@error('mdate'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-1">
                                <h5>Age.</h5>
                                <input type="text" name="myage" id="myage" placeholder="Age" class="form-control" value="{{old('yage')}}" readonly>
                                <span class="text-danger" id="yageErr">@error('myage'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <h5>Height:</h5>
                                <input type="number" id="mheight" name="mheight" placeholder="height in cm" class="form-control" value="{{old('height')}}">
                                <span class="text-danger" id="heightErr">@error('mheight'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Weight:</h5>
                                <input type="number" id="mweight" name="mweight" placeholder="Weight In Kg" class="form-control" value="{{old('weight')}}">
                                <span class="text-danger" id="weightErr">@error('mweight'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3 ">
                                <h5>Select Gender: </h5>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="mgender" id="mmale" class="form-check-input" value="male">Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="mgender" id="mfemale" class="form-check-input" value="female">female
                                    </label>
                                </div>
                                <span class="text-danger" id="genderErr">@error('mgender'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3 ">
                                <h5>Status:</h5>
                                <select class="form-control" name="mstatus" id="mstatus" value="{{old('status')}}">
                                    <option value="a">Active</option>
                                    <option value="d">Deactive</option>
                                </select>
                                <span class="text-danger" id="statusErr">@error('mstatus'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <h5>Activity Level:</h5>
                                <select class="form-control" name="mlevel" id="mactivity_level" value="{{old('level')}}">
                                    <option value="">Select</option>
                                    <option value="S" id="S">Sedentary (No Exercise)</option>
                                    <option value="LA" id="LA">Light (Low Exercise)</option>
                                    <option value="M" id="M">Moderately (Normal Exercise)</option>
                                    <option value="A" id="A">Active (hard Exercise)</option>
                                    <option value="VA" id="VA">Very Active (Extra Hard Exercise)</option>
                                </select>
                                <span class="text-danger" id="levelErr">@error('mlevel'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>BMR:</h5>
                                <input type="number" name="mbmr" id="mbmr" placeholder="bmr" class="form-control" value="{{old('bmr')}}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>BMI:</h5>
                                <input type="number" name="mbmi" id="mbmi" placeholder="bmi" class="form-control" value="{{old('bmi')}}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>CPD:</h5>
                                <input type="number" name="mcpd" id="mcpd" placeholder="cpd" class="form-control" value="{{old('cpd')}}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h5>Address:</h5>
                                <textarea name="maddress" id="maddress" class="form-control " placeholder="1234 Main St" value="{{old('address')}}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="mdelete" value="delete" class="btn btn-danger" onclick="return confirm('Are you Sure To delete this record')">Delete</button>
                    <button type="submit" name="mupdate" id="update" value="update" class="btn btn-primary" onclick="return confirm('Are you Sure update this record')">Update Customer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({});
        //reset date Err after modal close
        $('#customerdetail').on('hidden.bs.modal', function() {
            $('#customerdetail form #dateErr').text('');
        });
        $('.get_customer').click(function() {
            var id = $(this).val();
            // console.log(id);
            // alert(id);
            $.ajax({
                type: "POST",
                url: "get_customer/",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    response = JSON.parse(response);
                    $('#mhidden').val(response.id);
                    $('#mname').val(response.name);
                    $('#memail').val(response.email);
                    //For the selecttion of the gender
                    if (response.gender == 'male') {
                        $('#mmale').attr('checked', true);
                    } else if (response.gender == 'female') {
                        $('#mfemale').attr('checked', true);
                    }
                    $('#mstatus').val(response.status);
                    $('#mdate').val(response.dob);
                    $('#mactivity_level').val(response.level);
                    $('#mdob').val(response.dob);
                    $('#myage').val(response.age);
                    $('#mheight').val(response.height);
                    $('#mweight').val(response.weight);
                    $('#mstatus').val(response.status);
                    $('#mbmr').val(response.bmr);
                    $('#mbmi').val(response.bmi);
                    $('#mcpd').val(response.cpd);
                    $('#maddress').val(response.address);
                }
            });
        });

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

        // For modal
        $('#mdate').change(function() {
            var now = new Date(); //Current Date
            var past = new Date($('#mdate').val()); //Date of Birth
            if (past > now) {
                $('#dateErr').text('* Entered Date is not Greater than Current Date');
                return false;
            }
            var nowYear = now.getFullYear(); //Get current year
            var pastYear = past.getFullYear(); //Get Date of Birth year
            var age = nowYear - pastYear; //calculate the difference
            $('#myage').val(age);
        })

    });
</script>
@endsection
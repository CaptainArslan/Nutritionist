@extends('container')
@section('title','All Nutritionist')
@section('content-body')
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
    <!--Customer Data tables -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Nutritionist</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if( sizeof($nutrition) > 0 )
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sr = 1; @endphp
                                @foreach($nutrition as $row)
                                <tr>
                                    <td>{{$sr}}</td>
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
                                    <td>{{$status}}</td>
                                    <td>
                                        <button class="btn btn-primary get_nutritionist" id="{{$row->id}}" value="{{$row->id}}" data-toggle="modal" data-target="#nutritionistdetail">
                                            Manage
                                        </button>
                                    </td>
                                </tr>
                                @php $sr++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5 class="text-center">
                            No Nutrition Found
                        </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Ended -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="nutritionistdetail" tabindex="-1" role="dialog" aria-labelledby="nutritionistdetailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <form action="{{route('nutrition')}}" method="POST">
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
                                    <input type="password" name="mpassword" id="mpass" placeholder="password" class="form-control" readonly value="123" readonly>
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
                                    <input type="number" name="mbmr" id="mbmr" placeholder="bmr" class="form-control" value="{{old('mbmr')}}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <h5>BMI:</h5>
                                    <input type="number" name="mbmi" id="mbmi" placeholder="bmi" class="form-control" value="{{old('mbmi')}}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <h5>CPD:</h5>
                                    <input type="number" name="mcpd" id="mcpd" placeholder="cpd" class="form-control" value="{{old('mcpd')}}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <h5>Experience:</h5>
                                    <input type="number" name="mexperience" id="mexperience" placeholder="mexperience" class="form-control" value="{{old('mexperience')}}">
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
                        <button type="submit" name="mupdate" id="update" value="update" class="btn btn-primary" onclick="return confirm('Are you Sure update this record')">Update Nutritionist</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, "All"]
                ],
                dom: 'Bfrtip',

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
            $('.get_nutritionist').click(function() {
                var id = $(this).val();
                // console.log(id);
                // alert(id);
                $.ajax({
                    type: "POST",
                    url: "get_nutritionist/",
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
                        $('#mexperience').val(response.experience);
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
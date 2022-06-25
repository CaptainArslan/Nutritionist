@extends('container')
@section('title', 'Report | Nutritionist')
@section('content-body')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Intake Report</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('report') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{session('user_id')}}">
                    <div class="form-row align-items-center">
                        <div class="form-group col-md-3">
                            <input type="date" name="fromdate" id="fromdate" class="form-control" value="{{date('Y-m-d') }}">
                            <span class="text-danger">
                                @error('fromdate')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="date" name="todate" id="todate" class="form-control" value="{{date('Y-m-d') }}">
                            <span class="text-danger" id="todateErr">
                                @error('todate')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary " name="submit" value="Load">Load</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (isset($intake) && sizeof($intake) > 0)
        @php
        $app_arr = [];
        $child_arr = [];
        foreach ($intake as $group)
        {
            $app_arr[$group->type] = $group;
            $child_arr[$group->type][] = $group;
        }
        @endphp
    <div class="card" id="print_area">
        <div class="card-header">
            <h4 class="card-title">Intake Report</h4>
            <button class="btn btn-outline-dark" onclick="print_report('print_area')">PDF</button>
        </div>


        <div class="card-body">
            <table class="table table-borderless">
                
                <tr>
                    <td>
                        <h6> Name : {{ucwords(session('user_name'))}}</h6>
                    </td>
                    <td>
                        <h6> Email : {{session('user_email')}}</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>From Date : {{date("d-M-Y", strtotime($_POST['fromdate']))}} </h6>
                    </td>
                    <td>
                        <h6>To Date : {{date("d-M-Y", strtotime($_POST['todate']))}}</h6>
                    </td>
                </tr>
                @if(isset($admins) && sizeof($admins) > 0  )
                <tr>
                    <td>
                        <h6>BMR : {{$admins[0]->bmr}} </h6>
                    </td>
                    <td>
                        <h6>BMI : {{$admins[0]->bmi}}</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>CPD : {{$admins[0]->cpd}} </h6>
                    </td>
                </tr>
                @endif
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr class="text-dark">
                            <th>Product Name</th>
                            <th>Composition</th>
                            <th>Serving</th>
                            <th>Calories</th>
                            <th>Proteins</th>
                            <th>Carbs</th>
                            <th>Fats</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $foodtype = '';
                        $com = '';
                        $gt_cal= $gt_prot = $gt_carb = $gt_fats = 0;
                        @endphp
                        @foreach ($app_arr as $group)
                            @php
                            if ($group->type == 'B')
                                $foodtype = 'Breakfast';
                            elseif ($group->type == 'L')
                                $foodtype = 'Lunch';
                            elseif ($group->type == 'D')
                                $foodtype = 'Dinner';
                            elseif ($group->type == 'S')
                                $foodtype = 'Snackes';
                            @endphp
                        <tr>
                            <td colspan="10" class="text-dark font-weight-bold">{{$foodtype }}</td>
                        </tr>
                        @php
                        $st_cal= $st_prot = $st_carb = $st_fats = 0;
                        @endphp
                        @foreach ($child_arr[$group->type] as $row)
                            <tr>
                                <td>{{ $row->pro_name }}</td>
                                @php
                                if( $row->pro_com == 'BGCRP')
                                $com = 'Breads, Grains, Cereals, Pasta, Rice';
                                elseif( $row->pro_com == 'MF')
                                $com = 'Meat and Fish';
                                elseif( $row->pro_com == 'FFJ')
                                $com = 'Fruit and Fruit Juices';
                                elseif( $row->pro_com == 'VL')
                                $com = 'Vegetables and Legumes (e.g. Beans)';
                                elseif( $row->pro_com == 'DP')
                                $com = 'Dairy Products - Milk, Cheese, etc';
                                elseif( $row->pro_com == 'EGG')
                                $com = 'Eggs and Egg Substitutes';
                                elseif( $row->pro_com == 'NS')
                                $com = 'Nuts and Seeds';
                                elseif( $row->pro_com == 'FO')
                                $com = 'Fats and Oils';
                                elseif( $row->pro_com == 'HSS')
                                $com = 'Herbs, Spices, Sauces';
                                elseif( $row->pro_com == 'BEVER')
                                $com = 'Beverages';
                                elseif( $row->pro_com == 'OSS')
                                $com = 'Others, Snacks, Sweets, etc';
                                @endphp
                                <td>
                                    {{ $com }}
                                </td>
                                <td>
                                    {{ $row->serving . ' ' . $row->sunit }}
                                </td>
                                <td id="cal">{{ $row->calories }}</td>
                                <td id="prot">{{ $row->protein }}</td>
                                <td id="carbs">{{ $row->carbs }}</td>
                                <td id="fat">{{ $row->fat }}</td>
                                <td>
                                    <button id="del_intake" class="btn btn-rounded btn-outline-primary" value="{{$row->id}}" onclick="del_intake(this)">
                                        <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
                                    </button>
                                </td>
                            </tr>
                            @php
                                $st_cal += $row->calories;
                                $st_prot += $row->protein;
                                $st_carb += $row->carbs;
                                $st_fats += $row->fat;
                            @endphp
                        @endforeach
                        <tr class="text-dark">
                            <td colspan="3" class="text-dark">Sub Total</td>
                            <td>{{$st_cal}}</td>
                            <td>{{$st_prot}}</td>
                            <td>{{$st_carb}}</td>
                            <td>{{$st_fats}}</td>
                            <td></td>
                        </tr>
                        @php
                        $gt_cal += $st_cal;
                        $gt_prot += $st_prot;
                        $gt_carb += $st_carb;
                        $gt_fats += $st_fats;
                        @endphp
                        @endforeach
                        <tr class="text-dark" style="background-color: #c3c3c3;">
                            <td colspan="3" class="text-dark font-weight-bold"> Grand Total</td>
                            <td>{{$gt_cal}}</td>
                            <td>{{$gt_prot}}</td>
                            <td>{{$gt_carb}}</td>
                            <td>{{$gt_fats}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @elseif(isset($intake) && sizeof($intake) == 0)
    <center>
        <div class="card pt-3 pb-2">
            <h5>No Data Found</h5>
        </div>
    </center>
    @endif
</div>

<script>
    $('#todate').change(function() {
        var now = new Date(); //Current Date
        var past = new Date($('#todate').val()); //Date of Birth
        if (past > now) {
            $('#todateErr').text('Entered Date is not Greater than Current Date');
            return false;
        } else {
            $('#todateErr').text('');
        }
    });

    function print_report(param) 
    {
        var back = document.body.innerHTML;
        var divcontent = document.getElementById(param).innerHTML;
        document.body.innerHTML = divcontent;
        window.print();
        document.body.innerHTML = back;
    }


    function del_intake(param) {
        id = $(param).val();
        userid = "{{session('user_id')}}";
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "delrpt_intake",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "userid": userid
                        },
                        success: function(response) {
                            if (response == 'D') {
                                swal({
                                    title: "Good job!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "Error Occured!",
                                    text: "Error Occured while deletion!",
                                    icon: "Warning",
                                    // button: "Aww yiss!",
                                });
                            }
                        }
                    });

                }
            });
    }
    $(document).ready(function() {

    });
</script>

@endsection
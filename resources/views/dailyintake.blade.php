@extends('container')
@section('title','Daily Intake | Nutritionist')
@section('content-body')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">USER DAILY INTAKE</h4>
                </div>
                <div class="card-body">
                    <!-- Default accordion -->
                    <div id="accordion-one" class="accordion">
                        <div class="accordion__item">
                            <div class="accordion__header collapsed" data-toggle="collapse" data-target="#default_collapseOne">
                                <span class="accordion__header--text">Add Breakfast</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="default_collapseOne" class="collapse accordion__body" data-parent="#accordion-one">
                                <div class="accordion__body--text bg-light" style="max-height: 340px;">
                                    <div class="dropdown">
                                        <div class="form-row align-items-center">
                                            <div class="col-lg-12">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Breakfast</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="b_pro" placeholder="Breakfast">
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="breakfast_foodname bg-lightgray" id="bfname" style="max-height: 200px; overflow-y: scroll;">
                                            <!-- This data is coming from an api nutritionix and set here  -->
                                        </ul>
                                    </div>
                                    <form action="{{route('dailyintake')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="B" class="cls_data_field">
                                        <div id="breakfast">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <div class="accordion__header collapsed" data-toggle="collapse" data-target="#default_collapseTwo">
                                <span class="accordion__header--text">Add Lunch</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="default_collapseTwo" class="collapse accordion__body" data-parent="#accordion-one">
                                <div class="accordion__body--text bg-light" style="max-height: 340px;overflow-y: scroll;">
                                    <div class="form-row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Product</div>
                                                </div>
                                                <input type="text" class="form-control" id="l_pro" placeholder="Search Lunch Product">
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('dailyintake')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="L" class="cls_data_field">
                                        <div id="lunch"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <div class="accordion__header collapsed" data-toggle="collapse" data-target="#default_collapseThree">
                                <span class="accordion__header--text">Add Dinner</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="default_collapseThree" class="collapse accordion__body" data-parent="#accordion-one">
                                <div class="accordion__body--text bg-light" style="max-height: 340px;overflow-y: scroll;">
                                    <div class="form-row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Product</div>
                                                </div>
                                                <input type="text" class="form-control" id="d_pro" placeholder="Search Dinner Product">
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('dailyintake')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="D" class="cls_data_field">
                                        <div id="dinner"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <div class="accordion__header collapsed" data-toggle="collapse" data-target="#default_collapseFour">
                                <span class="accordion__header--text">Add Other</span>
                                <span class="accordion__header--indicator"></span>
                            </div>
                            <div id="default_collapseFour" class="collapse accordion__body" data-parent="#accordion-one">
                                <div class="accordion__body--text bg-light" style="max-height: 340px;overflow-y: scroll;">
                                    <div class="form-row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Product</div>
                                                </div>
                                                <input type="text" class="form-control" id="s_pro" placeholder="Search Snack Product">
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('dailyintake')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="S" class="cls_data_field">
                                        <div id="snack"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Today Total Intake</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="intake_data" class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Serving</th>
                                <th>Calories</th>
                                <th>Proteins</th>
                                <th>Carbs</th>
                                <th>Fats</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fill by the jquery nutritionix api call  -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const appid = "4640e001";
    const appkey = "d7d49a49e47a0433c7ada2bd1e65382d";

    function check_intake(param) {
        if ($(param).is(':checked')) {
            $(param).closest('tr').attr('disabled', false);
            $(param).closest('tr').css('background', '#eeeeee');
        } else {
            $(param).closest('tr').attr('disabled', true);
            $(param).closest('tr').css('background', '');
        }
    }

    function getproductname(param) {
        var query = $(param).data("name");
        console.log(query);
        $.ajax({
            type: "POST",
            url: "https://trackapi.nutritionix.com/v2/natural/nutrients",
            headers: {
                "x-app-id": appid,
                "x-app-key": appkey,
            },
            data: {
                query: query
            },
            success: function(data) {
                fulldata = [...data.foods];
                console.log(fulldata[0]);
                if (fulldata.length > 0 && fulldata.length != 0) {
                    $('#intake_data > tbody').html('<tr>><td style="text-transform: capitalize;">' + fulldata[0].food_name + '</td><td><span class="badge badge-primary">' + fulldata[0].serving_qty + ' ' + fulldata[0].serving_unit + '</span></td><td>' + fulldata[0].nf_calories + '</td><td class="color-primary">' + fulldata[0].nf_protein + '</td><td>' + fulldata[0].nf_total_carbohydrate + '</td><td class="color-primary">' + fulldata[0].nf_total_fat + '</td></tr>');
                    $('#bfname').html('');
                }
            }
        });
    }

    $(document).ready(function() {

        // Nutritionix api call to find food from their
        $('#b_pro').keyup(function() {
            var val = $('#b_pro').val();
            if (val != '') {
                $.ajax({
                    type: "GET",
                    url: "https://trackapi.nutritionix.com/v2/search/instant?query=" + val,
                    headers: {
                        "x-app-id": appid,
                        "x-app-key": appkey,
                    },
                    success: function(data) {
                        common = data.common;
                        branded = data.branded;
                        var fulldata = [...common, ...branded];
                        // console.log(fulldata);
                        if (fulldata.length == 0) {
                            $('#bfname').html('<center style="background: #e5e5e5;font-size: 18px;"><b>No Data Found</b></center>');
                        } else {
                            $('#bfname').html('');
                            $.each(fulldata, function(key, value) {
                                $('#bfname').append('<li class="dropdown-item " id="pro_name" data-name="' + fulldata[key].food_name.toUpperCase() + '" onclick="getproductname(this)"><img src="' + fulldata[key].photo.thumb + '" style="height: 30px;width: 30px; padding: 3px; obj-fit: contain" alt="">' + fulldata[key].food_name + '</li>');
                            });
                        }
                    }
                });
            } else {
                $('#bfname').html('');
            }
        });

        $('#l_pro').keyup(function() {
            var val = $('#l_pro').val();
            if (val != '') {
                $.ajax({
                    type: "POST",
                    url: "intake",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": val
                    },
                    success: function(response) {
                        $('#lunch').html(response);
                    }
                });
            } else {
                $('#lunch').html('');
            }
            // alert(val);
        });

        $('#d_pro').keyup(function() {
            var val = $('#d_pro').val();
            if (val != '') {
                $.ajax({
                    type: "POST",
                    url: "intake",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": val
                    },
                    success: function(response) {
                        $('#dinner').html(response);
                    }
                });
            } else {
                $('#dinner').html('');
            }
            // alert(val);
        });

        $('#s_pro').keyup(function() {
            var val = $('#s_pro').val();
            if (val != '') {
                $.ajax({
                    type: "POST",
                    url: "intake",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": val
                    },
                    success: function(response) {
                        $('#snack').html(response);
                    }
                });
            } else {
                $('#snack').html('');
            }
            // alert(val);
        });
    });
</script>
@endsection
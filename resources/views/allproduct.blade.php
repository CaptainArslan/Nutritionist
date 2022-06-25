@extends('container')
@section('title','All Product | Nutritionist')
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
    <!-- row form card-->

    <!--Customer Data tables -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @php $sr = 1; @endphp
                        @if(sizeof($product) > 0)
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>*</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Composition</th>
                                    <th>Servings</th>
                                    <th>Calories</th>
                                    <th>Protein</th>
                                    <th>Carbs</th>
                                    <th>Fats</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $row)
                                <tr>
                                    <td> {{$sr;}} </td>
                                    <td> {{$row->date}} </td>
                                    <td>
                                        <div class="round-img">
                                            <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                        </div>
                                    </td>
                                    <td>{{$row->product_name}}</td>
                                    <td>{{$row->product_nutrition_composition}}</td>
                                    <td>{{$row->product_serving." ".$row->serving_unit}}</td>
                                    <td>{{$row->product_calories}}</td>
                                    <td>{{$row->product_protein}}</td>
                                    <td>{{$row->product_carbs}}</td>
                                    <td>{{$row->product_fat}}</td>
                                    @if($row->product_status == 'a' || $row->product_status == 'A')
                                    @php $status = "Active"; @endphp
                                    @else
                                    @php $status = "Deactive"; @endphp
                                    @endif
                                    <td>{{$status}}</td>

                                    <td>{{$row->product_comment}}</td>
                                    <td>
                                        <button class="btn btn-primary get_products" id="{{$row->product_id}}" value="{{$row->product_id}}" data-toggle="modal" data-target="#productdetail">
                                            Manage
                                        </button>
                                </tr>
                                @php $sr ++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        No product Found
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal  -->
<div class="modal fade" id="productdetail" tabindex="-1" role="dialog" aria-labelledby="productdetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form action="{{route('add_product')}}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Product Detail</h5>
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
                                <h5> Name:</h5>
                                <input type="text" placeholder="Name" name="mname" id="mname" class="form-control" value="{{old('name')}}">
                                <span class="text-danger">@error('mname'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Nutritional Composition:</h5>
                                <!-- <input type="email" placeholder="Product Code" class="form-control" required> -->
                                <select id="mntcom" name="mntcom" class="form-control" value="{{old('ntcom')}}">
                                    <option value="">Select Option</option>
                                    <option value="BGCRP">Breads, Grains, Cereals, Pasta, Rice</option>
                                    <option value="MF">Meat and Fish</option>
                                    <option value="FFJ">Fruit and Fruit Juices</option>
                                    <option value="VL">Vegetables and Legumes (e.g. Beans)</option>
                                    <option value="DP">Dairy Products - Milk, Cheese, etc</option>
                                    <option value="EGG">Eggs and Egg Substitutes</option>
                                    <option value="NS">Nuts and Seeds</option>
                                    <option value="FO">Fats and Oils</option>
                                    <option value="HSS">Herbs, Spices, Sauces</option>
                                    <option value="BEVER">Beverages</option>
                                    <option value="OSS">Others, Snacks, Sweets, etc</option>
                                </select>
                                <span class="text-danger">@error('mntcom'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Serving:</h5>
                                <div class="input-group">
                                    <input type="text" id="mserving" name="mserving" placeholder="Product Serving" class="form-control" value="{{old('serving')}}">
                                    <div class="input-group-prepend">
                                        <select name="mservingunit" id="mservingunit" class="btn btn-primary ">
                                            <option value="gm">gm</option>
                                            <option value="mlml">ml</option>
                                            <option value="oz">oz</option>
                                            <option value="pcs">pcs</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger">@error('mserving'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5> Calories:</h5>
                                <input type="number" name="mcalories" id="mcalories" placeholder="Calories" class="form-control" value="{{old('calories')}}">
                                <span class="text-danger">@error('mcalories'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5> Proteins:</h5>
                                <input type="number" name="mproteins" id="mproteins" placeholder="Proteins" class="form-control" value="{{old('proteins')}}">
                                <span class="text-danger">@error('mproteins'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5> Carbohydrates:</h5>
                                <input type="number" name="mcarbs" id="mcarbs" placeholder="Carbohydrates" class="form-control" value="{{old('carbs')}}">
                                <span class="text-danger">@error('mcarbs'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5> Fats</h5>
                                <input type="number" name="mfats" id="mfats" placeholder="Fats" class="form-control" value="{{old('fats')}}">
                                <span class="text-danger">@error('mfats'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <h5>Status:</h5>
                                <select name="mstatus" id="mstatus" class="form-control" value="{{old('status')}}">
                                    <option value="a">Active</option>
                                    <option value="d">Deactive</option>
                                </select>
                                <span class="text-danger">@error('mstatus'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <h5> Additional Comment</h5>
                            <textarea name="mcomment" id="mcomment" placeholder="Additional information" class="form-control" value="{{old('')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="mdelete" value="delete" class="btn btn-danger" onclick="return confirm('Are you Sure To delete this record')">Delete Product</button>
                    <button type="submit" name="mupdate" id="update" value="update" class="btn btn-primary" onclick="return confirm('Are you Sure update this record')">Update Product</button>
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
        // alert("hello");
        $('.get_products').click(function() {
            var id = $(this).val();
            // alert(id);
            $.ajax({
                type: "POST",
                url: "get_products/",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    response = JSON.parse(response);
                    $('#mhidden').val(response.product_id);
                    $('#mname').val(response.product_name);
                    $('#mntcom').val(response.product_nutrition_composition);
                    $('#mserving').val(response.product_serving);
                    $('#mservingunit').val(response.serving_unit);
                    $('#mcalories').val(response.product_calories);
                    $('#mproteins').val(response.product_protein);
                    $('#mcarbs').val(response.product_carbs);
                    $('#mfats').val(response.product_fat);
                    $('#mstatus').val(response.product_status);
                    $('#mcomment').val(response.product_comment);
                }
            });
        });
    });
</script>

@endsection
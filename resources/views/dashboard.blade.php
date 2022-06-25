@extends('container')
@section('title','Home | Nutritionist')
@section('content-body')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Admins</div>
                        <div class="stat-digit">@php echo $admin @endphp</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success w-@php echo $admin @endphp" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Customer</div>
                        <div class="stat-digit">@php echo $cus @endphp</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary w-@php echo $cus @endphp" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Nutritionist</div>
                        <div class="stat-digit"> @php echo $nut @endphp</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning w-@php echo $nut @endphp" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Products</div>
                        <div class="stat-digit"> @php echo $pro @endphp</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger w-@php echo $pro @endphp" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <div class="row">
        @if(sizeof($customer) > 0)
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Customer</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>age</th>
                                    <th>gender</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sr = 1 ;
                                $status = '';
                                $badge = '';
                                $gender = '';
                                @endphp
                                @foreach($customer as $row)
                                <tr>
                                    <td>{{$sr}}</td>
                                    <td> {{$row->name}} </td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->age}}</td>
                                    @php
                                    if($row->status == 'a')
                                    {
                                    $status = 'Active';
                                    $badge = 'badge-success';
                                    }
                                    elseif($row->status == 'd')
                                    {
                                    $status = 'Deactive';
                                    $badge = 'badge-warning';
                                    }
                                    @endphp
                                    <td>{{ucwords($row->gender)}}</td>
                                    <td><a href="" class="status" id="{{$row->id}}"><span class="badge {{$badge}}"> {{$status}}</span></a></td>
                                </tr>
                                @php
                                $sr++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xl-4 col-xxl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todo List</h4>
                </div>
                <div class="card-body px-0">
                    <div class="container mt-1 mb-2">
                        <form action="">
                            <input type="text" class="form-control">
                        </form>
                    </div>
                    <div class="todo-list">
                        <div class="tdl-holder">
                            <div class="tdl-content widget-todo mr-4">
                                <ul id="todo_list">
                                    <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                                    <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                    <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                fight.</span><a href='#' class="ti-trash"></a></label></li>
                                    <li><label><input type="checkbox" checked><i></i><span>Do something
                                                else</span><a href='#' class="ti-trash"></a></label></li>
                                    <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                    <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                fight.</span><a href='#' class="ti-trash"></a></label></li>
                                </ul>
                            </div>
                            <div class="px-4">
                                <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
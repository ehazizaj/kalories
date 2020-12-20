@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Meals Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Meals</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="GET" action="{{ route('search-meals') }}">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="control-label col-lg-12">Date From
                                        </label>
                                        <input type="date" class="form-control" name="date_from" value="{{$from}}">
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label col-lg-12">Date To
                                        </label>
                                        <input type="date" class="form-control" name="date_to" value="{{$to}}">
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 32px">Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item">
                                        <button class="btn btn-primary" type="button" title="Add new meal"
                                                onclick="window.location='{{ route("meals.create") }}'">
                                            <i class="nav-icon fas fa-plus-circle"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Calories</th>
                                    <th class="text-center">Date of Consumption</th>
                                    <th class="text-center">Time of Consumption</th>
                                    <th class="text-center">Day Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($meals as  $meal)
                                    <tr>
                                        <td class="text-center" id="name{{$meal->id}}">{{$meal->name}}</td>
                                        <td class="text-center" id="calories{{$meal->id}}">{{$meal->calories}}</td>
                                        <td class="text-center" id="dateOfConsumption{{$meal->id}}">
                                            <p hidden>{{$meal->date_of_consumption}}</p>
                                            At :
                                            <em><b>{{date('j M Y', strtotime($meal->date_of_consumption))}}</b></em><br>
                                        </td>
                                        <td class="text-center" id="timeOfConsumption{{$meal->id}}">
                                            <p hidden>{{$meal->date_of_consumption}}</p>
                                            At :
                                            <em><b>{{date('h:i', strtotime($meal->time_of_consumption))}}</b></em><br>
                                        </td>

                                        <td class="text-center" id="total{{$meal->id}}">
                                            @if($meal->total > $countPerDay->calories_per_day)
                                                <span style="color: red"> {{$meal->total}} Calories</span>
                                            @elseif($meal->total <= $countPerDay->calories_per_day)
                                                <span style="color: green"> {{$meal->total}} Calories</span>
                                            @endif
                                        </td>
                                        <td class="text-center" id="myTableRow{{$meal->id}}">
                                            <button class="btn btn-default" type="button"
                                                    onclick="location.href='{{ route('meals.edit',$meal->id) }}'">
                                                <i class="nav-icon fas fa-wrench"></i>
                                            </button>

                                            <button data-toggle="modal" class="btn btn-default delete"
                                                    data-target="#myModal{{$meal->id}}"
                                            >
                                                <i class="nav-icon fas fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <div id="myModal{{$meal->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-4 text-center">
                                                        <i class="icon-exclamation text-danger"
                                                           style="font-size: 60px"></i>
                                                        <h1 class="font-weight-normal">Delete Meal"<span
                                                                style="font-weight: 600;">{{$meal->name}}</span>" ?</h1>
                                                    </div>
                                                    <h3 class="text-center" style="font-weight: 600;">Warning: This
                                                        cannot be undone!</h3>
                                                </div>
                                                <div class="modal-footer"
                                                     style="background-color: #F9F9FB; padding: 30px; border-top: 1px solid #b7b7b770; text-align: center;">
                                                    <div class="row">
                                                        <button
                                                            class="btn btn-danger"
                                                            onclick="deleteRow({{$meal->id}})"
                                                            title="Delete"
                                                            type="button">
                                                            <i class="icon-bin"></i>
                                                            Yes, Delete
                                                        </button>
                                                        <button
                                                            class="btn btn-outline-secondary"
                                                            data-dismiss="modal"
                                                            type="button">
                                                            <i class="icon-cross2"></i>
                                                            No, Don't Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card-header">
                                        <h3 class="card-title">There are no meals created yet</h3>
                                    </div>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="pagination pagination-sm m-0 float-right">

                                {{$meals->appends(request()->input())->links("pagination::bootstrap-4")}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

<script type="text/javascript">


    function deleteRow(elemet) {
        var id = elemet;
        var url = "{{ route('meals.destroy', ":id") }}";
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'delete',
            dataType: 'json',
            data:
                {
                    _token: "{{csrf_token()}}"
                },
            success: function (response) {
                $('#myModal' + id).modal('toggle');
                $('#name' + id).remove();
                $('#calories' + id).remove();
                $('#dateOfConsumption' + id).remove();
                $('#myPriceRow' + id).remove();
                $('#timeOfConsumption' + id).remove();
                $('#myTableRow' + id).remove();
                console.log(response)
            }, error: function (error) {
            }
        });
    }

</script>

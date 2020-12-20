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
                            <h3 class="card-title">Simple Full Width Table</h3>

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
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($meals as $meal)
                                <tr>
                                    <td class="text-center">{{$meal->name}}</td>
                                    <td class="text-center">{{$meal->calories}}</td>
                                    <td class="text-center">
                                        <p hidden>{{$meal->date_of_consumption}}</p>
                                        At : <em><b>{{date('j M Y', strtotime($meal->date_of_consumption))}}</b></em><br>
                                    </td>
                                    <td class="text-center">
                                        <p hidden>{{$meal->date_of_consumption}}</p>
                                        At : <em><b>{{date('h:i', strtotime($meal->time_of_consumption))}}</b></em><br>
                                    </td>


                                    <td class="text-center">
                                        <button class="btn btn-default" type="button">
                                            <i class="nav-icon fas fa-wrench"></i>
                                        </button>
                                        <button data-toggle="modal" class="btn btn-default delete">
                                            <i class="nav-icon fas fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
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
                                {{$meals->links("pagination::bootstrap-4")}}

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


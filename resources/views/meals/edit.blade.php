@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Meal {{$meal->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('meals.index')}}">Meals</a></li>
                        <li class="breadcrumb-item active">Edit Meal {{$meal->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method="POST" action="{{ route('meals.update',$meal->id) }}">
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label col-lg-12">Meal Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{ $meal->name }}"
                                           name="name"
                                           placeholder="Please enter meal name">
                                    <label class="control-label col-lg-12">Calories Count
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{ $meal->calories }}"
                                           name="calories"
                                           placeholder="Please enter meal name">
                                    <label class="control-label col-lg-12">Date of Consumption
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           class="form-control"
                                           value="{{ $meal->date_of_consumption }}"
                                           name="date_of_consumption"
                                    >
                                    <label class="control-label col-lg-12">Time of Consumption
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="time"
                                           class="form-control"
                                           value="{{ $meal->time_of_consumption }}"
                                           name="time_of_consumption"
                                    >
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@extends('layouts.app')

@section('title', Auth::user()->name . ' (' . \App\Models\Role::find(cardholder())->name . ')')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.cardholder._partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <span class="pull-left">Home</span>
                    </div>
                    <div class="panel-body">
                        <h1>{!! trans('greetings.welcome_cardholder', ['name' => Auth::user()->name]) !!}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
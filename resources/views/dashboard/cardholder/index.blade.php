@extends('layouts.app')

@section('title', 'Cardholder Dashboard')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Cardholder Dashboard</div>

            <div class="panel-body">
                {{ trans('auth.logged_in') }}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Available Merchandise')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.admin.merchandise._partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('title')
                    </div>
                    @if(\App\Models\Merchandise::available()->get()->count())
                        <div class="panel-body">
                            @include('_partials.search', ['url' => url('merchandises/available'), 'type' => 'GET'])
                            @if(\App\Models\Merchandise::available()->get()->count())
                                @include('dashboard.admin.merchandise._partials.sort')
                            @endif
                            <span class="pull-right">
                                @include('_partials.create', ['url' => route('merchandises.create'), 'what' => 'merchandise'])
                                @include('_partials.create', ['url' => route('merchandise.categories.create'), 'what' => 'category'])
                            </span>
                        </div>
                        @include('dashboard.admin.merchandise._partials.table')
                    @else
                        @include('_partials.empty')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
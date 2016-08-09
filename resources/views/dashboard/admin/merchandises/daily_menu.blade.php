@extends('layouts.app')

@section('title', 'Daily Menu')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.admin.merchandises._partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('title')
                        <span class="pull-right">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <strong>{{ \Carbon\Carbon::now()->toDayDateTimeString() }}</strong>
                        </span>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            @foreach($operation_days as $day)
                                <li {{ ($day->id == date("w", strtotime(\Carbon\Carbon::now()))) ? 'class=active' : '' }}>
                                    <a data-toggle="tab" href="#{{ strtolower($day->day) }}">{{ $day->day }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach($operation_days as $day)
                                <div id="{{ strtolower($day->day) }}"
                                     class="tab-pane fade in {{ ($day->id == date("w", strtotime(\Carbon\Carbon::now()))) ? 'active' : '' }}">
                                    <h4>
                                        <strong>{{ ($day->id == date("w", strtotime(\Carbon\Carbon::now()))) ? 'Today\'s Menu' : $day->day }}</strong>
                                    </h4>
                                    @if(\App\Models\Merchandise::availableEvery($day->id)->get()->count())
                                        @foreach($merchandise_categories as $category)
                                            @if(in_array($category->id, collect(\App\Models\Merchandise::availableEvery($day->id)->get())->pluck('merchandise_category_id')->toArray()))
                                                <h4>{{ $category->name }}</h4>
                                                <ul class="list-inline">
                                                    @foreach(\App\Models\Merchandise::availableEvery($day->id)->get() as $merchandise)
                                                        @if($merchandise->merchandiseCategory->id == $category->id)
                                                            <li class="img-merchandise-list-item">
                                                                <a href="{{ route('merchandises.show', $merchandise->id) }}">
                                                                    <img class="img-responsive img-rounded"
                                                                         src="{{ $merchandise->image($merchandise->id) }}"
                                                                         alt="{{ $merchandise->name }}">
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="row">
                                            @include('_partials.empty')
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
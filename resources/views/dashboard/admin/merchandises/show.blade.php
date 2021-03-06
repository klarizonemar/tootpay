@extends('layouts.app')

@section('title', $merchandise->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.admin.merchandises._partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <span class="pull-left">@yield('title')</span>
                        <span class="pull-right"></span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-merchandise">
                                    <a href="{{ $merchandise->image($merchandise->id) }}">
                                        <img src="{{ $merchandise->image($merchandise->id) }}" class="img-responsive img-rounded" alt="{{ $merchandise->name }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-unstyled">
                                    <li>
                                        <h4>Name: <strong>{{ $merchandise->name }}</strong></h4>
                                    </li>
                                    <li>
                                        <h4>Price: <strong>P{{ number_format($merchandise->price, 2, '.', ',') }}</strong></h4>
                                    </li>
                                    <li>
                                        <h4>Category: {!! is_null($merchandise->category) ? '<strong>Not set</strong>' : '<a href="' . route('merchandise.categories.show', $merchandise->category->id) . '"><strong>' . $merchandise->category->name .'</strong></a>' !!}</h4>
                                    </li>
                                    <li>
                                        <h4>
                                            Available Every:
                                            <strong>
                                                @if($merchandise->operationDays()->getRelatedIds()->count())
                                                    <ul class="list-inline days-merchandise">
                                                        @foreach($merchandise->operationDays()->getRelatedIds()->all() as $day)
                                                            <li>{{ $operation_days->find($day)->day }},</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    Not set
                                                @endif
                                            </strong>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>Created: <strong>{{ $merchandise->created_at->toFormattedDateString() }}</strong></h4>
                                    </li>
                                    <li>
                                        <h4>Updated: <strong data-livestamp="{{ strtotime($merchandise->updated_at) }}"></strong></h4>
                                    </li>
                                </ul>
                                {!! Form::open([
                                'route' => ['merchandises.destroy', $merchandise->id,
                                'redirect=' . request()->get('redirect')],
                                'class' => '']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                <a href="{{ route('merchandises.edit', [$merchandise->id, 'redirect' => Request::fullUrl()]) }}"
                                   class="btn btn-default">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
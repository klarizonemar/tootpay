<div class="row">
    @if(request()->has('redirect'))
        {!! Form::open([
            'route' => (Route::is('merchandise.categories.edit')) ? ['merchandise.categories.update', $category->id, 'redirect' => request()->get('redirect')] : ['merchandise.categories.store', 'redirect' => request()->get('redirect')],
            'class' => ''
        ]) !!}
    @else
        {!! Form::open([
            'route' => (Route::is('merchandise.categories.edit')) ? ['merchandise.categories.update', $category->id] : 'merchandise.categories.store',
            'class' => ''
        ]) !!}
    @endif

    @if(Route::is('merchandise.categories.edit'))
        {!! Form::hidden('_method', 'PUT') !!}
    @endif

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ (Route::is('merchandise.categories.edit')) ? $category->name : old('name') }}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description">Description (optional):</label>
            <textarea class="form-control" name="description" rows="3" id="description">{{ (Route::is('merchandise.categories.edit')) ? $category->description : old('description') }}</textarea>

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        {{--<div class="checkbox">--}}
            {{--<input type="hidden" value="off" name="manage_inventory">--}}
            {{--<label for="manage_inventory">--}}
            {{--@if(Route::is('merchandise.categories.edit'))--}}
                {{--<input type="checkbox" value="on" name="manage_inventory" id="manage_inventory" {{ $category->manage_inventory ? 'checked' : '' }}>--}}
            {{--@else--}}
                {{--<input type="checkbox" value="on" name="manage_inventory" id="manage_inventory" {{ old('manage_inventory') ? 'checked' : '' }}>--}}
            {{--@endif Manage inventory?--}}
            {{--</label>--}}
        {{--</div>--}}

        <button type="submit" id="btn-submit" class="btn btn-primary"
                data-loading-text="{{ trans('loading.default') }}">
            {{ (Route::is('merchandise.categories.edit')) ? 'Update ' : 'Create ' }}category
        </button>
        @include('_partials.cancel', ['url' => route('merchandise.categories.index')])
    </div>
    {!! Form::close() !!}
</div>
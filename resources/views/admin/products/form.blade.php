{!! Form::hidden('redirects_to', URL::previous()) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
            <label class="control-label" for="name">Category <span class="text-red">*</span></label>
            {!! Form::select('category', $category, null, ['class' => 'form-control select2']) !!}
            @if ($errors->has('category'))
                <span class="text-danger">
                    <strong>{{ $errors->first('category') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label" for="name">Name <span class="text-red">*</span></label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'name']) !!}
            @if ($errors->has('name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label class="control-label" for="description">Description <span class="text-red"></span></label>
            {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter Description', 'id' => 'description']) !!}
            @if ($errors->has('description'))
                <span class="text-danger">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
            <label class="control-label" for="images">Images <span class="text-red mr-2">*</span></label>
            <small class="text-primary">[You can select multiple images]</small><br>
            {!! Form::file('images[]', ['multiple', 'id' => 'images']) !!}
            @if ($errors->has('images'))
                <span class="text-danger">
                    <strong>{{ $errors->first('images') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label class="control-label" for="price">Price <span class="text-red">*</span></label>
            {!! Form::number('price', null, ['class' => 'form-control', 'step'=>'0.01', 'placeholder' => 'Enter Price', 'id' => 'price']) !!}
            @if ($errors->has('price'))
                <span class="text-danger">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="status">Status <span class="text-red">*</span></label>
            <div class="col-md-12">
                @foreach (\App\Models\Category::$status as $key => $value)
                    @php $checked = !isset($users) && $key == 'active'?'checked':''; @endphp
                    <label>
                        {!! Form::radio('status', $key, null, ['class' => 'flat-red',$checked]) !!} <span style="margin-right: 10px">{{ $value }}</span>
                    </label>
                @endforeach
                <br class="statusError">
                @if ($errors->has('status'))
                    <span class="text-danger" id="statusError">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

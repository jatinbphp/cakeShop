<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="name">Name <span class="text-red">*</span></label>
            <div class="col-md-12">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="title">Image <span class="text-red">*</span></label>
            <div class="col-md-6">
                @if(isset($settings->image) && !empty($settings->image))
                    {!! Form::hidden('image', null, ['class' => 'form-control', 'placeholder' => 'Image', 'id' => 'image']) !!}
                    <div class="img-wrap settings-image">
                        <span class="close"><button type="button" class="btn delete-settings-image" data-id="{{ $settings->id }}" data-name="{{ $settings->image }}"><i class="fa fa-trash" style="color: red;"></i></i></button></span>
                        <img src="{{ url('uploads/logo/'.$settings->image) }}" alt="" width="90%" height="100%">
                    </div>
                @else
                    {!! Form::file('image', null, ['class' => 'form-control', 'placeholder' => 'Choose The logo']) !!}

                @endif

                @if ($errors->has('image'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>




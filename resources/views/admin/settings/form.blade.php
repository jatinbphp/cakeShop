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
            <label class="col-md-12 control-label" for="image">Image<span class="text-red">*</span></label>
            <div class="col-md-12">
                <div class="fileError">
                    {!! Form::file('image', ['class' => '', 'id'=> 'image','accept'=>'image/*', 'onChange'=>'AjaxUploadImage(this)']) !!}
                </div>

                <img id="DisplayImage" @if(!empty($settings->image)) src="{{ url('storage/'.$settings->image)}}" style="margin-top: 1%; padding-bottom:5px; display: block;" @else src="" style="padding-bottom:5px; display: none;" @endif width="150">

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('gcash_mobile') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="gcash_mobile">Please pay Gcash to <span class="text-red">*</span></label>
            <div class="col-md-12">
                {!! Form::text('gcash_mobile', null, ['class' => 'form-control', 'placeholder' => 'Please pay Gcash to']) !!}
                @if ($errors->has('gcash_mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gcash_mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('gcash_screenshot_mobile') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="gcash_screenshot_mobile">Please send screenshot to <span class="text-red">*</span></label>
            <div class="col-md-12">
                {!! Form::text('gcash_screenshot_mobile', null, ['class' => 'form-control', 'placeholder' => 'Please send screenshot to']) !!}
                @if ($errors->has('gcash_screenshot_mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gcash_screenshot_mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>




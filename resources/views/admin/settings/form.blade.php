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

    <!-- //for g cash note -->
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('gcash_mobile') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="gcash_mobile">Notes For Gcash <span class="text-red">*</span></label>
            <div class="col-md-12">
                {!! Form::textarea('gcash_mobile', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Please pay Gcash to']) !!}
                @if ($errors->has('gcash_mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gcash_mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- //for bank to bank note -->
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('gcash_screenshot_mobile') ? ' has-error' : '' }}">
            <label class="col-md-12 control-label" for="gcash_screenshot_mobile">Notes For Bank to Bank <span class="text-red">*</span></label>
            <div class="col-md-12">
                {!! Form::textarea('gcash_screenshot_mobile', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Please send screenshot to']) !!}
                @if ($errors->has('gcash_screenshot_mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('gcash_screenshot_mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="col-md-12">
        <h5><b>Payment Gateway</b></h5>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('p_cod') ? ' has-error' : '' }}">
                <label class="col-md-12 control-label" for="p_cod">Cash On Delivery :<span class="text-red">*</span></label>
                <div class="col-md-12">
                    @foreach (\App\Models\Setting::$status as $key => $value)
                        <label>
                            {!! Form::radio('p_cod', $key, null, ['class' => 'flat-red']) !!} 
                            <span style="margin-right: 10px">{{ $value }}</span>
                        </label>
                    @endforeach
                    <br class="p_codError">
                    @if ($errors->has('p_cod'))
                        <span class="text-danger" id="p_codError">
                            <strong>{{ $errors->first('p_cod') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group{{ $errors->has('p_gcash') ? ' has-error' : '' }}">
                <label class="col-md-12 control-label" for="p_gcash">GCash :<span class="text-red">*</span></label>
                <div class="col-md-12">
                    @foreach (\App\Models\Setting::$status as $key => $value)
                        <label>
                            {!! Form::radio('p_gcash', $key, null, ['class' => 'flat-red']) !!} 
                            <span style="margin-right: 10px">{{ $value }}</span>
                        </label>
                    @endforeach
                    <br class="p_codError">
                    @if ($errors->has('p_gcash'))
                        <span class="text-danger" id="p_codError">
                            <strong>{{ $errors->first('p_gcash') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group{{ $errors->has('p_bank') ? ' has-error' : '' }}">
                <label class="col-md-12 control-label" for="p_bank">Bank To Bank :<span class="text-red">*</span></label>
                <div class="col-md-12">
                    @foreach (\App\Models\Setting::$status as $key => $value)
                        <label>
                            {!! Form::radio('p_bank', $key, null, ['class' => 'flat-red']) !!} 
                            <span style="margin-right: 10px">{{ $value }}</span>
                        </label>
                    @endforeach
                    <br class="p_codError">
                    @if ($errors->has('p_bank'))
                        <span class="text-danger" id="p_codError">
                            <strong>{{ $errors->first('p_bank') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>




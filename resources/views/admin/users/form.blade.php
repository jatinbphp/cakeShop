{!! Form::hidden('redirects_to', URL::previous()) !!}
{{--<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="first_name">First Name <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name']) !!}--}}
{{--        @if ($errors->has('first_name'))--}}
{{--            <span class="help-block">--}}
{{--                <strong>{{ $errors->first('first_name') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="last_name">Last Name <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name']) !!}--}}
{{--        @if ($errors->has('last_name'))--}}
{{--            <span class="help-block">--}}
{{--                <strong>{{ $errors->first('last_name') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="col-md-12 control-label" for="email">Email <span class="text-red">*</span></label>
    <div class="col-md-12">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email Address']) !!}
            @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

{{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="password">Password <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        <input type="password" placeholder="Enter Password" autocomplete="off"  id="password" maxlength="10" name="password" class="form-control" >--}}
{{--        @if ($errors->has('password'))--}}
{{--            <span class="help-block">--}}
{{--                <strong>{{ $errors->first('password') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="country_code">Country Code <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        {!! Form::text('country_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Country Code']) !!}--}}
{{--        @if ($errors->has('country_code'))--}}
{{--            <span class="help-block">--}}
{{--                <strong>{{ $errors->first('country_code') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="mobile">Mobile <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile']) !!}--}}
{{--        @if ($errors->has('mobile'))--}}
{{--            <span class="help-block">--}}
{{--            <strong>{{ $errors->first('mobile') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    <label class="col-md-12 control-label" for="image">Image<span class="text-red">*</span></label>
    <div class="col-md-12">
        <div class="">
            {!! Form::file('image', ['class' => '', 'id'=> 'image', 'onChange'=>'AjaxUploadImage(this)']) !!}
        </div>
        <img id="DisplayImage" @if(!empty($user->image)) src="{{ url('storage/'.$user->image)}}" style="margin-top: 1%; padding-bottom:5px; display: block;" @else src="" style="padding-bottom:5px; display: none;" @endif name="img"  width="150"  >
        @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
    </div>
</div>

{{--<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">--}}
{{--    <label class="col-md-12 control-label" for="role">Status <span class="text-red">*</span></label>--}}
{{--    <div class="col-md-12">--}}
{{--        @foreach (\App\User::$status as $key => $value)--}}
{{--            <label>--}}
{{--                {!! Form::radio('status', $key, null, ['class' => 'flat-red']) !!} <span style="margin-right: 10px">{{ $value }}</span>--}}
{{--            </label>--}}
{{--        @endforeach--}}
{{--            <br>--}}
{{--        @if ($errors->has('status'))--}}
{{--            <span class="help-block">--}}
{{--             <strong>{{ $errors->first('status') }}</strong>--}}
{{--            </span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

@extends('layouts.app')

@section('content')
<div class="slider-area slider-bg2">
    <div class="slider-active">
        <div class="single-slider d-flex align-items-center slider-height2 ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-7 col-md-8">
                        <div class="hero__caption hero__caption2">
                            <div class="shop-tittle">
                                <h2>Delicious</h2>
                            </div>
                            <h1 data-animation="fadeInUp" data-delay=".6s ">Contact</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-shape2 bounce-animate">
        <img src="images/hero-shape.png" alt="">
    </div>
</div>
<div class="contact-section">
    <div class="container">
        <div class="row">
            @include('error')
            <div class="col-12">
                <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
                {!! Form::open(['url' => url('storeContactInfo'), 'id' => 'contactForm', 'class' => 'form-contact contact_form','files'=>true]) !!}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::text('name', null,['class' => 'form-control valid', 'id' => 'name', 'placeholder' => 'Enter your name']) !!}

                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::email('email', null,['class' => 'form-control valid', 'id' => 'email', 'placeholder' => 'Enter your email']) !!}

                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::text('subject', null,['class' => 'form-control valid', 'id' => 'subject', 'placeholder' => 'Enter subject']) !!}

                                @if ($errors->has('subject'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::textarea('message', null,['class' => 'form-control valid', 'id' => 'message', 'placeholder' => 'Enter message']) !!}

                                @if ($errors->has('message'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>8 Jade Bldg Santolan Road</h3>
                        <p>San Juan City, Metro Manila</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>Viber or Call us 0906 396 4271</h3>
                        <p>Mon to Sun 9am to 6pm</p>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

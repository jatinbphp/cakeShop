@extends('layouts.app')

@section('content')
<div class="slider-area slider-bg1">
    <div class="slider-active">
        <div class="single-slider d-flex align-items-center slider-height ">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-6 col-lg-7 col-md-8 ">
                        <div class="hero__caption">
                            <div class="shop-tittle">
                                <h2>Delicious</h2>
                            </div>
                            <h1 data-animation="fadeInUp" data-delay=".6s ">Delicious Cake For Everyone</h1>
                            <p data-animation="fadeInUp" data-delay=".8s">Land behold it created good saw after she'd Our set
                                living. Signs midst dominion creepeth morning
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-shape bounce-animate">
        <img src="{{ asset('website/images/hero-shape.png') }}" alt="">
    </div>
</div>

<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle text-center mb-60">
                    <h2>Our Exclusive Cakes</h2>
                </div>
            </div>
        </div>
        <div class="popular-active">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-items text-center mb-30">
                    <div class="items-top">
                        <img src="{{ asset('website/images/items1.png') }}" alt="">
                    </div>
                    <div class="items-bottom">
                        <h4><a href="#">Chocolate </a></h4>
                        <p>Land behold it created good saw after she'd our set.</p>
                        <a href="#" class="btn order-btn">$20 | Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-items text-center mb-30">
                    <div class="items-top">
                        <img src="{{ asset('website/images/items2.png') }}" alt="">
                    </div>
                    <div class="items-bottom">
                        <h4><a href="#">Sweetheart</a></h4>
                        <p>Land behold it created good saw after she'd our set.</p>
                        <a href="#" class="btn order-btn">$20 | Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-items text-center mb-30">
                    <div class="items-top">
                        <img src="{{ asset('website/images/items3.png') }}" alt="">
                    </div>
                    <div class="items-bottom">
                        <h4><a href="#">Blackforest </a></h4>
                        <p>Land behold it created good saw after she'd our set.</p>
                        <a href="#" class="btn order-btn">$20 | Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-items text-center mb-30">
                    <div class="items-top">
                        <img src="{{ asset('website/images/items2.png') }}" alt="">
                    </div>
                    <div class="items-bottom">
                        <h4><a href="#">Chocolate </a></h4>
                        <p>Land behold it created good saw after she'd our set.</p>
                        <a href="#" class="btn order-btn">$20 | Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>When do you want your order?</h2>
                    <p>Showing next available dates <a style="color:#000;float: right;" href="javascript:void(0)">More dates</a></p>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="rescalendar" id="my_calendar_calSize"></div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="form-group">
                        <label>Times shown in Asia/Manila time</label>
                        <select class="order_time" name="order_time">
                            <option value="09:00">09:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:00">04:00 PM</option>
                            <option value="17:00">05:00 PM</option>
                            <option value="18:00">06:00 PM</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>What's your name?</h2>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" name="" placeholder="Enter Here" class="form-control">
                    </div>
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>What's your email?</h2>
                    <p>Your order confirmation will be sent here</p>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" name="" placeholder="coco@gmail.com" class="form-control">
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="">
                        <label class="m-0">I'd like to receive shop offers and updates through email</label>
                    </div>
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>What's your phone number?</h2>
                    <p>No spam. For order purposes only</p>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" name="" placeholder="081234 56789" class="form-control">
                    </div>
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>Do you want to write a short note? Type below.</h2>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" name="" placeholder="Enter Here" class="form-control">
                    </div>
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="popular-items section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>And finally, how would you like to pay?</h2>
                </div>
            </div>
        </div>
        <div class="orderProcess">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="radio-group-list">
                        <div class="radio-group-item">
                            <input type="radio" id="html" name="fav_language" value="HTML">
                            <label for="html">Credit/Debit Card</label>
                        </div>
                        <div class="radio-group-item">
                            <input type="radio" id="css" name="fav_language" value="CSS">
                            <label for="css">GCash</label>
                        </div>
                        <div class="radio-group-item">
                            <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                            <label for="javascript">Bank Transfer (Security Bank)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
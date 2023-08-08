@extends('layouts.app')
@section('content')
    <section class="popular-items section-padding40" id="confirmOrderDiv" style="display: block;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="confirmOrder-sec">
                        <div class="section-tittle">
                            <h2>Total</h2>
                            <div class="edit-cart">
                                <h4><strong>₱ 1500</strong></h4>
                                <p class="text-danger">Pending</p>
                            </div>
                        </div>
                        <div class="item-list">
                            <div class="single-items">
                                <div class="items-left">
                                    <img src="https://ysabelles.ph/cakeShop/public/storage/uploads/products/GGCayXHIZ7QZu0lFlpiw.png" alt="" class="item-img">
                                    <div class="items-cnt">
                                        <h4><a href="#">cake name</a></h4>
                                    </div>
                                </div>
                                <div class="items-right">
                                    <p class="price">₱ 1500</p>
                                </div>
                            </div>
                            <div class="single-items">
                                <div class="items-left">
                                    <img src="https://ysabelles.ph/cakeShop/public/storage/uploads/products/GGCayXHIZ7QZu0lFlpiw.png" alt="" class="item-img">
                                    <div class="items-cnt">
                                        <h4><a href="#">cake name</a></h4>
                                    </div>
                                </div>
                                <div class="items-right">
                                    <p class="price">₱ 1500</p>
                                </div>
                            </div>
                        </div>
                        <div class="coupon-code-tgl">
                            <a href="#" class="textBtn">Apply Coupon</a>
                            <div class="form-group">
                                <input type="number" class="form-control" id="" placeholder="Have a promo code?">
                                <button type="button" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                        <div class="pickup-txt">
                            <h6>Pickup<span>Free</span></h6>
                            <p>Quezon City • Thu, Aug 10, 10:00 AM</p>
                        </div>
                        <div class="total-txt">
                            <h4>Total</h4>
                            <h2>₱1,579.89</h2>
                            <p>Fees & taxes: ₱79.89</p>
                        </div>
                        <div class="instructions-cnt">
                            <h5>Instructions</h5>
                            <p>To avoid delays, schedule your courier in advance via Lalamove.And send us your tracking:</p>
                            <p>Pls tell your rider to knock on the Green Gate and give your name and code</p>
                        </div>
                        <div class="btn-input">
                            <button type="button" class="btn btn-primary" id="confirmOrder">Confirm Order</button>
                            <div class="form-group d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" name="">
                                <label class="m-0">Save my info for future orders</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('content')
<div class="slider-area slider-bg1" style="display:none">
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

@if(isset($products) && !empty($products))
<section class="popular-items" id="ourexclusivecakes">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle text-center mb-60">
                    <h2>Our Exclusive Cakes</h2>
                </div>
            </div>
        </div>
        <div class="popular-active">

            <div class="row justify-content-center" id="errorMsg" style="display:none;">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="section-tittle text-center" id="errorMsgAlert">
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach ($products as $list)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-items text-center mb-30">
                            <div class="items-top">
                                <img src="{{url('storage/'.$list['ProductImages'][0]->image)}}" alt="">
                            </div>
                            <div class="items-bottom">
                                <h4><a href="#">{{$list['name']}} </a></h4>
                                <p>{{$list['description']}}</p>
                                <a href="javascript:void(0)" class="btn order-btn addToCart" data-id="{{$list['id']}}">
                                    <i class="fa fa-ruble-sign" style="margin-right: 0px;"></i>
                                    {{$list['price']}} | Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-md-12" style="width: 100%; padding: 0 15px;">
                        <img src="" id="proImg" style="width: 100%;">
                        <div class="text-center">
                            <input type="hidden" name="productId" id="proId">
                            <h3 id="proName"></h3>
                            <h4 id="proPrice"></h4>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn" id="btnMinus"><i class="fa fa-minus"></i></button>
                            <input type="number" name="qty" id="proQty" min="1" step="1" value="1">
                            <button type="button" class="btn" id="btnPlus"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addToCart">Add To Cart</button>
            </div>
        </div>
    </div>
</div>
@endif

<section class="popular-items section-padding40" id="cartMainListDiv" @if(count($cart_products)==0) style="display:none" @endif>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle">
                    <button type="button" class="btn btn-primary w-100" id="previewCart">Preview Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div id="cartListDiv" class="mt-40 container" style="display: none;">

        @if(isset($cart_products) && count($cart_products)>0)

        
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                        <div class="section-tittle mb-60">
                            <h2 style="float: left;">Your Order</h2> <h3 style="color:#000;float: right;">₱ {{number_format($cart_total, 2, '.', '')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="orderProcess">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                            <div class="single-items">
                                @foreach ($cart_products as $list)
                                    @php
                                        $proImage = '';
                                        if(isset($list['product']['ProductImages'][0])){
                                            $proImage = url('storage/'.$list['product']['ProductImages'][0]['image']);
                                        }                                
                                    @endphp
                                    <div class="col-xl-12 col-lg-4 col-md-6 col-sm-6">
                                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">
                                            <img src="{{$proImage}}" alt="">
                                        </div>
                                        <div class="col-xl-8 col-lg-4 col-md-6 col-sm-6 pull-left">
                                            <h4><a href="#">{{$list['product']['name']}} </a></h4>
                                            <i class="fa fa-ruble-sign" style="margin-right: 0px;"></i>
                                            {{number_format($list['sub_total'], 2, '.', '')}}                                        
                                        </div>

                                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">
                                            <button type="button" class="btn" onclick="updateCart({{$list['product']['id']}},0)" id="btnMinusCart{{$list['product']['id']}}"><i class="fa fa-minus"></i></button>

                                            <input type="number" name="qty" id="proQtyCart{{$list['product']['id']}}" min="1" step="1" value="{{$list['quantity']}}">

                                            <button type="button" class="btn" onclick="updateCart({{$list['product']['id']}},1)" id="btnPlusCart{{$list['product']['id']}}"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<section class="popular-items section-padding40" id="calendarDiv">
    <div class="container">

        <div class="row justify-content-center" id="errorMsgDate" style="display:none;">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle text-center" id="errorMsgDateAlert">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle mb-60">
                    <h2>When do you want your order?</h2>
                    <p>Showing next available dates <a style="color:#000;float: right;" href="javascript:void(0)" data-toggle="modal" data-target="#datepickerModal">More dates</a></p>
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
                        <select class="order_time" name="order_time" id="order_time" onchange="selectTime(this.value)">
                            <option value="">Pick a time</option>
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

<!-- Modal -->
<div class="modal fade" id="datepickerModal" tabindex="-1" role="dialog" aria-labelledby="datepickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="datepickerContainer"></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<section class="popular-items section-padding40" id="whatsYourName" style="display: none;">
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
                        <input type="text" name="whatsYourNameField" id="whatsYourNameField" placeholder="Enter Here" class="form-control" @if(!empty($user->name)) value="{{$user->name}}" @endif>
                        <p id="whatsYourNameFieldError" class="error"></p>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnwhatsYourName">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40" id="whatsYourEmail" style="display: none;">
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
                        <input type="email" name="whatsYourEmailField" id="whatsYourEmailField" placeholder="coco@gmail.com" class="form-control" @if(!empty($user->email)) value="{{$user->email}}" @endif>
                        <p id="whatsYourEmailFieldError" class="error"></p>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="">
                        <label class="m-0">I'd like to receive shop offers and updates through email</label>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnwhatsYourEmail">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40" id="whatsYourPhone" style="display: none;">
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
                        <input type="number" name="whatsYourPhoneField" id="whatsYourPhoneField" placeholder="081234 56789" class="form-control" @if(!empty($user->phone)) value="{{$user->phone}}" @endif>
                        <p id="whatsYourPhoneFieldError" class="error"></p>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnwhatsYourPhone">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-items section-padding40" id="whatsYourNotes"style="display: none;">
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
                        <input type="text" name="whatsYourNotesField" id="whatsYourNotesField" placeholder="Enter Here" class="form-control">
                    </div>
                    <button type="button" class="btn btn-primary" id="btnwhatsYourNotes">Skip</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="popular-items section-padding40" id="paymentDiv" style="display: none;">
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
                    <div class="radio-group-list" id="payment_type_radio">
                        <div class="radio-group-item" >
                            <input type="radio" id="cod" name="payment_type" value="cod">
                            <label for="cod">Cash On Delivery</label>
                        </div>
                        <div class="radio-group-item">
                            <input type="radio" id="gcash" name="payment_type" value="gcash">
                            <label for="gcash">GCash</label>
                        </div>
                        <div class="radio-group-item">
                            <input type="radio" id="paypal" name="payment_type" value="paypal">
                            <label for="paypal">Paypal</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="popular-items section-padding40" id="confirmOrderDiv" style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle">
                    <button type="button" class="btn btn-primary w-100" id="confirmOrder">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="popular-items section-padding40" id="orderPlacedDiv" style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle">
                    <button type="button" class="btn btn-primary w-100" id="confirmOrder">Order Placed</button>
                </div>
            </div>
        </div>
    </div>
</section>

<input type="text" name="hidden_order_date" id="hidden_order_date">
<input type="text" name="hidden_order_time" id="hidden_order_time">
<input type="text" name="hidden_customer_name" id="hidden_customer_name" @if(!empty($user->name)) value="{{$user->name}}" @endif>
<input type="text" name="hidden_customer_email" id="hidden_customer_email" @if(!empty($user->email)) value="{{$user->email}}" @endif>
<input type="text" name="hidden_customer_phone" id="hidden_customer_phone" @if(!empty($user->phone)) value="{{$user->phone}}" @endif>
<input type="text" name="hidden_short_notes" id="hidden_short_notes">
<input type="text" name="hidden_payment_type" id="hidden_payment_type">

@endsection
@section('jQuery')
    <script>
        $(function(){
            $('#my_calendar_calSize').rescalendar({
                id: 'my_calendar_calSize',
                dateFormat: "yy-mm-dd",
                jumpSize: -1,
                calSize: 5,
                dataKeyField: 'name',
                dataKeyValues: ['']
            });
        });

        $('.addToCart').on('click', function(){

            $("#proQty").val(1);
            var pId = $(this).attr('data-id');
            $.ajax({
                url: "{{route('getProduct')}}",
                type: "post",
                data: {'id': pId, '_token' : $('meta[name=_token]').attr('content') },
                success: function(data){
                    $('#proId').val(data.id);
                    $('#proImg').attr('src',data.image);
                    $('#proName').html(data.name);
                    $('#proPrice').html(data.price);
                    $('#proImg').attr('src',data.image);
                    $('#addToCartModal').modal('show');
                }
            });
        });

        $('#btnMinus').on('click', function(){
            var qty = $('#proQty').val();
            if(qty > 1){
                var newQty = parseInt(qty) - 1;
                $('#proQty').val(newQty);
            }
        });

        $('#btnPlus').on('click', function(){
            var qty = $('#proQty').val();
            var newQty = parseInt(qty) + 1;
            $('#proQty').val(newQty);
        });

        $('#addToCart').on('click', function(){
            var pId = $('#proId').val();
            var pQty = $('#proQty').val();
            $.ajax({
                url: "{{route('addToCart')}}",
                type: "post",
                data: {'pId': pId, 'qty': pQty, '_token' : $('meta[name=_token]').attr('content') },
                success: function(data){
                    if(data == 0){
                        window.location.href = "{{url('/login')}}";
                    }else{
                        $('#addToCartModal').modal('hide');

                        $.ajax({
                            url: "{{route('getCartProducts')}}",
                            type: "post",
                            data: {'_token' : $('meta[name=_token]').attr('content') },
                            success: function(data){
                                //$(data).insertBefore('#calendarDiv');
                                $("#cartListDiv").html(data);
                                $("#cartMainListDiv").css("display", "");

                                swal($('#proName').text(), "Added!", "success");

                                $("html, body").animate({
                                    scrollTop: $("#cartMainListDiv").offset().top-200
                                }, 1000);

                                $("#errorMsg").css("display", "none");

                                $("#errorMsgAlert").html('');

                                selectionCheck(); 
                            }
                        });
                    }
                }
            });
        });

        // update cart
        function updateCart(productId, type) {
            var proQtyCart = $("#proQtyCart"+productId).val();

            if(type==0){
                $("#proQtyCart"+productId).val(parseInt(proQtyCart)-1);
                var qty = (parseInt(proQtyCart)-1);
            } else if(type==1){
                $("#proQtyCart"+productId).val(parseInt(proQtyCart)+1);
                var qty = (parseInt(proQtyCart)+1);
            }

            $.ajax({
                url: "{{route('updateToCart')}}",
                type: "post",
                data: {'pId': productId, 'qty': qty, '_token' : $('meta[name=_token]').attr('content') },
                success: function(data){
                    if(data == 0){
                        window.location.href = "{{url('/login')}}";
                    }else{

                        $.ajax({
                            url: "{{route('getCartProducts')}}",
                            type: "post",
                            data: {'_token' : $('meta[name=_token]').attr('content') },
                            success: function(data){

                                if(data == 0){
                                    
                                    $("#errorMsg").css("display", "");

                                    $("#errorMsgAlert").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button>Sorry, you do not have any product in the cart. Please add the product to the cart.</div>');
                                    
                                    
                                    $("html, body").animate({
                                        scrollTop: $("#ourexclusivecakes").offset().top
                                    }, 1000);

                                }else{
                                
                                    $.ajax({
                                        url: "{{route('getCartTotal')}}",
                                        type: "post",
                                        data: {'pId': productId, 'qty': qty, '_token' : $('meta[name=_token]').attr('content') },
                                        success: function(dataresponce){
                                            if(dataresponce == 0){
                                                $("#total_amount").text('₱ 0.00');
                                                $("#cartMainListDiv").css("display", "none");
                                            }else{
                                                $("#total_amount").text('₱ '+dataresponce);
                                                $("#cartMainListDiv").css("display", "");
                                            }
                                        }
                                    });

                                }

                                $("#cartListDiv").html(data);
                            }
                        });
                    }
                }
            });
        }

        // toggle cart
        $(function() {
            $('#previewCart').on('click', function() {
                $('#cartListDiv').slideToggle();
            });
        });

        //datepicker js code
        function initializeDatepicker() {
            $('#datepickerContainer').datepicker({
                format: 'yyyy-mm-dd', // Customize the date format as needed
                autoclose: true,
                startDate: '+1d',
                minDate : 1,
                onSelect: function(dateText, inst) {
                  // Close the datepicker after date selection
                  $(this).datepicker("hide");
                }
            });
        }

        // more dates
        $('#datepickerContainer').on('changeDate', function() {

            $('#my_calendar_calSize').rescalendar({
                id: 'my_calendar_calSize',
                dateFormat: "yy-mm-dd",
                jumpSize: 0,
                calSize: 5,
                dataKeyField: 'name',
                dataKeyValues: ['']
            });

            var customDate = $('#datepickerContainer').datepicker('getFormattedDate');
            $(".refDate").val(customDate);
            $('#datepickerModal').modal('toggle');
            $('.move_to_tomorrow').trigger("click");
            $('.move_to_yesterday').trigger("click");      
            $("#hidden_order_date").val(customDate);

            selectionCheck();      
        });

        $('#datepickerModal').on('shown.bs.modal', function () {
            initializeDatepicker();
        });

        $('#datepickerModal').on('hidden.bs.modal', function () {
            $('#datepickerContainer').datepicker('destroy');
        });

        // date select
        $(document).on("click",".rescalendar_table", function(e){
            $("#hidden_order_date").val($(".refDate").val());

            var element = document.querySelector('.nice-select');
            $('.list').children("li[data-value='']").remove();
            
            if($(".order_time option:selected").val()==''){
                $('.nice-select .current').text('09:00 AM');            
                $('.list li:first-child').addClass('selected');
                $('.order_time option[value="09:00"]').attr('selected','selected');
            }

            element.classList.add("open");
            element.niceSelect('update');

            selectionCheck(); 

        }); 

        // time select
        function selectTime(order_time){

            if(order_time!=''){

                $("#hidden_order_time").val(order_time);
                selectionCheck(); 

            }
        }

        function selectionCheck() {

            $.ajax({
                url: "{{route('getCartProducts')}}",
                type: "post",
                data: {'_token' : $('meta[name=_token]').attr('content') },
                success: function(data){

                    if(data == 0){
                        
                        $("#errorMsg").css("display", "");

                        $("#errorMsgAlert").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button>Sorry, you do not have any product in the cart. Please add the product to the cart.</div>');
                        
                        
                        $("html, body").animate({
                            scrollTop: $("#ourexclusivecakes").offset().top
                        }, 1000);

                    }else{

                        /*if(($("#hidden_order_date").val()=='') || ($("#hidden_order_time").val()=='')){

                            $("#errorMsgDate").css("display", "");

                            $("#errorMsgDateAlert").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button>Please select the date & time,</div>');
                            
                            
                            $("html, body").animate({
                                scrollTop: $("#calendarDiv").offset().top
                            }, 1000);

                        } else if($("#whatsYourNameField").val()==''){

                            $("#whatsYourName").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#whatsYourName").offset().top-100
                            }, 1000);

                        } else if($("#whatsYourEmailField").val()==''){

                            $("#whatsYourEmail").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#whatsYourEmail").offset().top-100
                            }, 1000);

                        } else if($("#whatsYourPhoneField").val()==''){

                            $("#whatsYourPhone").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#whatsYourPhone").offset().top-100
                            }, 1000);

                        } else if($("#whatsYourNotesField").val()==''){

                            $("#whatsYourNotes").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#whatsYourNotes").offset().top-100
                            }, 1000);

                        } else if($('input[name="payment_type"]').is(':not(:radio)')){

                            $("#paymentDiv").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#paymentDiv").offset().top-100
                            }, 1000);
                        }*/ 



                        if(($("#hidden_order_date").val()!='') && ($("#hidden_order_time").val()!='')){

                            $("#whatsYourName").css("display", "");
                            $("#whatsYourEmail").css("display", "");
                            $("#whatsYourPhone").css("display", "");
                            $("#whatsYourNotes").css("display", "");
                            $("#paymentDiv").css("display", "");

                            $("html, body").animate({
                                scrollTop: $("#whatsYourName").offset().top-100
                            }, 1000);

                        } else {

                            /*$("#errorMsgDate").css("display", "");

                            $("#errorMsgDateAlert").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button>Please select the date & time,</div>');*/
                            
                            
                            $("html, body").animate({
                                scrollTop: $("#calendarDiv").offset().top
                            }, 1000);
                        }
                    }
                }
            });
        }

        $('#btnwhatsYourName').on('click', function(){
            var whatsYourNameField = $('#whatsYourNameField').val();

            if(whatsYourNameField!=''){

                $("#hidden_customer_name").val(whatsYourNameField);
                $("#whatsYourEmail").css("display", "");

                $("html, body").animate({
                    scrollTop: $("#whatsYourEmail").offset().top-100
                }, 1000);

                $("#whatsYourNameFieldError").text('');

            } else {
                $("#whatsYourNameFieldError").text('Please fill in a value.');
            }
        });

        $('#btnwhatsYourEmail').on('click', function(){
            var whatsYourEmailField = $('#whatsYourEmailField').val();

            if(whatsYourEmailField!=''){

                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
                if(!regex.test(whatsYourEmailField)){   
                    $("#whatsYourEmailFieldError").text('Please fill in a valid value.');
                } else{
                    
                    $("#hidden_customer_email").val(whatsYourEmailField);
                    $("#whatsYourPhone").css("display", "");

                    $("html, body").animate({
                        scrollTop: $("#whatsYourPhone").offset().top-100
                    }, 1000);

                    $("#whatsYourEmailFieldError").text('');
                }
            } else {
                $("#whatsYourEmailFieldError").text('Please fill in a valid value.');
            }
        });

        $('#btnwhatsYourPhone').on('click', function(){
            var whatsYourPhoneField = $('#whatsYourPhoneField').val();

            if(whatsYourPhoneField!=''){

                $("#hidden_customer_phone").val(whatsYourPhoneField);
                $("#whatsYourNotes").css("display", "");

                $("html, body").animate({
                    scrollTop: $("#whatsYourNotes").offset().top-100
                }, 1000);

                $("#whatsYourPhoneFieldError").text('');
            } else {
                $("#whatsYourPhoneFieldError").text('Please fill in a valid value.');
            }
        });

        $('#whatsYourNotesField').keyup(function() { 
            if ($('#whatsYourNotesField').val() != '') {
                $("#btnwhatsYourNotes").text('Next');
                $("#hidden_short_notes").val($('#whatsYourNotesField').val());
            } else {
                $("#btnwhatsYourNotes").text('Skip');
            }
        });

        $('#btnwhatsYourNotes').on('click', function(){
            var whatsYourNotesField = $('#whatsYourNotesField').val();

            if(whatsYourNotesField!=''){
                $("#hidden_short_notes").val(whatsYourNotesField);
            }

            $("#paymentDiv").css("display", "");

            $("html, body").animate({
                scrollTop: $("#paymentDiv").offset().top-100
            }, 1000);
        }); 

        $('#payment_type_radio input:radio').click(function() {
            $("#hidden_payment_type").val($(this).val());

            $("#confirmOrderDiv").css("display", "");

            $("html, body").animate({
                scrollTop: $("#confirmOrderDiv").offset().top-100
            }, 1000);
        });

        $('#confirmOrder').on('click', function(){
            var order_date = $('#hidden_order_date').val();
            var order_time = $('#hidden_order_time').val();
            var customer_name = $('#hidden_customer_name').val();
            var customer_email = $('#hidden_customer_email').val();
            var customer_phone = $('#hidden_customer_phone').val();
            var short_notes = $('#hidden_short_notes').val();
            var payment_type = $('#hidden_payment_type').val();

            $.ajax({
                url: "{{route('addOrder')}}",
                type: "post",
                data: {'order_date': order_date, 'order_time': order_time, 'customer_name': customer_name, 'customer_email': customer_email, 'customer_phone': customer_phone, 'short_notes': short_notes, 'payment_type': payment_type, '_token' : $('meta[name=_token]').attr('content') },
                success: function(data){
                    if(data == 0){
                        window.location.href = "{{url('/login')}}";
                    }else if(data == 1){
                        $("#errorMsg").css("display", "");

                        $("#errorMsgAlert").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button>Sorry, you do not have any product in the cart. Please add the product to the cart.</div>');
                        
                        
                        $("html, body").animate({
                            scrollTop: $("#ourexclusivecakes").offset().top
                        }, 1000);
                    } else if(data == 2){

                        $("#ourexclusivecakes").css("display", "none");
                        $("#cartMainListDiv").css("display", "none");
                        $("#calendarDiv").css("display", "none");
                        $("#whatsYourName").css("display", "none");
                        $("#whatsYourEmail").css("display", "none");
                        $("#whatsYourPhone").css("display", "none");
                        $("#whatsYourNotes").css("display", "none");
                        $("#paymentDiv").css("display", "none");
                        $("#confirmOrderDiv").css("display", "none");

                        $("#orderPlacedDiv").css("display", "");

                        $("html, body").animate({
                            scrollTop: $("#orderPlacedDiv").offset().top
                        }, 1000);
                    }
                }
            });
        });

    </script>
@endsection

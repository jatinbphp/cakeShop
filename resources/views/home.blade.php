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
<!-- <section class="popular-items section-padding40"> -->
<section class="popular-items">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10">
                <div class="section-tittle text-center mb-60">
                    <h2>Our Exclusive Cakes</h2>
                </div>
            </div>
        </div>
        <div class="popular-active">
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

<section class="popular-items section-padding40">
    <div class="container">
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
                        <select class="order_time" name="order_time" id="order_time">
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

<section class="popular-items section-padding40" style="display: none;">
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
<section class="popular-items section-padding40" style="display: none;">
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
<section class="popular-items section-padding40" style="display: none;">
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
<section class="popular-items section-padding40" style="display: none;">
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

<section class="popular-items section-padding40" style="display: none;">
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
                    }
                }
            });
        });

        //datepicker js code
        function initializeDatepicker() {
            $('#datepickerContainer').datepicker({
                format: 'yyyy-mm-dd', // Customize the date format as needed
                todayBtn: true,
                autoclose: true,
                startDate: '-0m'
            });
        }

        $('#datepickerModal').on('shown.bs.modal', function () {
            initializeDatepicker();
        });

        $('#datepickerModal').on('hidden.bs.modal', function () {
            $('#datepickerContainer').datepicker('destroy');
        });

    </script>
@endsection

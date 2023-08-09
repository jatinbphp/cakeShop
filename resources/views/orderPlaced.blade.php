@extends('layouts.app')
@section('content')
    <section class="popular-items section-padding40" id="confirmOrderDiv" style="display: block;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                    <div class="confirmOrder-sec">
                        <div class="section-tittle">
                            <h3><strong>Total</strong></h3>
                            <div class="edit-cart">
                                <h3><strong>₱ {{number_format($order['order_total'], 2, '.', '')}}</strong></h3>
                                <p class="text-danger">{{ucfirst($order['status'])}}</p>
                            </div>
                        </div>
                        <div class="item-list payDetails">
                            <div class="single-items">
                                <div class="items-left">
                                    <p>Pay Using</p>
                                </div>
                                <div class="items-right">
                                    <h6>{{strtoupper($order['payment_type'])}}</h6>
                                </div>
                            </div>
                            <div class="single-items">
                                <div class="items-left">
                                    <p>Accout name</p>
                                    <h6 id="accountName">{{$order['customer_name']}} - {{$order['customer_email']}}</h6>
                                    <span id="accountNameCopied" class="text-danger"></span>
                                </div>
                                <div class="items-right">
                                    <a href="javascript:void(0)" class="cpy-icon" onclick="copyToClipboard('#accountName')"><i class="far fa-copy"></i></a>
                                </div>
                            </div>
                            <div class="single-items">
                                <div class="items-left">
                                    <p>Accout number</p>
                                    <h6 id="accountNumber">{{$order['customer_phone']}}</h6>
                                    <span id="accountNumberCopied" class="text-danger"></span>
                                </div>
                                <div class="items-right">
                                    <a href="javascript:void(0)" class="cpy-icon" onclick="copyToClipboard('#accountNumber')"><i class="far fa-copy"></i></a>
                                </div>
                            </div>
                            <div class="single-items">
                                <div class="items-left">
                                    <p>ID</p>
                                    <h6 id="accountId">{{$order['unique_id']}}</h6>
                                    <span id="accountIdCopied" class="text-danger"></span>
                                </div>
                                <div class="items-right">
                                    <a href="javascript:void(0)" class="cpy-icon" onclick="copyToClipboard('#accountId')"><i class="far fa-copy"></i></a>
                                </div>
                            </div>
                        </div>
                        <p>Please include your order ID in the reference. Payment must be completed within 30 minutes. Do send us a screenshot via Viber: 09060649461 IG: ysabellesmnl</p>
                    </div>
                    <div class="conBck-sec">
                        <div class="item-list">
                            <div class="single-items">
                                <h6>
                                    <i class="fas fa-phone-alt"></i>
                                    Contact Ysabelle's
                                    </br>
                                    </br>
                                    09060649461
                                </h6>
                            </div>
                            <div class="single-items">
                                <h6><i><img src="https://ysabelles.ph/cakeShop/website/images/logo-transparent.png"></i><a href="{{ route('home')}}">Back to Ysabelle's</a></h6>
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

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $(element+'Copied').text('Copied');

        setTimeout(function() { 
            $(element+'Copied').text('');
        }, 2000);
    }
</script>
@endsection

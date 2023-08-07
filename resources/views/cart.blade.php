@if(isset($cart_products) && !empty($cart_products))
<div class="">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
            <div class="section-tittle mb-60">
                <h2 style="float: left;">Your Order</h2> <h3 style="color:#000;float: right;" id="total_amount">₱ {{$cart_total}}</h3>
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
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 pull-left">
                                <img src="{{$proImage}}" alt="">
                            </div>
                            <div class="col-xl-10 col-lg-4 col-md-6 col-sm-6 pull-left">
                                <h4><a href="#">{{$list['product']['name']}} </a></h4>
                                ₱ {{number_format($list['sub_total'], 2, '.', '')}}
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

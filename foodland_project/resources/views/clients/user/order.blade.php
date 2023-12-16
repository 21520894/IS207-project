{{--@extends('layouts/clients')--}}
{{--@section('content')--}}
<!-- Order page -->
@if(session('order_status'))
    @php(toastr()->success('Thanh toan thanh cong'))
@endif
<section id="order__page">
    <form action="{{route('vnpay.payment')}}" id="payment-form" method="POST">
        @csrf
    <div class="order__page-container grid__full-width grid__row">
        <div class="order__cart-container grid__col-8">
            <h1 class="order__cart-header">My Cart (<span class="order__cart-quantity">0</span>)</h1>
            <div class="order__cart-wrapper grid__row">
                <div class="grid__col-4-8">

                    <div class="order__cart-item-wrapper">

                    </div>
                    <a href="#menu__page" class="order__cart-btn btn btn--primary">Add more foods</a>
                </div>
                <div class="grid__col-4-8">
                    <div class="order__cart-option">
                        <div class="order__cart-checkbox">
                            <h1 class="order__checkbox-header">Please tick if you need</h1>
                            <div class="order__checkbox-container">
                                <div class="order__checkbox-wrapper">
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Chili oil
                                    </span>
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Cutlery
                                    </span>
                                </div>
                                <div class="order__checkbox-wrapper">
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Chili Soyce
                                    </span>
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Ketchup
                                    </span>
                                </div>
                                <div class="order__checkbox-wrapper">
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Reheating Foil
                                    </span>
                                    <span class="order__checkbox">
                                        <input type="checkbox" class="order__checkbox-item"> Instructions
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="order__cart-voucher">
                            <h1 class="order__voucher-header">E-voucher</h1>
                            <h2 class="order__voucher-sub-header">Input your E-voucher (if available)</h2>
                            <input type="text" class="order__voucher-input" placeholder="Enter you promocode ...">
                        </div>
                        <div class="order__cart-radio">
                            <h1 class="order__radio-header">Payment Method</h1>
                            <div class="order__radio-wrapper">
                                <span class="order__radio">
                                    <input type="radio" name="order__payment" class="order__radio-item" value="COD" checked>Cash on Delivery
                                </span>
                                <span class="order__radio">
                                    <input type="radio" name="order__payment" class="order__radio-item" value="VNPAY">VNPAY
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order__pay-wrapper grid__col-4">
            <div class="order__pay-info">
                <h1 class="order__info-header">Delivering to:</h1>
                <p class="order__address-info">1342 Morris Street</p>
                <p class="order__phone-info">0912345678</p>
            </div>
            <div class="order__pay-bill">
                <h1 class="order__bill-header">Order Summary</h1>
                <ul class="order__bill-info-list">
                    <h1 class="order__info-header">Delivery items (<span class="order__cart-quantity">0</span>)</h1>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Sub-total</p>
                        <p class="order__item-price order__sub-total">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Shipping</p>
                        <p class="order__item-price order__shipping">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">VAT 8%</p>
                        <p class="order__item-price order__vat">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Discount</p>
                        <p class="order__item-price order__discount">0 VND</p>
                    </li>
                </ul>

                    <div class="order__bill-total">
                        <h1 class="order__bill-header">Total</h1>
                        <div class="order__bill-price order__total" id="totalValue" data-currency="VND">0 VND</div>
                    </div>
                    <input type="hidden" id="totalInput" name="total" value="">
                    <input type="submit" style="width: 92%" class="order__pay-btn btn btn--primary" name="redirect" value="ORDER">

            </div>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('payment-form').addEventListener('submit', function (event) {

            // Lấy giá trị từ thẻ div
            let totalValue = document.getElementById('totalValue').innerText;

            // Xử lý chuỗi để lấy giá trị số
            let numericValue = parseFloat(totalValue);

            // Gán giá trị số vào input hidden
            document.getElementById('totalInput').value = numericValue;

        });
    </script>
</section>
<!-- End of Order page -->
{{--@endsection--}}

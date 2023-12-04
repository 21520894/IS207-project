<?php $__env->startSection('content'); ?>
<!-- Order page -->
<section id="order__page">
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
                                    <input type="radio" name="order__payment" class="order__radio-item" checked>Cash on Delivery
                                </span>
                                <span class="order__radio">
                                    <input type="radio" name="order__payment" class="order__radio-item">ATM
                                </span>
                                <span class="order__radio">
                                    <input type="radio" name="order__payment" class="order__radio-item">VISA
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
                    <div class="order__bill-price order__total">0 VND</div>
                </div>
                <span class="order__pay-btn btn btn--primary" onclick="alert('Success')">ORDER</span>
            </div>
        </div>
    </div>
</section>
<!-- End of Order page -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/clients', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views/clients/user/order.blade.php ENDPATH**/ ?>
{{--@extends('layouts/clients')--}}

{{--@section('content')--}}
<!-- Menu page -->
<section id="menu__page">
    <div class="menu__page-container grid__full-width grid__row">
        <div class="menu__order-wrapper grid__col-8">
            <div class="menu__search">
                <i class="menu__search-icon fa-solid fa-magnifying-glass"></i>
                <input type="text" class="menu__search-input" placeholder="What would you like to eat?">
                <i class="menu__search-icon fa-solid fa-bars"></i>
            </div>
            <ul class="menu__category-list grid__row">
                @if($categories!=null)
                    <li class="grid__col-1-8">
                        <div class="menu__category-item menu__category-item--active" name="menu{{1}}">
                            <img class="menu__category-item-img" src="./assets/img/menu{{1}}.jpg" alt="">
                            <h1 class="menu__category-item-name">{{$categories[0]->Title}}</h1>
                        </div>
                    </li>
                    @for($i=1;$i<count($categories);$i++)
                        <li class="grid__col-1-8">
                            <div class="menu__category-item" name="menu{{$i+1}}">
                                <img class="menu__category-item-img" src="./assets/img/menu{{$i+1}}.jpg" alt="">
                                <h1 class="menu__category-item-name">{{$categories[$i]->Title}}</h1>
                            </div>
                        </li>
                    @endfor
                @endif

            </ul>
            <div class="menu__product-list-wrapper menu__product-scroll-btn--active">
                <span class="menu__product-scroll-btn btn--hover btn-left"><i class="fa-solid fa-chevron-left"></i></span>
                <ul class="menu__product-list menu__product-list--active grid__row" name="menu1">
                    @if($products != null)
                        @foreach($products as $product)
                            <li class="grid__col-2-8">
                                <div class="menu__product-wrapper" id="{{$product->ID}}">
                                    <span class="menu__product-label">Recommended</span>
                                    <img src="./assets/img/{{$product->Image}}" alt="" class="menu__product-img" name="productDetail">
                                    <h1 class="menu__product-name">{{$product->Name}}</h1>
                                    <span class="menu__product-btn btn--hover" id="{{$product->ID}}"><img src="./assets/img/item-btn.png" alt=""></span>
                                    <h2 class="menu__product-price">{{$product->Price}} VND</h2>
                                    <p class="menu__product-desc">{{$product->Description}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <span class="menu__product-scroll-btn btn--hover btn-right"><i class="fa-solid fa-chevron-right"></i></span>
            </div>
        </div>
        <div class="menu__user-wrapper grid__col-4">
            <div class="menu__user-address">
                <h1 class="menu__address-header">My Address</h1>
                <p class="menu__address-sub-header">Delivery address</p>
                <p class="menu__address-info">1342 Morris Street</p>
                <div class="menu__address-ship">
                    <p class="menu__ship-time"><i class="menu__ship-icon fa-solid fa-clock"></i>15-20 mins</p>
                    <p class="menu__ship-distance"><i class="menu__ship-icon fa-solid fa-location-dot"></i>5km</p>
                </div>
                <span class="menu__address-change-btn" name="changeAddress">*Change address direction*</span>
            </div>
            <div class="menu__cart-item-wrapper">
                <h1 class="menu__cart-header">My Cart</h1>
            </div>
            <a href="#order__page" class="menu__cart-btn btn btn--primary">Check out</a>
        </div>
    </div>
</section>
<!-- End of Menu page -->
<script>

</script>

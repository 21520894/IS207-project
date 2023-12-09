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

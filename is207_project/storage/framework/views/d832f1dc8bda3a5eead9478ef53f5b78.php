<?php $__env->startSection('content'); ?>
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
                <?php
                    $categories = DB::connection('mysql')->select('select * from category');
                ?>
                <?php if($categories!=null): ?>
                    <?php for($i=0;$i<count($categories);$i++): ?>
                        <li class="grid__col-1-8">
                            <div class="menu__category-item menu__category-item--active" name="menu<?php echo e($i+1); ?>">
                                <img class="menu__category-item-img" src="./assets/img/menu<?php echo e($i+1); ?>.jpg" alt="">
                                <h1 class="menu__category-item-name"><?php echo e($categories[$i]->Title); ?></h1>
                            </div>
                        </li>
                    <?php endfor; ?>
                <?php endif; ?>

            </ul>
            <div class="menu__product-list-wrapper menu__product-scroll-btn--active">
                <span class="menu__product-scroll-btn btn--hover btn-left"><i class="fa-solid fa-chevron-left"></i></span>
                <ul class="menu__product-list menu__product-list--active grid__row" name="menu1">
                    <li class="grid__col-2-8">
                        <div class="menu__product-wrapper" id="item11">
                            <span class="menu__product-label">Recommended</span>
                            <img src="./assets/img/item11.jpg" alt="" class="menu__product-img" name="productDetail">
                            <h1 class="menu__product-name">Beef wellington</h1>
                            <span class="menu__product-btn btn--hover"><img src="./assets/img/item-btn.png" alt=""></span>
                            <h2 class="menu__product-price">149000 VND</h2>
                            <p class="menu__product-desc">Our Beef Wellington is made with the finest ingredients, including prime beef tenderloin, wild mushrooms, and imported puff pastry.
                                <br>The steak is seasoned to perfection and seared over high heat to lock in the juices, then wrapped in the duxelles and puff pastry. The Wellington is then baked until the pastry is golden brown and the steak is cooked to your desired doneness.
                                <br>Beef Wellington is typically served with a side of mashed potatoes and asparagus, but it can also be paired with a variety of other vegetables, such as green beans, roasted carrots, or Brussels sprouts. For a truly special meal, add a side of truffle oil or foie gras butter.
                            </p>
                        </div>
                    </li>
                </ul>
                <ul class="menu__product-list grid__row" name="menu2">
                    <li class="grid__col-2-8">
                        <div class="menu__product-wrapper" id="item21">
                            <span class="menu__product-label">Recommended</span>
                            <img src="./assets/img/item21.jpg" alt="" class="menu__product-img" name="productDetail">
                            <h1 class="menu__product-name">Item21</h1>
                            <span class="menu__product-btn btn--hover"><img src="./assets/img/item-btn.png" alt=""></span>
                            <h2 class="menu__product-price">10000 VND</h2>
                            <p class="menu__product-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo id dolorum minima aperiam expedita, quae officia. Ipsam nisi assumenda eaque illum amet aperiam dolore at, dolores molestiae numquam officia exercitationem?
                                <br>Aliquam accusamus aliquid quod suscipit, doloremque nostrum, velit, asperiores ipsam at esse quibusdam minima a nesciunt deserunt praesentium magnam molestiae omnis cumque officiis provident ducimus. Molestiae nulla quaerat accusantium odio.
                                <br>Nobis esse libero tenetur eligendi sunt tempore exercitationem id culpa expedita obcaecati quibusdam minus dicta numquam labore ad nemo nihil reprehenderit ducimus itaque, rem quidem eos quisquam porro? Doloribus, asperiores.
                            </p>
                        </div>
                    </li>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/clients', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views/clients/user/menu.blade.php ENDPATH**/ ?>
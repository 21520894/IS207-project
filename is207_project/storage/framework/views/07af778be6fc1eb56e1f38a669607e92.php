<!-- Menu -->
<ul class="menu__wrapper">
    <li class="menu__item">
        <a class="menu__item-link" href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="menu__item-icon fa-solid fa-house"></i>
            Dashboard
        </a>
    </li>
    <li class="menu__item">
        <a class="menu__item-link" href="<?php echo e(route('admin.dish.show')); ?>">
            <i class="menu__item-icon fa-solid fa-bars-progress"></i>
            Dish Manager
        </a>
    </li>
    <li class="menu__item">
        <a class="menu__item-link" href="<?php echo e(route('admin.user.show')); ?>">
            <i class="menu__item-icon fa-solid fa-user"></i>
            User Manager
        </a>
    </li>
    <li class="menu__item">
        <a class="menu__item-link" href="?action=null&query=null" onclick="return false">
            <i class="menu__item-icon fa-solid fa-star"></i>
            E-Commerce
            <i class="menu__item-icon fa-solid fa-chevron-down"></i>
        </a>
        <ul class="menu__sub-item">
            <li class="menu__item">
                <a class="menu__item-link" href="<?php echo e(route('admin.order.show')); ?>">
                    Order Manager
                </a>
            </li>
            <li class="menu__item">
                <a class="menu__item-link" href="<?php echo e(route('admin.voucher.show')); ?>">
                    Voucher Manager
                </a>
            </li>
        </ul>
    </li>
    <li class="menu__item">
        <a class="menu__item-link" href="?action=report&query=null">
            <i class="menu__item-icon fa-solid fa-filter"></i>
            Report
        </a>
    </li>
</ul>
<!-- End of Menu -->

<?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views/admin/components/menu.blade.php ENDPATH**/ ?>
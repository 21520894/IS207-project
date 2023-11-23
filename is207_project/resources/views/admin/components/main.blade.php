@php
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $query = isset($_GET['query']) ? $_GET['query'] : '';
@endphp
@if ($action == 'userManager' && $query == 'edit')
    @include('admin.user.edit')
@endif

{{--@if ($action == 'dishManager' && $query == 'null')--}}
{{--    @include('admin.components.dish.dishManager')--}}
{{--@elseif ($action == 'dishManager' && $query == 'edit')--}}
{{--    @include('admin.components.dishManager.editDish')--}}
{{--@elseif ($action == 'userManager' && $query == 'null')--}}
{{--    @include('admin.components.userManager.userManager')--}}
{{--@elseif ($action == 'userManager' && $query == 'edit')--}}
{{--    @include('admin.components.userManager.editUser')--}}
{{--@elseif ($action == 'orderManager' && $query == 'null')--}}
{{--    @include('admin.components.ecommerce.orderManager')--}}
{{--@elseif ($action == 'voucherManager' && $query == 'null')--}}
{{--    @include('admin.components.ecommerce.voucherManager')--}}
{{--@elseif ($action == 'report')--}}
{{--    @include('admin.components.report')--}}
{{--@else--}}
{{--    @include('admin.dashboard')--}}
{{--@endif--}}

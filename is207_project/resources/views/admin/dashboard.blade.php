@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="grid__full-width">
            <div class="grid__row">
                <div class="menu grid__col-2">
                    @include('admin.components.menu')
                </div>
                <div class="grid__col-10 content__main">
                    @include('admin.components.modal')
                    <!-- Dashboard -->
                    <div class="dashboard__wrapper">
                        <div class="grid__row dashboard__header">
                            <div class="dashboard__item-wrapper">
                                <p class="dashboard__item-number">
                                    111
                                    <span class="dashboard__item-name">
                    Register User
                </span>
                                </p>
                                <i class="dashboard__item-icon fa-regular fa-file"></i>
                            </div>
                            <div class="dashboard__item-wrapper">
                                <p class="dashboard__item-number">
                                    811
                                    <span class="dashboard__item-name">
                    Daily Visitors
                </span>
                                </p>
                                <i class="dashboard__item-icon fa-regular fa-eye"></i>
                            </div>
                            <div class="dashboard__item-wrapper">
                                <p class="dashboard__item-number">
                                    231
                                    <span class="dashboard__item-name">
                    Daily Orders
                </span>
                                </p>
                                <i class="dashboard__item-icon fa-solid fa-cart-shopping"></i>
                            </div>
                        </div>
                        <div class="grid__row dashboard__body">
                            <div class="dashboard__chart-wrapper grid__col-10">
                                <div class="dashboard__chart">
                                    <h1 class="dashboard__chart-header">REVENUE GROWTH CHART</h1>
                                    <!-- Chart -->
                                </div>
                                <div class="dashboard__chart">
                                    <h1 class="dashboard__chart-header">REVENUE BY DISH GROUP</h1>
                                    <!-- Chart -->
                                </div>
                            </div>
                            <div class="dashboard__total-wrapper grid__col-2">
                                <div class="dashboard__total">
                                    <h1 class="dashboard__total-header">TOTAL REVENUE</h1>
                                    <p class="dashboard__total-number yellow-color">23,739,028</p>
                                </div>
                                <div class="dashboard__total">
                                    <h1 class="dashboard__total-header">REVENUE GROWTH</h1>
                                    <p class="dashboard__total-number red-color">-3%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Dashboard -->

                </div>
            </div>
        </div>
    </div>
@endsection


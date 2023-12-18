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
                    @include('admin.components.main')
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
                                    <canvas class="chart" id="revenueChart"></canvas>
                                </div>
                                <div class="dashboard__chart">
                                    <h1 class="dashboard__chart-header">REVENUE BY DISH GROUP</h1>
                                    <!-- Chart -->
                                    <canvas class="chart" id="dishChart"></canvas>
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

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // Lấy ngày hiện tại
        const currentDate = moment();
        // Tạo một mảng chứa 10 ngày gần đây
        const recentDays = [];
        for (let i = 9; i >= 0; i--) {
            const day = currentDate.clone().subtract(i, 'days');
            recentDays.push(day.format('YYYY-MM-DD')); // Định dạng ngày theo ý muốn
        }

        const xRevenueValues = recentDays;
        const yRevenueValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

        new Chart("revenueChart", {

            type: "line",

            data: {

                labels: xRevenueValues,

                datasets: [{

                    fill: false,

                    lineTension: 0,

                    backgroundColor: "rgba(0,0,255,1.0)",

                    borderColor: "rgba(0,0,255,0.1)",

                    data: yRevenueValues

                }]
            },

            options: {

                legend: {display: false},

                scales: {

                    yAxes: [{ticks: {min: 6, max: 16}}],

                }

            }

        });
        var xDishValues = ["Beef", "Pizza", "Pasta", "Drik", "Food"];

        var yDishValues = [55, 49, 44, 24, 15];

        var barColors = ["red", "green", "blue", "orange", "brown"];


        new Chart("dishChart", {

            type: "bar",

            data: {

                labels: xDishValues,

                datasets: [{

                    backgroundColor: barColors,

                    data: yDishValues
                }]
            },
            options: {
                legend: {display: false},

            }
        });

    </script>
    <style>
        html {
            background-color: #f0f0f0;
        }
        .chart {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection


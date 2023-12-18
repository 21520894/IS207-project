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
                                    <div id="chartContainer">
                                        <canvas id="revenueChart"></canvas>
                                    </div>

                                    <!-- <button id="backButton" style="display: none;">Quay lại biểu đồ cũ</button> -->
                                </div>
                                <div class="dashboard__chart chart">
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
        function getDaysInMonth(year, month) {
            const startDate = moment(`${year}-${month}-01`, 'YYYY-M-DD');
            const endDate = startDate.clone().endOf('month');
            const days = [];

            while (startDate.isSameOrBefore(endDate)) {
                days.push(startDate.format('DD-MM'));
                startDate.add(1, 'day');
            }

            return days;
        }
        // Lấy ngày hiện tại
        const currentDate = moment();
        // Tạo một mảng chứa 12 tháng gần đây
        const recentDays = [];
        for (let i = 11; i >= 0; i--) {
            const day = currentDate.clone().subtract(i, 'months');
            recentDays.push(day.format('YYYY-MM')); // Định dạng ngày theo ý muốn
        }

        var revenueData = @json($temp);
            // console.log(revenueData);
        const xRevenueValues = recentDays;
        const yRevenueValues = @json($temp);

        var  chart = new Chart("revenueChart", {

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

                    // yAxes: [{ticks: {min: 100000, max: 800000}}],

                },


            onClick: function(event, elements) {
          if (elements && elements.length > 0) {
            var clickedIndex = elements[0]._index;
            var clickedMonth = chart.data.labels[clickedIndex];
            var clickedDate = moment(clickedMonth, 'YYYY-MM');
            var clickedMonthNumber = clickedDate.month() + 1; // Lấy số tháng từ 0-11, cộng thêm 1 để lấy số tháng từ 1-12
            var clickedYear = clickedDate.year();
            

            // Xử lý sự kiện khi bấm vào điểm
        var xDishValues = getDaysInMonth(clickedYear,clickedMonthNumber)
        // console.log(xDishValues);
        $.ajax({
            url: '/revenue',
            method: 'GET',
            data: {
                month: clickedMonthNumber, // Tháng cần truy xuất
                year: clickedYear, // Năm cần truy xuất
                daysInMonth: xDishValues.length // Số ngày trong tháng cần truy xuất
            },
            success: function(response) {
                console.log(response);
                var yDishValues = response;
                // Xử lý mảng doanh thu nhận được ở đây
            },
            error: function(xhr, status, error) {
                console.log(error);
                // Xử lý lỗi nếu có
            }
        });
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
          }
        }
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


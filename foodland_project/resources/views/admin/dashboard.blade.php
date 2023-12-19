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
                                <p class="dashboard__item-number" id = "Register_User">
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
                                    <h1 class="dashboard__chart-header">REVENUE BY DAY</h1>
                                    <!-- Chart -->
                                    <canvas class="chart" id="dishChart"></canvas>
                                </div>
                            </div>
                            <div class="dashboard__total-wrapper grid__col-2">
                                <div class="dashboard__total">
                                    <h1 class="dashboard__total-header">TOTAL REVENUE</h1>
                                    <p class="dashboard__total-number yellow-color" id = "Total_revenue"></p>
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

        function drawingDaysChart(xDishValues,yDishValues){
            var canvas = document.getElementById('dishChart');
            if (Day){
                Day.destroy();
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
            }
            var ctx = canvas.getContext('2d');
            Day = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: xDishValues,
                    datasets: [{
                        label: 'revenue',
                        data: yDishValues,
                        backgroundColor: '#34e8eb'
                    }],
                },
                options: {
                    legend: {display: false},
                    scales: {

                    yAxes: [{ticks: {min: 0}}],

                    },
                }

            });

        }
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
        let Day = null;
        // Lấy ngày hiện tại
        const currentDate = moment();
        // Tạo một mảng chứa 12 tháng gần đây
        const recentDays = [];
        for (let i = 11; i >= 0; i--) {
            const day = currentDate.clone().subtract(i, 'months');
            recentDays.push(day.format('MM-YYYY')); // Định dạng ngày theo ý muốn
        }

        var revenueData = @json($temp);
        const xRevenueValues = recentDays;
        const yRevenueValues = @json($temp);

        //Tính total revenue
        var html_total_re = document.getElementById('Total_revenue');
        var sum = 0;
        revenueData.forEach(function (value) {
        sum += value;
        });
        html_total_re.innerHTML = sum.toString() + 'đ';
        //end tính total revenue

        var user_count = @json($userCount);
        // console.log(user_count);
        var html_register_user = document.getElementById('Register_User');
        html_register_user.innerHTML = user_count.toString() + `<span class="dashboard__item-name">
                    Register User
                </span>`;

        var  chart = new Chart("revenueChart", {

            type: "line",

            data: {

                labels: xRevenueValues,

                datasets: [{

                    fill: false,

                    lineTension: 0,
                    label: 'revenue',

                    backgroundColor: "rgba(0,0,255,1.0)",

                    borderColor: "rgba(0,0,255,0.1)",

                    data: yRevenueValues

                }]
            },

            options: {

                legend: {display: false},


            onClick: function(event, elements) {
                // e.preventDefault();
          if (elements && elements.length > 0) {
            var clickedIndex = elements[0]._index;
            var clickedMonth = chart.data.labels[clickedIndex];
            var clickedDate = moment(clickedMonth, 'MM-YYYY');
            var clickedMonthNumber = clickedDate.month() + 1; // Lấy số tháng từ 0-11, cộng thêm 1 để lấy số tháng từ 1-12
            var clickedYear = clickedDate.year();


            // Xử lý sự kiện khi bấm vào điểm
        var xDishValues = getDaysInMonth(clickedYear,clickedMonthNumber)
        let yDishValues = [];
        $.ajax({

            url: "{{route('admin.revenue')}}",
            method: 'GET',
            data: {
                month: clickedMonthNumber, // Tháng cần truy xuất
                year: clickedYear, // Năm cần truy xuất
                daysInMonth: xDishValues.length // Số ngày trong tháng cần truy xuất
            },
            success: function(response) {
                var yDishValues = Object.values(response);
                drawingDaysChart(xDishValues,yDishValues);
                // Xử lý mảng doanh thu nhận được ở đây
            },
            error: function(xhr, status, error) {
                console.log(error);
                // Xử lý lỗi nếu có
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

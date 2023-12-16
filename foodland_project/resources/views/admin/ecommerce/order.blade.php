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
                    <div class="manager-site__wrapper">
                        <div class="manager-site__header">
                            <div class="manager-site__search-wrapper">
                                <div class="manager-site__search-box">
                                    <input type="text" id="search_order" class="manager-site__search-input"
                                           placeholder="Search ...">
                                    <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
                                </div>
                                <input type="date" id="search_order_by_date" class="manager-site__date-btn btn">
                            </div>
                            <div class="manager-site__category-wrapper">
                                <form action="" method="get">
                                    <div class="manager-site__category">
                                        <input type="submit"
                                               class="manager-site__category-btn order_status btn manager-site__category-btn--active"
                                               name="order_status" value="All">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Wait to pay">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Wait to accept">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Processing">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Shipping">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Finished">
                                        <input type="submit" class="manager-site__category-btn order_status btn"
                                               name="order_status" value="Cancel">
                                    </div>
                                </form>
                                <button name="deleteDish" class="manager-site__category-delete-btn btn">
                                    <i class="manager-site__btn-icon fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="manager-site__body">
                            <table class="manager-site__manager">
                                <tr class="manager-site__manager-row">
                                    <th class="manager-site__manager-header">ID</th>
                                    <th class="manager-site__manager-header">PHONE</th>
                                    <th class="manager-site__manager-header">NAME</th>
                                    <th class="manager-site__manager-header">TOTAL</th>
                                    <th class="manager-site__manager-header">PAYMENT METHOD</th>
                                    <th class="manager-site__manager-header">PAYMENT STATUS</th>
                                    <th class="manager-site__manager-header">ORDER STATUS</th>
                                    <th class="manager-site__manager-header">ORDER TIME</th>
                                    <th class="manager-site__manager-header">DELETE</th>
                                </tr>
                                @if($orders!=null)
                                    @for($i=0;$i<count($orders);$i++)
                                        <tr class="manager-site__manager-row" id="order_ids{{$orders[$i]->OrderID}}">
                                            <td class="manager-site__manager-data">{{$i+1}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->customer_phone}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->customer_name}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->TotalPrice}} VND</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->payment_method}}</td>
                                            <td class="manager-site__manager-data">
                                                <a onclick="return false"
                                                   class="item-status">{{!empty($orders[$i]->payment_method)?'Paid':'Unpaid'}}</a>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <button name="viewDetail" class="item-status view-order-detail"
                                                        data-id="{{$orders[$i]->OrderID}}"
                                                        data-name="{{$orders[$i]->customer_name}}"
                                                        data-phone="{{$orders[$i]->customer_phone}}"
                                                        data-time="{{$orders[$i]->OrderTime}}">{{$orders[$i]->OrderStatus}}
                                                        </button>
                                            </td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->OrderTime}}</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="ids" id=""
                                                       value="{{$orders[$i]->OrderID}}">
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </table>
                            <div class="pagination">
                                @if(!empty($orders))
                                    {{$orders->links('vendor.pagination.default') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function showDataToOrderDetail() {
            $('.view-order-detail').on('click', function (e) {
                let id = $(this).data('id');
                let user_name = $(this).data('name');
                let user_phone = $(this).data('phone');
                let order_time = $(this).data('time');

                $('.detail__user-order').html('');
                $('.sub_total').html('');
                $.ajax({
                    url: "{{route('admin.order.detail')}}",
                    data: {orderID: id},
                    success: function (res) {
                        for (let i = 0; i < res['Product_name'].length; i++) {
                            $('.detail__user-order').append(
                                `<div class="detail__info-row">
                                <p class="detail__info-header">
                                    ${res['Product_name'][i]}
                                    <span class="detail__info-sign">x</span>
                                    <span class="detail__info-quantity">${res['Product_quantity'][i]}</span>
                                </p>
                                <p class="detail__info-data"> ${res['Product_price'][i]} VND</p>
                            </div>`
                            );
                        }
                        $('.sub_total').append(
                            `<p class="detail__info-header">Sub-total</p>
                            <p class="detail__info-data">${res['Order_total']} VND</p>`
                        );
                        $('#user_name').text(user_name);
                        $('#user_phone').text(user_phone);
                        $('#order_time').text(order_time);
                        $('#user_address').text(res['User_address']);
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });
        }

        showDataToOrderDetail();
        $(document).ready(function () {
            //Order status
            $(document).on('click', '.order_status', function (e) {
                e.preventDefault();
                let order_status = $(this).val();
                $(this).addClass('manager-site__category-btn--active')
                $.ajax({
                    url: "{{route('admin.order.showByStatus')}}",
                    data: {order_status: order_status},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        addItemStatus();
                        loadModal();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            $('.accept').on('submit', function (e) {
                e.preventDefault();
                $.ajax({

                });
            })
            //Search
            $('#search_order').on('keyup', function (e) {
                e.preventDefault();
                let search_string = $('#search_order').val();
                console.log(search_string);
                $.ajax({
                    url: "{{route('admin.order.search')}}",
                    method: 'GET',
                    data: {search_string: search_string},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        if (res.status === 'nothing_found') {
                            $('.manager-site__body').html('<span style="color: red; font-size: 18px;">' + 'Nothing found' + '</span>');
                        }
                        showDataToOrderDetail();
                        addItemStatus();
                        loadModal();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            //Search order by date
            $('#search_order_by_date').on('change', function (e) {
                e.preventDefault();
                let date = $('#search_order_by_date').val();
                $.ajax({
                    url: "{{route('admin.order.searchByDate')}}",
                    method: 'GET',
                    data: {date: date},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        if (res.status === 'nothing_found') {
                            $('.manager-site__body').html('<span style="color: red; font-size: 18px;">' + 'Nothing found' + '</span>');
                        }
                        addItemStatus();
                        loadModal();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            //Delete Order
            $(function (e) {
                let selected_ids = [];
                $('.manager-site__category-delete-btn').on('click', function () {
                    $('input:checkbox[name=ids]:checked').each(function () {
                        selected_ids.push($(this).val())
                    });
                });
                console.log(selected_ids);
                $('.delete-dish-btn').on('click', function () {
                    $.ajax({
                        url: "{{route('admin.order.delete')}}",
                        type: "DELETE",
                        data: {
                            ids: selected_ids,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
                            closeModalBtn('deleteDish');

                            $.each(selected_ids, function (key, val) {
                                $('#order_ids' + val).remove();
                            });
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "0",
                                "hideDuration": "0",
                                "timeOut": "1500",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr["success"]("Delete data successfully!", "Success")
                            addItemStatus();
                            loadModal();
                            showDataToOrderDetail();
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    });
                });
            });

        });

    </script>
@endsection



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
                                    <input type="text" class="manager-site__search-input" placeholder="Search ...">
                                    <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
                                </div>
                                <input type="date" class="manager-site__date-btn btn" >
                            </div>
                            <div class="manager-site__category-wrapper">
                                <form action="" method="get">
                                <div class="manager-site__category">
                                        <input type="submit" class="manager-site__category-btn btn manager-site__category-btn--active"
                                               name="order_status" value="All">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Wait to pay">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Wait to accept">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Processing">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Shipping">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Finished">
                                        <input type="submit" class="manager-site__category-btn btn" name="order_status" value="Cancel">
                                </div>
                                </form>
                                <button name="delete" class="manager-site__category-delete-btn btn">
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
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$i+1}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->customer_phone}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->customer_name}}</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->TotalPrice}} VND</td>
                                            <td class="manager-site__manager-data">{{$orders[$i]->payment_method}}</td>
                                            <td class="manager-site__manager-data">
                                                <a onclick="return false" class="item-status">Wait</a>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <button name="viewDetail" class="item-status">Wait</button>
                                            </td>
                                            <td class="manager-site__manager-data">01/01/2023</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                        </tr>
                                    @endfor
                                @endif

                                <tr class="manager-site__manager-row">
                                    <td class="manager-site__manager-data">001</td>
                                    <td class="manager-site__manager-data">Beef Wellington</td>
                                    <td class="manager-site__manager-data">Beefsteak</td>
                                    <td class="manager-site__manager-data">149,000 VND</td>
                                    <td class="manager-site__manager-data">Visa</td>
                                    <td class="manager-site__manager-data">
                                        <a onclick="return false" class="item-status">Paid</a>
                                    </td>
                                    <td class="manager-site__manager-data">
                                        <button name="viewDetail" class="item-status">Finished</button>
                                    </td>
                                    <td class="manager-site__manager-data">01/01/2023</td>
                                    <td class="manager-site__manager-data">
                                        <input class="data__checkbox" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr class="manager-site__manager-row">
                                    <td class="manager-site__manager-data">001</td>
                                    <td class="manager-site__manager-data">Beef Wellington</td>
                                    <td class="manager-site__manager-data">Beefsteak</td>
                                    <td class="manager-site__manager-data">149,000 VND</td>
                                    <td class="manager-site__manager-data">Visa</td>
                                    <td class="manager-site__manager-data">
                                        <a onclick="return false" class="item-status">Paid</a>
                                    </td>
                                    <td class="manager-site__manager-data">
                                        <button name="viewDetail" class="item-status">Cancel</button>
                                    </td>
                                    <td class="manager-site__manager-data">01/01/2023</td>
                                    <td class="manager-site__manager-data">
                                        <input class="data__checkbox" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr class="manager-site__manager-row">
                                    <td class="manager-site__manager-data">001</td>
                                    <td class="manager-site__manager-data">Beef Wellington</td>
                                    <td class="manager-site__manager-data">Beefsteak</td>
                                    <td class="manager-site__manager-data">149,000 VND</td>
                                    <td class="manager-site__manager-data">Visa</td>
                                    <td class="manager-site__manager-data">
                                        <a onclick="return false" class="item-status">Paid</a>
                                    </td>
                                    <td class="manager-site__manager-data">
                                        <button name="viewDetail" class="item-status">Shipping</button>
                                    </td>
                                    <td class="manager-site__manager-data">01/01/2023</td>
                                    <td class="manager-site__manager-data">
                                        <input class="data__checkbox" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

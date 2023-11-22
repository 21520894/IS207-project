
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
                                <div class="manager-site__category">
                                    <button class="manager-site__category-btn btn manager-site__category-btn--active">All</button>
                                    <button class="manager-site__category-btn btn">Wait to pay</button>
                                    <button class="manager-site__category-btn btn">Wait to acccept</button>
                                    <button class="manager-site__category-btn btn">Processing</button>
                                    <button class="manager-site__category-btn btn">Shipping</button>
                                    <button class="manager-site__category-btn btn">Finished</button>
                                    <button class="manager-site__category-btn btn">Cancel</button>
                                </div>
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
                                        <button name="viewDetail" class="item-status">Wait</button>
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

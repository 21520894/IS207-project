


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
                                <button name="addVoucher" class="manager-site__add-btn btn">+ ADD</button>
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <button class="manager-site__category-btn btn manager-site__category-btn--active">All</button>
                                    <button class="manager-site__category-btn btn">Wait</button>
                                    <button class="manager-site__category-btn btn">Used</button>
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
                                    <th class="manager-site__manager-header">TITLE</th>
                                    <th class="manager-site__manager-header">CODE</th>
                                    <th class="manager-site__manager-header">VALUE</th>
                                    <th class="manager-site__manager-header">EXPIRATION DATE</th>
                                    <th class="manager-site__manager-header">DELETE</th>
                                </tr>
                                @if($promotions!=null)
                                    @for($i=0;$i<count($promotions);$i++)
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$promotions[$i]->PromotionID}}</td>
                                            <td class="manager-site__manager-data">{{$promotions[$i]->Title}}</td>
                                            <td class="manager-site__manager-data">{{$promotions[$i]->CODE}}</td>
                                            <td class="manager-site__manager-data">{{$promotions[$i]->Percentage*100}}%</td>
                                            <td class="manager-site__manager-data">{{$promotions[$i]->DateEnd}}</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

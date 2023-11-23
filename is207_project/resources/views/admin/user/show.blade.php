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
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <button class="manager-site__category-btn btn manager-site__category-btn--active">All</button>
                                    <button class="manager-site__category-btn btn">Admin</button>
                                    <button class="manager-site__category-btn btn">Customer</button>
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
                                    <th class="manager-site__manager-header">EMAIL</th>
                                    <th class="manager-site__manager-header">REGISTER DATE</th>
                                    <th class="manager-site__manager-header">ACCOUNT TYPE</th>
                                    <th class="manager-site__manager-header">DELETE</th>
                                    <th class="manager-site__manager-header">EDIT</th>
                                </tr>
                                @if($customersList!=null)
                                    @for($i=0;$i<count($customersList);$i++)
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$i+1}}</td>
                                            <td class="manager-site__manager-data">{{$customersList[$i]->phone}}</td>
                                            <td class="manager-site__manager-data">{{$customersList[$i]->name}}</td>
                                            <td class="manager-site__manager-data">{{$customersList[$i]->email}}</td>
                                            <td class="manager-site__manager-data">{{$customersList[$i]->created_at}}</td>
                                            <td class="manager-site__manager-data" id="account_type">Customer</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <a href="{{route('admin.user.edit', ['id' => $customersList[$i]->id])}}" name="editUser" class="data__edit-btn btn">EDIT</a>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                                @if($adminsList!=null)
                                    @for($i=0;$i<count($adminsList);$i++)
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$i+count($customersList)+1}}</td>
                                            <td class="manager-site__manager-data">{{$adminsList[$i]->phone}}</td>
                                            <td class="manager-site__manager-data">{{$adminsList[$i]->name}}</td>
                                            <td class="manager-site__manager-data">{{$adminsList[$i]->email}}</td>
                                            <td class="manager-site__manager-data">{{$adminsList[$i]->created_at}}</td>
                                            <td class="manager-site__manager-data">Admin</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <a href="{{route('admin.user.edit')}}" name="editUser" class="data__edit-btn btn">EDIT</a>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </table>
                        </div>
                    </div>
                    @include('admin.components.main')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    document.getElementById('adminTab').addEventListener('click', function() {
        fetchData('admin');
    });

    document.getElementById('customerTab').addEventListener('click', function() {
        fetchData('customer');
    });

    function fetchData(tabType) {
        // Gửi yêu cầu Ajax đến server
        fetch(`/get${tabType}Data`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('userData').innerHTML = data;
            });
    }
</script>
@endsection

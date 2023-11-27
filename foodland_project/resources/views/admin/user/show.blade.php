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
                                    <form action="" method="get">
                                        <input type="submit" class="manager-site__category-btn btn
                                         {{(request()->account_type == null || request()->account_type == 'All')?'manager-site__category-btn--active':''}}"
                                               name="account_type" value="All">
                                        <input type="submit" class="manager-site__category-btn btn
                                        {{request()->account_type=='Admin'?'manager-site__category-btn--active':''}}" name="account_type" value="Admin">
                                        <input type="submit" class="manager-site__category-btn btn
                                        {{request()->account_type=='Customer'?'manager-site__category-btn--active':''}}" name="account_type" value="Customer">
                                    </form>
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
                                @if($users!=null)
                                    @for($i=0;$i<count($users);$i++)
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$i+1}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->phone}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->name}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->email}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->created_at}}</td>
                                            <td class="manager-site__manager-data" id="account_type">{{$users[$i]->role==1?'Admin':'Customer'}}</td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <button name="editUser"
                                                        class="data__edit-btn btn update_user_form"
                                                        data-id="{{$i+1}}"
                                                        data-name="{{$users[$i]->name}}"
                                                        data-phone="{{$users[$i]->phone}}"
                                                        data-email="{{$users[$i]->email}}"
                                                        data-created="{{$users[$i]->created_at}}"
                                                        data-role="{{$users[$i]->role==1}}"
                                                >EDIT</button>
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
        $(document).ready(function () {
            $('.update_user_form').on('click', function (e) {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let phone = $(this).data('phone');
                let email = $(this).data('email');
                let role = $(this).data('role')
                let created_time = $(this).data('created');

                role = (role===1)?'Admin':'Customer';
                created_time= created_time.split(" ")[0];

                $('#up_user_id').val(id);
                $('#up_user_name').val(name);
                $('#up_user_phone').val(phone);
                $('#up_user_email').val(email);
                $('#up_user_role').text(role);
                $('#up_user_created').val(created_time);
            });
        });
    </script>
@endsection

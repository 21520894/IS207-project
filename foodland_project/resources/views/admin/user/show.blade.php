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
                                    <input type="text" id="search_user" class="manager-site__search-input"
                                           placeholder="Search ...">
                                    <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <input type="submit"
                                           class="manager-site__category-btn btn account_type manager-site__category-btn--active"
                                           name="account_type" value="All">
                                    <input type="submit" class="manager-site__category-btn btn account_type"
                                           name="account_type" value="Admin">
                                    <input type="submit" class="manager-site__category-btn btn account_type"
                                           name="account_type" value="Customer">
                                </div>
                                <button name="deleteUser" class="manager-site__category-delete-btn btn">
                                    <i class="manager-site__btn-icon fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="manager-site__body">
                            <table class="table manager-site__manager">
                                <tr class="manager-site__manager-row">
                                    <th class="manager-site__manager-header">ID</th>
                                    <th class="manager-site__manager-header">PHONE</th>
                                    <th class="manager-site__manager-header">NAME</th>
                                    <th class="manager-site__manager-header">EMAIL</th>
                                    <th class="manager-site__manager-header">REGISTER DATE</th>
                                    <th class="manager-site__manager-header">ACCOUNT TYPE</th>
                                    <th class="manager-site__manager-header">EDIT</th>
                                    <th class="manager-site__manager-header">
                                        <input type="checkbox" name="" id="select_all_ids">
                                    </th>
                                </tr>
                                @if($users!=null)
                                    @for($i=0;$i<count($users);$i++)
                                        <tr class="manager-site__manager-row" id="user_ids{{$users[$i]->id}}">
                                            <td class="manager-site__manager-data">{{$users[$i]->id}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->phone}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->name}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->email}}</td>
                                            <td class="manager-site__manager-data">{{$users[$i]->created_at}}</td>
                                            <td class="manager-site__manager-data"
                                                id="account_type">{{$users[$i]->role==1?'Admin':'Customer'}}</td>
                                            <td class="manager-site__manager-data">
                                                <button name="editUser"
                                                        class="data__edit-btn btn update_user_form"
                                                        data-id="{{$i+1}}"
                                                        data-name="{{$users[$i]->name}}"
                                                        data-phone="{{$users[$i]->phone}}"
                                                        data-email="{{$users[$i]->email}}"
                                                        data-created="{{$users[$i]->created_at}}"
                                                        data-role="{{$users[$i]->role==1}}"
                                                >EDIT
                                                </button>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="ids" id=""
                                                       value="{{$users[$i]->id}}">
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </table>
                            <div class="pagination">
                                @if(!empty($users))
                                    {{$users->links('vendor.pagination.default') }}
                                @endif
                            </div>
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
        function showDataToEditUserForm() {
            $('.update_user_form').on('click', function (e) {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let phone = $(this).data('phone');
                let email = $(this).data('email');
                let role = $(this).data('role')
                let created_time = $(this).data('created');

                role = (role === 1) ? 'Admin' : 'Customer';
                created_time = created_time.split(" ")[0];

                $('input[name="up-user-id"]').val(id);
                $('input[name="up-user-name"]').val(name);
                $('input[name="up-user-phone"]').val(phone);
                $('input[name="up-user-email"]').val(email);
                $('#up-user-role').text(role);
                if (role === 'Admin') {
                    $('#other-user-role').text('Customer');
                    $('#other-user-role').val('Customer');
                    $('select[name="up-user-role"]').val('Admin');
                } else {
                    $('#other-user-role').text('Admin');
                    $('#other-user-role').val('Admin');
                    $('select[name="up-user-role"]').val('Customer');
                }
                $('option[id="up-user-role"]').text(role);
                $('option[id="up-user-role"]').val(role);
                $('input[name="up-user-created"]').val(created_time);
            });
        }

        showDataToEditUserForm();
        $(document).ready(function () {
            $('#edit-user-form').on('submit', function (e) {
                e.preventDefault();
                let upUserID = $('input[name="up-user-id"]').val();
                let upUserName = $('input[name="up-user-name"]').val();
                let upUserRole = $('select[name="up-user-role"]').val();
                if (upUserRole === 'Admin') {
                    upUserRole = 1;
                } else {
                    upUserRole = 0;
                }
                $('.error').text('');
                $.ajax({
                    url: "{{route('admin.user.update')}}",
                    type: 'POST',
                    data: {
                        up_id: upUserID,
                        up_name: upUserName,
                        up_role: upUserRole,
                        _token: $(this).find('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            modal.style.display = "none";
                            $('.add__modal').hide();
                            $('.table').load(location.href + ' .table', function () {
                                showDataToEditUserForm();
                                loadModal();
                            });
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "500",
                                "hideDuration": "500",
                                "timeOut": "1500",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr["success"]("Update data successfully!", "Success")
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        let responseJSON = error.responseJSON.errors;
                        for (let key in responseJSON) {
                            $('.' + key + '_error').text(responseJSON[key][0]);
                        }
                    }
                });
            });
            $(function (e) {
                $('#select_all_ids').on('click', function () {
                    $('.data__checkbox').prop('checked', $(this).prop('checked'))
                });
                let selected_ids = [];
                $('.manager-site__category-delete-btn').on('click', function () {
                    $('input:checkbox[name=ids]:checked').each(function () {
                        selected_ids.push($(this).val())
                    });
                });
                $('.delete-user-btn').on('click', function () {
                    $.ajax({
                        url: "{{route('admin.user.delete')}}",
                        type: "DELETE",
                        data: {
                            ids: selected_ids,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
                            closeModalBtn('deleteUser');
                            $.each(selected_ids, function (key, val) {
                                $('#user_ids' + val).remove();
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
                            Command: toastr["success"]("Delete data successfully!", "Success")
                        }
                    });
                });
            });
            //Pagination
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $.ajax({
                    url: "/admin/user/pagination/paginate-data?page=" + page,
                    success: function (res) {
                        $('.manager-site__body').html(res);
                    }
                });
            });
            //Search
            $(document).on('keyup', function (e) {
                e.preventDefault();
                let search_string = $('#search_user').val();
                $.ajax({
                    url: "{{route('admin.user.search')}}",
                    method: 'GET',
                    data: {search_string: search_string},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        if (res.status === 'nothing_found') {
                            $('.manager-site__body').html('<span style="color: red; font-size: 18px;">' + 'Nothing found' + '</span>');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            //Account type
            $(document).on('click', '.account_type', function (e) {
                e.preventDefault();
                let account_type = $(this).val();
                $(this).addClass('manager-site__category-btn--active')
                $.ajax({
                    url: "{{route('admin.user.showByGroup')}}",
                    data: {account_type: account_type},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                    }
                });
            });

        });
    </script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@endsection

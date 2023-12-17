


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
                                    <input id="search_promotion" type="text" class="manager-site__search-input" placeholder="Search ...">
                                    <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
                                </div>
                                <button name="addVoucher" class="manager-site__add-btn btn">+ ADD</button>
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <input type="submit" name="voucher_group" class="manager-site__category-btn btn voucher_group manager-site__category-btn--active" value="All">
                                    <input type="submit" name="voucher_group" class="manager-site__category-btn btn voucher_group " value="Available">
                                    <input type="submit" name="voucher_group" class="manager-site__category-btn btn voucher_group " value="Expired">
                                </div>
                                <button name="deleteDish" class="manager-site__category-delete-btn btn">
                                    <i class="manager-site__btn-icon fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="manager-site__body">
                            <div class="table-data">
                                <table class="manager-site__manager">
                                    <tr class="manager-site__manager-row">
                                        <th class="manager-site__manager-header">ID</th>
                                        <th class="manager-site__manager-header">TITLE</th>
                                        <th class="manager-site__manager-header">CODE</th>
                                        <th class="manager-site__manager-header">VALUE</th>
                                        <th class="manager-site__manager-header">EXPIRATION DATE</th>
                                        <th class="manager-site__manager-header">CONSTRAINT</th>
                                        <th class="manager-site__manager-header">QUANTITY</th>
                                        <th class="manager-site__manager-header">
                                            <input type="checkbox" name="" id="select_all_ids">
                                        </th>
                                    </tr>
                                    @if($promotions!=null)
                                        @for($i=0;$i<count($promotions);$i++)
                                            <tr class="manager-site__manager-row" id="promotion_ids{{$promotions[$i]->PromotionID}}">
                                                <td class="manager-site__manager-data">{{$promotions[$i]->PromotionID}}</td>
                                                <td class="manager-site__manager-data">{{$promotions[$i]->Group}}</td>
                                                <td class="manager-site__manager-data">{{$promotions[$i]->CODE}}</td>
                                                <td class="manager-site__manager-data">{{$promotions[$i]->Value}}</td>
                                                <td class="manager-site__manager-data">{{$promotions[$i]->DateEnd}}</td>
                                                <td class="manager-site__manager-data">Over {{$promotions[$i]->Constraint}}</td>
                                                <td class="manager-site__manager-data">{{$promotions[$i]->Quantity}}</td>
                                                <td class="manager-site__manager-data">
                                                    <input class="data__checkbox" type="checkbox" name="ids" id="" value="{{$promotions[$i]->PromotionID}}">
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                </table>
                                <div class="pagination">
                                    @if(!empty($promotions))
                                        {{$promotions->links('vendor.pagination.default') }}
                                    @endif
                                </div>
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
        function deleteVoucher()
        {
            $('#select_all_ids').on('click', function () {
                $('.data__checkbox').prop('checked', $(this).prop('checked'))
            });
        }
        //Add new promotion
        $('#add-voucher-form').on('submit', function (e) {
            e.preventDefault();
            $('.error').text('');
            let formData = new FormData(this);
            let currentTab = $('.manager-site__category-btn--active').val();
            let currentPage = $('li.active span').text();
            $.ajax({
                url: "{{route('admin.promotion.add')}}",
                type: 'POST',
                data:
                formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        modal.style.display = "none";
                        $('.add__modal').hide();
                        $('.manager-site__category').load(location.href + ' .manager-site__category');
                        $('.manager-site__body').load(location.href + '?voucher_group=' + currentTab + '&page=' + currentPage + ' .table-data', function () {
                            deleteVoucher();
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
                        toastr["success"]("Add data successfully!", "Success")
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
        //Pagination
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            $.ajax({
                url: "/admin/promotion/pagination/paginate-data?page=" + page,
                success: function (res) {
                    $('.manager-site__body').html(res);
                    loadModal();
                }
            });
        });
        //Promotion tab
        $(document).on('click', '.voucher_group', function (e) {
            e.preventDefault();
            let voucher_group = $(this).val();
            $('.manager-site__category-btn--active').removeClass('manager-site__category-btn--active');
            $(this).addClass('manager-site__category-btn--active')
            $.ajax({
                data: {voucher_group: voucher_group},
                success: function (res) {
                    $('.manager-site__body').load(location.href + '?voucher_group='+voucher_group+' .table-data', function () {
                        loadModal();
                    });
                },
            });
        });
        //Delete voucher
        $(function (e) {
            let selected_ids = [];
            $('.manager-site__category-delete-btn').on('click', function () {
                $('input:checkbox[name=ids]:checked').each(function () {
                    selected_ids.push($(this).val())
                });
            });
            $('.delete-dish-btn').on('click', function () {
                $.ajax({
                    url: "{{route('admin.promotion.delete')}}",
                    type: "DELETE",
                    data: {
                        ids: selected_ids,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        closeModalBtn('deleteDish');
                        $.each(selected_ids, function (key, val) {
                            $('#promotion_ids' + val).remove();
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
                        deleteVoucher();
                    }
                });
            });
        });
        //Search
        $('#search_promotion').on('keyup', function (e) {
            e.preventDefault();
            let search_string = $('#search_promotion').val();
            let currentTab = $('.manager-site__category-btn--active').val();
            console.log(search_string);
            $.ajax({
                url: "{{route('admin.promotion.search')}}",
                method: 'GET',
                data: {
                    voucher_group: currentTab,
                    search_string: search_string},
                success: function (res) {
                    $('.manager-site__body').html(res);
                    if (res.status === 'nothing_found') {
                        $('.manager-site__body').html('<span style="color: red; font-size: 18px;">' + 'Nothing found' + '</span>');
                    }
                    deleteVoucher();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@endsection

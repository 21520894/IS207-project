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
                                    <input type="text" id="search_dish" class="manager-site__search-input"
                                           placeholder="Search ...">
                                    <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
                                </div>
                                <button name="addDish" class="manager-site__add-btn btn">+ ADD</button>
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <input type="submit"
                                           class="manager-site__category-btn btn category_group manager-site__category-btn--active"
                                           name="category_type" value="All">
                                    @if(!empty(getAllCategories()))
                                        @foreach(getAllCategories() as $item)
                                            <input type="submit" class="manager-site__category-btn btn category_group"
                                                   name="category_type" value="{{$item->Title}}">
                                        @endforeach
                                    @endif
                                </div>
                                <button name="deleteDish" class="manager-site__category-delete-btn btn">
                                    <i class="manager-site__btn-icon fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="manager-site__body">
                            <table class="manager-site__manager table">
                                <tr class="manager-site__manager-row">
                                    <th class="manager-site__manager-header">ID</th>
                                    <th class="manager-site__manager-header">NAME</th>
                                    <th class="manager-site__manager-header">IMG</th>
                                    <th class="manager-site__manager-header">GROUP</th>
                                    <th class="manager-site__manager-header">PRICE</th>
                                    <th class="manager-site__manager-header">DESCRIBE</th>
                                    <th class="manager-site__manager-header">STATUS</th>
                                    <th class="manager-site__manager-header">EDIT</th>
                                    <th class="manager-site__manager-header">
                                        <input type="checkbox" name="" id="select_all_ids">
                                    </th>
                                </tr>
                                @if(!empty($dishes))
                                    @php($i=1)
                                    @foreach($dishes as $item)
                                        <tr class="manager-site__manager-row" id="product_ids{{$item->ID}}">
                                            <td class="manager-site__manager-data">{{$item->ID}}</td>
                                            <td class="manager-site__manager-data">{{$item->Name}}</td>
                                            <td class="manager-site__manager-data">
                                                <img class="data__img" src="{{asset('assets/img/'.$item->Image)}}" alt="">
                                            </td>
                                            <td class="manager-site__manager-data">{{$item->category_name}}</td>
                                            <td class="manager-site__manager-data">{{$item->Price}} VND</td>
                                            <td class="manager-site__manager-data">
                                                <p class="data__desc">
                                                    {{$item->Description}}
                                                </p>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                @php( $statusStyle = array('Stocking' => 'green-bg-color','Out of stock' => 'red-bg-color'))
                                                <button
                                                    class="item-status {{$statusStyle[$item->Status]}}">{{$item->Status}}</button>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <button name="editDish"
                                                        class="data__edit-btn btn update_dish_form"
                                                        data-id="{{$item->ID}}"
                                                        data-name="{{$item->Name}}"
                                                        data-price="{{$item->Price}}"
                                                        data-status="{{$item->Status}}"
                                                        data-description="{{$item->Description}}"
                                                        data-category="{{$item->category_name}}"
                                                        data-image="{{$item->Image}}"
                                                >EDIT
                                                </button>
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <input class="data__checkbox" type="checkbox" name="ids" id=""
                                                       value="{{$item->ID}}">
                                            </td>
                                        </tr>
                                        @php($i+=1)
                                    @endforeach
                                @endif
                            </table>
                            <div class="pagination">
                                @if(!empty($dishes))
                                    {{$dishes->links('vendor.pagination.default') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.modal')
@endsection
@section('js')
    <script>

        function editDish() {
            $('#select_all_ids').on('click', function () {
                $('.data__checkbox').prop('checked', $(this).prop('checked'))
            });
            $('.update_dish_form').on('click', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');
                let description = $(this).data('description');
                let category = $(this).data('category');
                let status = $(this).data('status');
                let image = $(this).data('image');
                console.log(image);
                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_price').val(price);
                $('#up_status').text(status);
                $('#up-product-image').attr('src',"{{asset('assets/img')}}"+"/"+image);
                if (status === 'Stocking') {
                    $('#other_status').text('Out of stock');
                    $('#other_status').val('Out of stock');
                    $('select[name="up_status"]').val('Stocking');
                } else {
                    $('#other_status').text('Stocking');
                    $('#other_status').val('Stocking');
                    $('select[name="up_status"]').val('Out of stock');
                }
                $('#up_description').val(description);
                $('#up_category').text(category);
            });
        }

        $(document).ready(function () {
            //Add dish data
            $('#add-dish-form').on('submit', function (e) {
                e.preventDefault();
                let productCategory = $('select[name="category-name"]').val().trim();
                if (productCategory === 'new category') {
                    productCategory = $('input[name="new-category-name"]').val().trim();
                }
                $('.error').text('');
                let productImage = $('input[name="product-image"]')[0].files[0];
                let formData = new FormData(this);
                formData.append('product-category',productCategory);
                $.ajax({
                    url: "{{route('admin.dish.add')}}",
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
                            $('.manager-site__body').load(location.href + ' .manager-site__body', function () {
                                editDish();
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

            //Show data to edit dish modal
            editDish();
            //Update dish data
            $('#up_image').change(function(){
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#up-product-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#edit-dish-form').on('submit', function (e) {
                e.preventDefault();
                let upProductID = $('input[name="up-product-id"]').val();
                let upProductName = $('input[name="up-product-name"]').val();
                let upProductPrice = $('input[name="up-product-price"]').val();
                let upProductDescription = $('textarea[name="up-product-description"]').val();
                let upProductCategory = $('select[name="up-category"]').val();
                let upProductStatus = $('select[name="up-status"]').val();
                if (upProductCategory === 'new category') {
                    upProductCategory = $('input[name="up-new-category"]').val();
                }
                let formData = new FormData(this);
                formData.append('up_id',upProductID);
                formData.append('up_category',upProductCategory);
                $('.error').text('');
                $.ajax({
                    url: "{{route('admin.dish.update')}}",
                    type: 'POST',
                    data:
                    formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 'success') {
                            modal.style.display = "none";
                            $('.add__modal').hide();
                            $('.table').load(location.href+'.table', function () {
                                editDish();
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
                                "showDuration": "0",
                                "hideDuration": "0",
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
            //Delete dish data
            $(function (e) {

                let selected_ids = [];
                $('.manager-site__category-delete-btn').on('click', function () {
                    $('input:checkbox[name=ids]:checked').each(function () {
                        selected_ids.push($(this).val())
                    });
                });
                $('.delete-dish-btn').on('click', function () {
                    $.ajax({
                        url: "{{route('admin.dish.delete')}}",
                        type: "DELETE",
                        data: {
                            ids: selected_ids,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
                            closeModalBtn('deleteDish');

                            $.each(selected_ids, function (key, val) {
                                $('#product_ids' + val).remove();
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
                            editDish();
                            loadModal();
                        }
                    });
                });
            });

            //Pagination
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $.ajax({
                    url: "/admin/dish/pagination/paginate-data?page=" + page,
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        editDish();
                        loadModal();
                    }
                });
            });
            //Search
            $(document).on('keyup', function (e) {
                e.preventDefault();
                let search_string = $('#search_dish').val();
                $.ajax({
                    url: "{{route('admin.dish.search')}}",
                    method: 'GET',
                    data: {search_string: search_string},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        if (res.status === 'nothing_found') {
                            $('.manager-site__body').html('<span style="color: red; font-size: 18px;">' + 'Nothing found' + '</span>');
                        }
                        editDish();
                        loadModal();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            //Category tab
            $(document).on('click', '.category_group', function (e) {
                e.preventDefault();
                let category_group = $(this).val();
                $('.manager-site__category-btn--active').removeClass('manager-site__category-btn--active');
                $(this).addClass('manager-site__category-btn--active')
                $.ajax({
                    url: "{{route('admin.dish.show.category')}}",
                    data: {category_type: category_group},
                    success: function (res) {
                        $('.manager-site__body').html(res);
                        editDish();
                        loadModal();
                    },
                    error: function (err){
                        console.log(err);
                    }
                });
            });
        });
    </script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

@endsection

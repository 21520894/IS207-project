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
                                <button name="addDish" class="manager-site__add-btn btn">+ ADD</button>
                            </div>
                            <div class="manager-site__category-wrapper">
                                <div class="manager-site__category">
                                    <form action="" method="get">
                                        <input type="submit" class="manager-site__category-btn btn
                                        {{(request()->category_type == null || request()->category_type == 'All')?'manager-site__category-btn--active':''}}"
                                               name="category_type" value="All">
                                        @if(!empty(getAllCategories()))
                                            @foreach(getAllCategories() as $item)
                                                <input type="submit" class="manager-site__category-btn btn
                                                       {{request()->category_type==$item->Title?'manager-site__category-btn--active':''}}"
                                                       name="category_type" value="{{$item->Title}}">
                                            @endforeach
                                        @endif
                                    </form>
                                </div>
                                <button name="delete" class="manager-site__category-delete-btn btn">
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
                                    <th class="manager-site__manager-header">DELETE</th>
                                    <th class="manager-site__manager-header">EDIT</th>
                                </tr>
                                @if(!empty($dishes))
                                    @php($i=1)
                                    @foreach($dishes as $item)
                                        <tr class="manager-site__manager-row">
                                            <td class="manager-site__manager-data">{{$item->ID}}</td>
                                            <td class="manager-site__manager-data">{{$item->Name}}</td>
                                            <td class="manager-site__manager-data">
                                                <img class="data__img" src="../assets/img/item11.jpg" alt="">
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
                                                <input class="data__checkbox" type="checkbox" name="" id="">
                                            </td>
                                            <td class="manager-site__manager-data">
                                                <button name="editDish"
                                                        class="data__edit-btn btn update_dish_form"
                                                        data-id="{{$item->ID}}"
                                                        data-name="{{$item->Name}}"
                                                        data-price="{{$item->Price}}"
                                                        data-description="{{$item->Description}}"
                                                        data-category="{{$item->category_name}}"
                                                >EDIT</button>
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
        $(document).ready(function () {
            //Add dish data
            $('#add-dish-form').on('submit', function (e) {
                e.preventDefault();
                let productName = $('input[name="product-name"]').val().trim();
                let productPrice = $('input[name="product-price"]').val().trim();
                let productDescription = $('textarea[name="product-description"]').val().trim();
                let productCategory = $('select[name="category-name"]').val().trim();
                if (productCategory === 'new category') {
                    productCategory = $('input[name="new-category-name"]').val().trim();
                }
                $('.error').text('');
                $.ajax({
                    url: "{{route('admin.dish.add')}}",
                    type: 'POST',
                    data: {
                        product_name: productName,
                        product_price: productPrice,
                        product_description: productDescription,
                        product_category: productCategory,
                        _token: $(this).find('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            modal.style.display = "none";
                            $('.add__modal').hide();
                            $('.manager-site__category').load(location.href + ' .manager-site__category');
                            $('.table').load(location.href + ' .table');
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
            $('.update_dish_form').on('click', function (e) {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');
                let description = $(this).data('description');
                let category = $(this).data('category')

                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_price').val(price);
                $('#up_description').val(description);
                $('#up_category').text(category);
                //$('select[name="group"]').value=category
            });
            //Update dish data
            $('#edit-dish-form').on('submit', function (e) {
                e.preventDefault();
                let upProductID = $('input[name="up-product-id"]').val();
                let upProductName = $('input[name="up-product-name"]').val();
                let upProductPrice = $('input[name="up-product-price"]').val();
                let upProductDescription = $('textarea[name="up-product-description"]').val();
                let upProductCategory = $('select[name="up-category"]').val();
                if (upProductCategory === 'new category') {
                    upProductCategory = $('input[name="up-new-category"]').val();
                }
                $('.error').text('');
                $.ajax({
                    url: "{{route('admin.dish.update')}}",
                    type: 'POST',
                    data: {
                        up_id: upProductID,
                        up_name: upProductName,
                        up_price: upProductPrice,
                        up_description: upProductDescription,
                        up_category: upProductCategory,
                        _token: $(this).find('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            modal.style.display = "none";
                            $('.add__modal').hide();
                            $('.manager-site__category').load(location.href + ' .manager-site__category');
                            $('.table').load(location.href + ' .table:not(.data__edit-btn)');
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
        });
    </script>
@endsection

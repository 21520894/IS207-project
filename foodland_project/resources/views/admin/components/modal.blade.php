<div class="modal">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        @include('admin.dish.edit')
        @include('admin.user.edit')
        <div class="add__modal" name="addDishModal">
            <h1 class="add__modal-header">Add new dish</h1>
            <form class="add__modal-wrapper" action="" method="POST" id="add-dish-form" enctype="multipart/form-data">
                @csrf
                <div class="add__input-group">
                    <label for="" class="add__input-label">Name <span class="add__input-require">*</span></label>
                    <input type="text" class="add__input-text" name="product-name">
                    <span style="color: red; font-size: 12px;" class="product-name_error error"></span>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Price (VND) <span class="add__input-require">*</span></label>
                    <input type="number" min="0" class="add__input-text" name="product-price">
                    <span style="color: red; font-size: 12px;" class="product-price_error error"></span>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
                    <select name="category-name" id="" class="add__input-text">
                        <option value="">-- Category --</option>
                        @if(!empty(getAllCategories()))
                            @foreach(getAllCategories() as $item)
                                <option value="{{$item->Title}}">{{$item->Title}}</option>
                            @endforeach
                        @endif
                        <option value="new category">Add new group</option>
                    </select>
                    <span style="color: red; font-size: 12px;" class="product-category_error error"></span>
                </div>
                <div class="add__input-group add-group input-group--inactive">
                    <label for="" class="add__input-label">Category name <span
                            class="add__input-require">*</span></label>
                    <input type="text" class="add__input-text " name="new-category-name">
                    <span style="color: red; font-size: 12px;" class="product-image_error error"></span>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Category Image <span class="add__input-require">*</span></label>
                        <input type="file" class="add__input-text" name="category-image" id="category-image">
                        <span style="color: red; font-size: 12px;" class="category-image_error error"></span>
                    </div>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Describe <span class="add__input-require">*</span></label>
                    <textarea class="add__input-text" name="product-description" id="" cols="30" rows="5"></textarea>
                    <span style="color: red; font-size: 12px;" class="product-description_error error"></span>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Image <span class="add__input-require">*</span></label>
                    <input type="file" class="add__input-text" name="product-image" id="product-image">
                </div>
                <div class="add__btn-wrapper">
                    <input class="add__btn" type="submit" value="Add new dish">
                    <button class="add__btn cancel" onclick="closeModalBtn('addDish')">Cancel</button>
                </div>
            </form>
        </div>
        <div name="deleteDishModal" class="delete__modal">
            <i class="delete__icon fa-solid fa-exclamation"></i>
            <p class="delete__message">
                Are you sure you want to delete current data? These data cannot be recovered
            </p>
            <div class="delete__btn-wrapper">
                <button type="submit" class="delete-dish-btn delete__btn btn">Delete</button>
                <button class="cancel__btn btn" onclick="closeModalBtn('delete')">Cancel</button>
            </div>
        </div>
        <div name="deleteUserModal" class="delete__modal">
            <i class="delete__icon fa-solid fa-exclamation"></i>
            <p class="delete__message">
                Are you sure you want to delete current data? These data cannot be recovered
            </p>
            <div class="delete__btn-wrapper">
                <button type="submit" class="delete-user-btn delete__btn btn">Delete</button>
                <button class="cancel__btn btn" onclick="closeModalBtn('delete')">Cancel</button>
            </div>
        </div>
        <div name="viewDetailModal" class="detail__modal">
            <h1 class="detail__header">Order - <span class="detail__order-id">001</span></h1>
            <div class="detail__user-info">
                <div class="detail__info-row">
                    <p class="detail__info-header">Name:</p>
                    <p class="detail__info-data" id="user_name">Nguyễn Văn A</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Phone:</p>
                    <p class="detail__info-data" id="user_phone">090123456</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Address:</p>
                    <p class="detail__info-data" id="user_address"></p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Time:</p>
                    <p class="detail__info-data" id="order_time"></p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Shipping unit:</p>
                    <p class="detail__info-data">Vietnammm.com</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Note:</p>
                    <p class="detail__info-data"></p>
                </div>
            </div>
            <div class="detail__user-order">
                <div class="detail__info-row">
                    <p class="detail__info-header">
                        Beef Willington
                        <span class="detail__info-sign">x</span>
                        <span class="detail__info-quantity">1</span>
                    </p>
                    <p class="detail__info-data">200,000 VND</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">
                        Beef Willington
                        <span class="detail__info-sign">x</span>
                        <span class="detail__info-quantity">1</span>
                    </p>
                    <p class="detail__info-data">200,000 VND</p>
                </div>
            </div>
            <div class="detail__user-bill">
                <div class="detail__info-row sub_total">

                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Shipping</p>
                    <p class="detail__info-data">27,000 VND</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">VAT 8%</p>
                    <p class="detail__info-data">25,760 VND</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Discount</p>
                    <p class="detail__info-data">25,760 VND</p>
                </div>
                <div class="detail__info-row total">
                    <p class="detail__info-header">Total</p>
                    <p class="detail__info-data">355,760 VND</p>
                </div>
            </div>
            <div class="detail__btn-wrapper">
                <input class="detail__btn accept" type="submit" value="Accept">
                <input class="detail__btn cancel" type="submit" value="Cancel">
                <button class="detail__btn print" onclick="window.print();return false">Print</button>
            </div>
        </div>
        <div name="addVoucherModal" class="add__modal">
            <h1 class="add__modal-header">Add new voucher</h1>
            <form class="add__modal-wrapper" action="" method="POST"  id="add-voucher-form">
                @csrf
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
                        <select name="voucher-type" id="" class="add__input-text">
                            <option value="">-- Voucher type --</option>
                            <option value="Discount">Discount</option>
                            <option value="Freeship">Freeship</option>
                        </select>
                        <span style="color: red; font-size: 12px;" class="voucher-type_error error"></span>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Value (VND) <span
                                class="add__input-require">*</span></label>
                        <input type="number" name="voucher-value" class="add__input-text" min="0">
                        <span style="color: red; font-size: 12px;" class="voucher-value_error error"></span>
                    </div>
                </div>
                <div class="add__input-group-wrapper">
                    <div class="add__input-group" style="padding-right: 20px">
                        <label for="" class="add__input-label">Effective date <span class="add__input-require">*</span></label>
                        <input type="date" name="voucher-start-date" class="add__input-text">
                        <span style="color: red; font-size: 12px;" class="voucher-start-date_error error"></span>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Expiration date <span class="add__input-require">*</span></label>
                        <input type="date" name="voucher-end-date" class="add__input-text">
                        <span style="color: red; font-size: 12px;" class="voucher-end-date_error error"></span>
                    </div>
                </div>
                <div class="add__input-group-wrapper">
                    <div class="add__input-group" style="padding-right: 10px">
                        <label for="" class="add__input-label">Bill over (VND) <span class="add__input-require">*</span></label>
                        <input type="number" name="voucher-constraint" min="0" class="add__input-text">
                        <span style="color: red; font-size: 12px;" class="voucher-constraint_error error"></span>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">CODE <span class="add__input-require">*</span></label>
                        <input type="text" name="voucher-code" class="add__input-text">
                        <span style="color: red; font-size: 12px;" class="voucher-code_error error"></span>
                    </div>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Quantity <span class="add__input-require">*</span></label>
                    <input type="number" name="voucher-quantity" class="add__input-text" min="1">                        <span style="color: red; font-size: 12px;" class="voucher-constraint_error error"></span>
                    <span style="color: red; font-size: 12px;" class="voucher-quantity_error error"></span>
                </div>
                <div class="add__btn-wrapper">
                    <input class="add__btn" type="submit" value="Create">
                    <button class="add__btn cancel" onclick="closeModalBtn('addVoucher')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

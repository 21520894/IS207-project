<div class="modal">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <div name="addDishModal" class="add__modal">
            <h1 class="add__modal-header">Add new dish</h1>
            <form class="add__modal-wrapper" action="" method="">
                <div class="add__input-group">
                    <label for="" class="add__input-label">Name <span class="add__input-require">*</span></label>
                    <input type="text" class="add__input-text" required>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Price (VND) <span class="add__input-require">*</span></label>
                    <input type="number" min="0" class="add__input-text" required>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
                    <select name="" id="" class="add__input-text" required>
                        <option value="">-- Category --</option>
                        <option value="">Beefsteak</option>
                        <option value="">Pizza</option>
                        <option value="">Pasta</option>
                        <option value="">Salad</option>
                        <option value="">Desert</option>
                        <option value="">Drink</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="add__input-group input-group--inactive">
                    <label for="" class="add__input-label">Category name <span class="add__input-require">*</span></label>
                    <input type="text" class="add__input-text" required>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Describe <span class="add__input-require">*</span></label>
                    <textarea class="add__input-text" name="" id="" cols="30" rows="5" required></textarea>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Image <span class="add__input-require">*</span></label>
                    <input type="file" class="add__input-text" accept="image/*" required>
                </div>
                <div class="add__btn-wrapper">
                    <input class="add__btn" type="submit" value="Add new dish">
                    <button class="add__btn cancel" onclick="closeModalBtn('addDish')">Cancel</button>
                </div>
            </form>
        </div>
        <div name="deleteModal" class="delete__modal">
            <i class="delete__icon fa-solid fa-exclamation"></i>
            <p class="delete__message">
                Are you sure you want to delete current data? These data cannot be recovered
            </p>
            <div class="delete__btn-wrapper">
                <button class="delete__btn btn">Delete</button>
                <button class="cancel__btn btn" onclick="closeModalBtn('delete')">Cancel</button>
            </div>
        </div>
        <div name="viewDetailModal" class="detail__modal">
            <h1 class="detail__header">Order - <span class="detail__order-id">001</span></h1>
            <div class="detail__user-info">
                <div class="detail__info-row">
                    <p class="detail__info-header">Name:</p>
                    <p class="detail__info-data">Nguyễn Văn A</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Phone:</p>
                    <p class="detail__info-data">090123456</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Address:</p>
                    <p class="detail__info-data">KTX Khu B, ĐHQG TP.HCM</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Time:</p>
                    <p class="detail__info-data">11:00 AM, 11/12/2023</p>
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
                <div class="detail__info-row">
                    <p class="detail__info-header">Sub-total</p>
                    <p class="detail__info-data">298,000 VND</p>
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
            <form class="add__modal-wrapper" action="" method="">
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
                        <select name="" id="" class="add__input-text" required>
                            <option value="">-- Voucher type --</option>
                            <option value="">Discount</option>
                            <option value="">Freeship</option>
                        </select>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Value (VND) <span class="add__input-require">*</span></label>
                        <input type="number" class="add__input-text" min="0" required>
                    </div>
                </div>
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Effective date <span class="add__input-require">*</span></label>
                        <input type="date" class="add__input-text" required>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Expiration date <span class="add__input-require">*</span></label>
                        <input type="date" class="add__input-text" required>
                    </div>
                </div>
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Bill over (VND)</label>
                        <input type="number" min="0" class="add__input-text">
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Discount maximum (VND)</label>
                        <input type="number" min="0" class="add__input-text">
                    </div>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Quantity</label>
                    <input type="number" class="add__input-text" min="1" required>
                </div>
                <div class="add__btn-wrapper">
                    <input class="add__btn" type="submit" value="Create">
                    <button class="add__btn cancel" onclick="closeModalBtn('addVoucher')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH D:\subject_learning\is207\wamp64\www\IS207_project_git\is207_project\resources\views/admin/components/modal.blade.php ENDPATH**/ ?>
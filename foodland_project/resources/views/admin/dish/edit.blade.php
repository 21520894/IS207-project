<div class="add__modal" name="editDishModal">
    <h1 class="add__modal-header">EDIT DISH</h1>
    <div class="grid__full-width">
        <div class="grid__row">
            <div class="edit__page">
                <form class="edit__page-wrapper" action="" method="" id="edit-dish-form">
                    <img class="edit__page-img" src="../../assets/img/item11.jpg" alt="">
                    <div class="edit__page-input-wrapper">
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">ID</label>
                                <input type="text" class="edit__input-text" disabled id="up_id">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Name <span
                                        class="edit__input-require">*</span></label>
                                <input type="text" class="edit__input-text" id="up_name">
                            </div>
                        </div>
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Price (VND) <span
                                        class="edit__input-require">*</span></label>
                                <input type="number"  class="edit__input-text" id="up_price">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Group <span
                                        class="edit__input-require">*</span></label>
                                <select name="" id="" class="edit__input-text">
                                    <option id="up_category"></option>
                                    @if(!empty(getAllCategories()))
                                        @foreach(getAllCategories() as $item)
                                            <option value="">{{$item->Title}}</option>
                                        @endforeach
                                    @endif
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="edit__input-group input-group--inactive">
                            <label for="" class="edit__input-label">Category name <span class="edit__input-require">*</span></label>
                            <input type="text" class="edit__input-text" required>
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Describe <span
                                    class="edit__input-require">*</span></label>
                            <textarea class="edit__input-text" name="" cols="30" rows="5" id="up_description">
                                </textarea>
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Image <span class="edit__input-require">*</span></label>
                            <input type="file" class="edit__input-text" accept="image/*" required>
                        </div>
                        <div class="edit__btn-wrapper">
                            <input class="edit__btn" type="submit" value="Save">
                            <a href="index.php?action=dishManager&query=null" class="edit__btn cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

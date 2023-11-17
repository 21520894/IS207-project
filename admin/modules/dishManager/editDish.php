<div class="edit__page">
    <form class="edit__page-wrapper" action="" method="">
        <img class="edit__page-img" src="../assets/img/item11.jpg" alt="">
        <div class="edit__page-input-wrapper">
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">ID</label>
                    <input type="text" class="edit__input-text" disabled>
                </div>
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Name <span class="edit__input-require">*</span></label>
                    <input type="text" class="edit__input-text" required>
                </div>
            </div>
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Price (VND) <span class="edit__input-require">*</span></label>
                    <input type="number" class="edit__input-text" required>
                </div>
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Group <span class="edit__input-require">*</span></label>
                    <select name="" id="" class="edit__input-text" required>
                        <option value="">-- Category --</option>
                        <option value="">Beefsteak</option>
                        <option value="">Pizza</option>
                        <option value="">Pasta</option>
                        <option value="">Salad</option>
                        <option value="">Desert</option>
                        <option value="">Drink</option>
                        <option value="">Other</option>
                    </select>
                </div>
            </div>
            <div class="edit__input-group">
                <label for="" class="edit__input-label">Describe <span class="edit__input-require">*</span></label>
                <textarea class="edit__input-text" name="" id="" cols="30" rows="5" required></textarea>
            </div>
            <div class="edit__input-group">
                <label for="" class="edit__input-label">Image <span class="edit__input-require">*</span></label>
                <input type="file" class="edit__input-text" accept="image/*" required>
            </div>
            <div class="edit__btn-wrapper">
                <input class="edit__btn" type="submit" value="Complete">
                <a href="index.php?action=dishManager&query=null" class="edit__btn cancel">Cancel</a>
            </div>
        </div>
    </form>
</div>
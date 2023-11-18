<div class="edit__page">
    <form class="edit__page-wrapper" action="" method="">
        <div class="edit__page-input-wrapper">
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">ID</label>
                    <input type="text" class="edit__input-text" disabled>
                </div>
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Phone</label>
                    <input type="number" class="edit__input-text" disabled>
                </div>
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Register date</label>
                    <input type="date" class="edit__input-text" disabled>
                </div>
            </div>
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Name <span class="edit__input-require">*</span></label>
                    <input type="text" class="edit__input-text" required>
                </div>
                <div class="edit__input-group">
                    <label for="" class="edit__input-label">Group <span class="edit__input-require">*</span></label>
                    <select name="" id="" class="edit__input-text" required>
                        <option value="">-- Group --</option>
                        <option value="">Admin</option>
                        <option value="">User</option>
                    </select>
                </div>
            </div>
            <div class="edit__input-group">
                <label for="" class="edit__input-label">Mail</label>
                <input type="email" class="edit__input-text" disabled>
            </div>
            <div class="edit__input-group input-group--inactive">
                <label for="" class="edit__input-label">Category name <span class="edit__input-require">*</span></label>
                <input type="text" class="edit__input-text" required>
            </div>
            <div class="edit__input-group">
                <label for="" class="edit__input-label">Facebook</label>
                <input type="text" class="edit__input-text" name="" id=""></input>
            </div>
            <div class="edit__btn-wrapper">
                <input class="edit__btn" type="submit" value="Save">
                <a href="index.php?action=userManager&query=null" class="edit__btn cancel">Cancel</a>
            </div>
        </div>
    </form>
</div>
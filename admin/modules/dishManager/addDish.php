<div class="add__page">
    <h1 class="add__page-header">Add new dish</h1>
    <form class="add__page-wrapper" action="" method="">
        <div class="add__input-group">
            <label for="" class="add__input-label">Name <span class="add__input-require">*</span></label>
            <input type="text" class="add__input" required>
        </div>
        <div class="add__input-group">
            <label for="" class="add__input-label">Price (VND) <span class="add__input-require">*</span></label>
            <input type="number" class="add__input" required>
        </div>
        <div class="add__input-group">
            <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
            <select name="" id="" class="add__input" required>
                <option value="">Beefsteak</option>
                <option value="">Pizza</option>
                <option value="">Pasta</option>
                <option value="">Salad</option>
                <option value="">Desert</option>
                <option value="">Drink</option>
                <option value="" selected>Other</option>
            </select>
        </div>
        <div class="add__input-group">
            <label for="" class="add__input-label">Describe <span class="add__input-require">*</span></label>
            <textarea class="add__input" name="" id="" cols="30" rows="10" required></textarea>
        </div>
        <div class="add__input-group">
            <label for="" class="add__input-label">Image <span class="add__input-require">*</span></label>
            <input type="file" class="add__input" accept="image/*" required>
        </div>
        <input class="add__btn" type="submit" value="Add new dish">
        <a href="index.php?action=dishManager" class="add__btn cancel">Cancel</a>
    </form>
</div>
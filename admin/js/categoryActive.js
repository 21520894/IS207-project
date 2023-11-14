const dishCategoryBtns = document.querySelectorAll('.dish__category-btn');
for (const btn of dishCategoryBtns) {
    btn.addEventListener('click', function () {
            btn.classList.add('dish__category-btn--active');
        for (const btn of dishCategoryBtns) {
            if (btn !== this) {
                btn.classList.remove('dish__category-btn--active');
            }
        }
    })
}
const categoryGroup = document.querySelectorAll('select[class*="__input-text"]');

for (const category of categoryGroup) {
    category.addEventListener('change', function() {
        const categoryInput = document.querySelector('[class*="input-group--"]')
        if (category.value == 'other') {
            categoryInput.classList.remove('input-group--inactive');
            categoryInput.classList.add('input-group--active');
        } else {
            categoryInput.classList.remove('input-group--active');
            categoryInput.classList.add('input-group--inactive');
        }
    }) 
}

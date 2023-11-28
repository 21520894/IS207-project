// const categoryGroup = document.querySelectorAll('select[class*="__input-text"]');
//
// for (const category of categoryGroup) {
//     category.addEventListener('change', function() {
//         const categoryInput = document.querySelector('[class*="input-group--"]')
//         if (category.value === 'new category') {
//             categoryInput.classList.remove('input-group--inactive');
//             categoryInput.classList.add('input-group--active');
//         } else {
//             categoryInput.classList.remove('input-group--active');
//             categoryInput.classList.add('input-group--inactive');
//         }
//     })
// }

const editCategoryGroup = document.querySelector('select[class="edit__input-text"]');

editCategoryGroup.addEventListener('change', function (){
    const categoryInput = document.querySelector('[class*="edit-group"]')

    if (editCategoryGroup.value === 'new category') {
        categoryInput.classList.remove('input-group--inactive');
        categoryInput.classList.add('input-group--active');
        console.log(editCategoryGroup.value);
    } else {
        categoryInput.classList.remove('input-group--active');
        categoryInput.classList.add('input-group--inactive');
    }
});


const addCategoryGroup = document.querySelector('select[class="add__input-text"]');
addCategoryGroup.addEventListener('change', function (){
    const categoryInput = document.querySelector('[class*="add-group"]')
    if (addCategoryGroup.value === 'new category') {
        categoryInput.classList.remove('input-group--inactive');
        categoryInput.classList.add('input-group--active');
        console.log(editCategoryGroup.value);
    } else {
        categoryInput.classList.remove('input-group--active');
        categoryInput.classList.add('input-group--inactive');
    }
});

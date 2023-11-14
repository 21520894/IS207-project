const menuBtns = document.querySelectorAll('.menu__item-link');
const content = document.querySelectorAll('.content');
for (const btn of menuBtns) {
    if (btn.href == window.location.href) {
        btn.classList.add('menu__item-link--active');
    } else {
        btn.classList.remove('menu__item-link--active');
    }
}
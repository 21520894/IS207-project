const menuBtns = document.querySelectorAll('.menu__item-link');

const subMenu = document.querySelector('.menu__sub-item');

for (const btn of menuBtns) {
    if (btn.href == window.location.href) {
        btn.classList.add('menu__item-link--active');
    } else {
        btn.classList.remove('menu__item-link--active');
    }

    const btnParent = getParentElement(btn, "menu__item");
    const subMenuParent = getParentElement(subMenu, "menu__item");
    if (btnParent === subMenuParent) {
        btn.addEventListener("click", function() {
            subMenu.classList.toggle('menu__sub-item--active');
        })
    }
}
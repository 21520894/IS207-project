const modal = document.querySelector(".modal");

const modalOverlay = modal.querySelector(".modal__overlay");

// Create an array archive name of each modal, same name with button
const modalName = ["signin", "signup", "forgot", "reset", "changeAddress", "productDetail"];

// Get all input in modal
const inputTexts = modal.querySelectorAll("[class*='__input-text']");

function resetInput() {
    for (const input of inputTexts) {
        input.value = '';
    }
}

function openModal(id) {
    const form = document.querySelector(`[name*="${id}Modal"]`);
    form.style.display = "block";
}

function closeModal(id) {
    const form = document.querySelector(`[name*="${id}Modal"]`);
    form.style.display = "none";
    resetInput();
}

function closeModalBtn(id) {
    closeModal(id);
    modal.style.display = "none";
}

for (const item of modalName) {
    // Get list of button with the name of array modalName
    const navItems = document.querySelectorAll(`[name='${item}']`);

    navItems.forEach(function (item) {
        item.addEventListener("click", function () {

            if (item.getAttribute('name') == "productDetail") {
                const menuProduct = getParentElement(item, "menu__product");
                setDetailProduct(menuProduct);
            }

            if (item.getAttribute('name') == "changeAddress") {

                const changeAddressModal = modal.querySelector('[name*="changeAddressModal"]');
                const inputs = changeAddressModal.querySelectorAll('.auth-form__input-text');
                const phoneNumber = changeAddressModal.querySelector('input[placeholder*="Phone Number"]');
                const streetAddress = changeAddressModal.querySelector('input[placeholder*="Street Address"]');
                const btn = changeAddressModal.querySelector('.auth-form__button');
                let isEmpty = false;

                btn.addEventListener('click', function() {
                    for (const input of inputs) {
                        if (input.value === '') {
                            isEmpty = true;
                        } else {
                            isEmpty = false;
                        }
                    }
                    if (!isEmpty) {
                        const address = streetAddress.value;
                        const phone = phoneNumber.value;
                        setOrderInfo(address, phone);
                    }
                })
            }

            // Display modal
            modal.style.display = "flex";
            openModal(item.getAttribute("name"));

            // Close other modal
            for (const item of modalName) {
                if (item !== this.getAttribute("name")) {
                    closeModal(item);
                }
            }
        });
    });

    // Close when click outside modal
    modalOverlay.addEventListener("click", function () {
        modal.style.display = "none";
        closeModal(item);
    });
}

function setOrderInfo(address, phone) {

    const addressInfo = document.querySelectorAll('[class*="__address-info"]');
    for (const item of addressInfo) {
        item.innerText = address;
    }
    const phoneInfo = document.querySelector('.order__phone-info');
    phoneInfo.innerText = phone;

}

function setDetailProduct(menuProduct) {

    // Get product content
    const img = menuProduct.querySelector('[class*="__product-img"]').src;
    const name = menuProduct.querySelector('[class*="__product-name"]').innerText;
    const price = menuProduct.querySelector('[class*="__product-price"]').innerText;
    const desc = menuProduct.querySelector('[class*="__product-desc"]').innerHTML;
    const id = menuProduct.id;

    // Set detail product content
    const detailProduct = modal.querySelector('.detail__product-wrapper');
    detailProduct.querySelector('[class*="__product-img"]').src = img;
    detailProduct.querySelector('[class*="__product-name"]').innerText = name;
    detailProduct.querySelector('[class*="__product-price"]').innerText = price;
    detailProduct.querySelector('[class*="__product-desc"]').innerHTML = desc;
    detailProduct.id = id;

}

const modal = document.querySelector(".modal");

const modalOverlay = modal.querySelector(".modal__overlay");

// Create an array archive name of each modal, same name with button
const modalName = ["add", "delete", "viewDetail"];

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

            if (item.getAttribute('name') == "viewDetail") {
                const viewDetailModal = modal.querySelector('[name*="viewDetailModal"]');
                const accept = viewDetailModal.querySelector('.accept');
                const cancel = viewDetailModal.querySelector('.cancel');
                const print = viewDetailModal.querySelector('.print');
                if (item.innerText.toLowerCase() === "wait") {
                    accept.style.display = 'inline-block';
                    cancel.style.display = 'inline-block';
                    print.style.display = 'none';
                } else {
                    accept.style.display = 'none';
                    cancel.style.display = 'none';
                    print.style.display = 'inline-block';
                }
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
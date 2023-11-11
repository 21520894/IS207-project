const modal = document.querySelector(".modal");

const modalOverlay = modal.querySelector(".modal__overlay");

// Create an array archive name of each modal, same name with button
const modalName = ["signin", "signup", "forgot", "reset", "changeAddress"];

function openModal(id) {
    const form = document.querySelector(`#${id}Modal`);
    form.style.display = "block";
}

function closeModal(id) {
    const form = document.querySelector(`#${id}Modal`);
    form.style.display = "none";
}

for (const item of modalName) {
    // Get list of button with the name of array modalName
    const navItems = document.querySelectorAll(`[name='${item}']`);

    navItems.forEach(function (item) {
        item.addEventListener("click", function () {
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

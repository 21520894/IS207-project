// Update the price of order bill
function updateOrder() {

    // Get order page element
    const orderPage = document.querySelector('#order__page');
    
    // Get order cart element
    const orderCart = orderPage.querySelector('.order__cart-item-wrapper');
    
    // Get order bill element
    const orderBill = orderPage.querySelector('.order__pay-bill');
    
    // Get list of price
    const prices = orderCart.querySelectorAll('.cart-item__price');
    
    // Declare total price of item
    let subTotal = 0;

    // Declare total item of cart
    let cartQuantity = 0;

    // Sum price
    for (const price of prices) {
        
        let itemWrapper = getParentElement(price, 'cart-row');
        
        // Get item quantity
        let itemQuantity = itemWrapper.querySelector('.cart-item__quantity-input').value;

        cartQuantity += parseFloat(itemQuantity);
        
        subTotal += parseFloat(price.innerText) * parseFloat(itemQuantity);
    }

    let vatFee = subTotal * 0.08;
    let discount = vatFee;    
    let shippingFee = 0;

    if (subTotal) {

        // Default shippingFee
        shippingFee = 27000;
    }

    let total = subTotal + shippingFee;

    // Order bill content
    orderBill.querySelector('.order__sub-total').innerText = subTotal + ' VND';
    orderBill.querySelector('.order__shipping').innerText = shippingFee + ' VND';
    orderBill.querySelector('.order__vat').innerText = vatFee + ' VND';
    orderBill.querySelector('.order__discount').innerText = discount + ' VND';
    orderBill.querySelector('.order__total').innerText = total + ' VND';
    orderBill.querySelector('.order__cart-quantity').innerText = cartQuantity;

    // Modify cart quantity of order page
    orderPage.querySelector('.order__cart-quantity').innerText = cartQuantity;


}
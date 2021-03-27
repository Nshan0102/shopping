let basketStore = [];
let basketStoreFromLocalStorage = localStorage.getItem('basket_store');
if (basketStoreFromLocalStorage != undefined) {
    let parsedBasketStoreFromLocalStorage = JSON.parse(basketStoreFromLocalStorage);
    basketStore = Array.isArray(parsedBasketStoreFromLocalStorage) ? parsedBasketStoreFromLocalStorage : [];
}
localStorage.setItem('basketStore', JSON.stringify(basketStore));

function emptyBasket() {
    localStorage.setItem('basketStore', JSON.stringify([]));
    window.location.reload();
}

function addToBasket(product_id) {
    let product = basketStore.find(prod => prod.id === parseInt(product_id));
    if (product != undefined) {
        basketStore.forEach((prod) => {
            if (prod.id === product_id) {
                prod.quantity++;
            }
        });
    } else {
        product = {
            id: product_id,
            quantity: 1
        }
        basketStore.push(product);
    }
    localStorage.setItem('basketStore', JSON.stringify(basketStore));
}

function removeFromBasket(product_id) {

}
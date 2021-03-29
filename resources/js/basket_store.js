class Basket {
    set(basket, init, force = false) {
        this.basket = basket.length || force ? basket : this.getFromLocalStorage();
        init && this.basket.length ? setBasket(this.basket) : void (0);
        this.updateItemsCount();
        this.storeToLocalStorage(this.basket);
    }

    updateItemsCount() {
        this.itemsCount = this.basket.length;
        let basket = document.querySelector("#basketItemsCount");
        basket ? basket.innerHTML = "(" + this.itemsCount + ")" : void (0);
    }

    reset() {
        this.set([], false, true);
        this.storeToLocalStorage(this.basket);
        this.updateItemsCount();
    }

    storeToLocalStorage() {
        localStorage.setItem("basket", JSON.stringify(this.basket));
    }

    getFromLocalStorage() {
        let parsedBasket = JSON.parse(localStorage.getItem("basket") ?? "[]");
        return Array.isArray(parsedBasket) ? parsedBasket : [];
    }

    addProduct(product_id, quantity = 1) {
        let product = this.basket.find(prod => prod.id === +product_id);
        if (typeof product !== "undefined") {
            this.basket = this.basket.map((prod) => {
                prod.id === product_id ? prod.quantity += quantity : void (0);
            });
        } else {
            product = {
                id: product_id,
                quantity: quantity
            }
            this.basket.push(product);
        }
        this.storeToLocalStorage(this.basket);
        this.updateItemsCount();
    }

    removeProduct(product_id) {
        this.set(this.basket.filter(({id}) => id === product_id));
    }

    getProductIds() {
        return this.basket.map(({id}) => id);
    }

    getId(selector) {
        let productDataId = $(selector).data("product-id");
        return productDataId || null;
    }

    getQuantity(selector) {
        let quantityInputValue = $(selector).parent().find(".quantity").val();
        let quantity = +quantityInputValue || 1;
        $(selector).parent().find(".quantity").val(quantity);
        return quantity;
    }
}

export default Basket;
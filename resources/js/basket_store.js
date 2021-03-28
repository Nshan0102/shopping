class Basket {
    constructor($) {
        this.$ = $;
    }

    set(basket, init, force = false) {
        if (basket.length > 0 || force) {
            this.basket = basket;
        } else {
            this.basket = this.getFromLocalStorage();
        }
        if (init && this.basket.length > 0) {
            window.setBasket(this.basket);
        }
        this.updateItemsCount();
        this.storeToLocalStorage(this.basket);
    }

    updateItemsCount() {
        this.itemsCount = this.basket.length;
        let basket = document.querySelector("#basketItemsCount");
        if (basket) {
            basket.innerText = "(" + this.itemsCount + ")";
        }
    }

    reset() {
        this.set([]);
        this.storeToLocalStorage(this.basket);
        this.updateItemsCount();
    }

    storeToLocalStorage(basket) {
        localStorage.setItem("basket", JSON.stringify(basket));
    }

    getFromLocalStorage() {
        let parsedBasket = JSON.parse(localStorage.getItem("basket") ?? "[]");
        return Array.isArray(parsedBasket) ? parsedBasket : [];
    }

    addProduct(product_id, quantity = 1) {
        let product = this.basket.find(prod => prod.id === parseInt(product_id));
        if (typeof product !== "undefined") {
            this.basket.forEach((prod) => {
                if (prod.id === product_id) {
                    prod.quantity += quantity;
                }
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
        this.set(this.basket.filter(product => product.id !== product_id));
    }

    getProductIds() {
        return this.basket.map(product => product.id);
    }

    getId(selector) {
        let productDataId = $(selector).data("product-id");
        return productDataId > 0 ? productDataId : null;
    }

    getQuantity(selector) {
        let quantityInputValue = $(selector).parent().find(".quantity").val();
        return quantityInputValue > 0 ? parseInt(quantityInputValue) : 1;
    }
}

export default Basket;
require("./bootstrap.js");
const toastr = require("toastr");
toastr.options.positionClass = 'toast-bottom-left';
window.addEventListener("DOMContentLoaded", function () {
    window.storeToBasket = function (product, element, method, action) {
        $.ajax({
            type: method,
            url: process.env.MIX_APP_URL + "/basket/" + action,
            data: {
                product: product
            },
            beforeSend: function () {
                $(element).attr("disabled", true);
            },
            success: function (response) {
                $(element).removeAttr("disabled");
                basketStore.set(response);
                toastr.success("Product was " + action + "ed", "Success", {timeOut: 5000});
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $(element).removeAttr("disabled");
                toastr.error("Product wasn't " + action + "ed", "Error", {timeOut: 5000});
                console.log({
                    xhr: xhr,
                    ajaxOptions: ajaxOptions,
                    thrownError: thrownError
                });
            }
        });
    }
    window.removeFromBasket = function (product, element) {
        $.ajax({
            type: "DELETE",
            url: process.env.MIX_APP_URL + "/basket/remove",
            data: {
                product: product
            },
            beforeSend: function () {
                $(element).attr("disabled", true);
            },
            success: function (response) {
                $(element).removeAttr("disabled");
                basketStore.set(response, false, true);
                toastr.success("Product removed from basket", "Success", {timeOut: 5000});
                $(element).parents(".product-card").parent().remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $(element).removeAttr("disabled");
                toastr.error("Product wasn't removed from basket", "Error", {timeOut: 5000});
                console.log({
                    xhr: xhr,
                    ajaxOptions: ajaxOptions,
                    thrownError: thrownError
                });
            }
        });
    }
    window.setBasket = function (products) {
        $.ajax({
            type: "POST",
            url: process.env.MIX_APP_URL + "/basket/set",
            data: {
                products: products
            },
            complete: function (response) {
                basketStore.set(response);
            }
        });
    }
    window.Basket = require("./basket_store").default;
    window.basketStore = new Basket();
});

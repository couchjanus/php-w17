
function el(selector) {
    return document.querySelector(selector);
}
function openCart() {
    showCart();
    el(".sidebar").classList.add("active");
    el(".overlay").classList.add("active");
}

function closeCart() {
    el(".sidebar").classList.remove("active");
    el(".overlay").classList.remove("active");
}


class Product {
    constructor(id, name, price, picture, amount){
          this.id = id;
          this.name = name;
          this.price = price;
          this.picture = picture;
          this.amount = amount;
    }
}

function getProduct(item) {
    var pictures = item.picture.split(",");
    return {
        id: item.id,
        price:item.price,
        name:item.name,
        picture:"/assets/images/products/"+pictures[0]
	}    
}

function productInCart(content, item) {
    content.querySelector('.cart-item').setAttribute('id', item.id);
    content.querySelector('.item-title').textContent = item.name;
    content.querySelector('.item-price').textContent = item.price;
    content.querySelector('.quontity').textContent = item.amount;
    content.querySelector('.item-price').setAttribute('price', item.price);
    content.querySelector('.item-img').style.backgroundImage= 'url('+ item.picture+")";
    content.querySelector('.item-price').innerText = parseFloat(item.price * item.amount).toFixed(2);
    return content;
}

function showCart() {
    let shoppingCart = getProducts();

    if (shoppingCart.length == 0) {
        console.log("Your Shopping Cart is Empty!");
        return;
    }
    document.querySelector(".cart-items").innerHTML = '';
    shoppingCart.forEach(function (item) {
        let template = document.getElementById("cartItem").content;
        document.querySelector(".cart-items").append(document.importNode(productInCart(template, item), true));
    });
    changeTotal();
}



function changeTotal() {
    let price = 0;
    let itemPrices = document.querySelectorAll('.item-price');
    itemPrices.forEach(function (item) {
      price += parseFloat(item.innerText);
    });
  
    price = Math.round(price * 100) / 100;
    let tax = Math.round(price * 0.05 * 100) / 100;
    let shipping = parseFloat(document.querySelector(".shipping span").innerText);
    let fullPrice = Math.round((price + tax + shipping) * 100) / 100;
  
    if (price == 0) {
      fullPrice = 0;
    }
  
    document.querySelector(".subtotal span").innerText = price;
    document.querySelector(".tax span").innerText = tax;
    document.querySelector(".total span").innerText = fullPrice;
}

function slideItem(content, item, i) {
    content.querySelector('.carousel-detail-item').setAttribute('productId', item.id);
    
    content.querySelector('.carousel-item__title').textContent = item.name;
    content.querySelector('.carousel-item__subtitle').textContent =
        item.subtitle[i];

    content.querySelector('.carousel-item__description').textContent =
        item.description;

    content.querySelector('.carousel-item__image').style.backgroundImage =
        'url(images/' + item.picture[i] + ')';

    return content;
}

function carousel(dataItem) {
    let carouselItem = el('#carouselItem').content;

    let detailTemplate = el('#productDetail').content;

    for (let i = 0; i < dataItem.picture.length; i++) {
        detailTemplate
            .querySelector('.carousel-detail')
            .append(
                document.importNode(
                    slideItem(carouselItem, dataItem, i),
                    true
                )
            );
    }

    el('.showcase').replaceWith(document.importNode(detailTemplate, true));

    document
        .querySelectorAll('.carousel-detail-item')[0]
        .classList.add('active-slide');

    var total = document.querySelectorAll('.carousel-detail-item').length;

    var current = 0;
    moveLR('#moveRight', 1);
    moveLR('#moveLeft', -1);

    let addToCart = document.querySelector('.add-to-cart');
    let template = document.getElementById('cartItem').content;

    addToCart.addEventListener('click', function() {
        // document.querySelector('.cart-items').append(document.importNode(addProductToCart(template, data[this.closest('.carousel-detail-item').getAttribute('productId')]), true));
        
        let product = getProduct(data[this.closest('.carousel-detail-item').getAttribute('productId')]);
        saveCartToStore(product);

        // saveCartToStore(product);
        changeTotal();
    });

    function moveLR(eId, step) {
        el(eId).addEventListener('click', function() {
            let prev_next = current;
            current = current + step;
            setSlide(prev_next, current);
        });
    }

    function setSlide(prev, next) {
        let slide = current;
        if (next > total - 1) {
            slide = 0;
            current = 0;
        }
        if (next < 0) {
            slide = total - 1;
            current = total - 1;
        }
        document
            .querySelectorAll('.carousel-detail-item')
            [prev].classList.remove('active-slide');
        document
            .querySelectorAll('.carousel-detail-item')
            [slide].classList.add('active-slide');
    }
}


function makeProductItem($template, product) {
    var pictures = product.picture.split(",");
    $template.querySelector('.col-md-4').setAttribute('productId', product.id);
    $template.querySelector('.product-name').textContent = product.name;
    $template.querySelector('.card-img-top').setAttribute('src', '/assets/images/products/' + pictures[0]);
    $template.querySelector('img').setAttribute('alt', product.name);
    $template.querySelector('.product-price').textContent = parseFloat(product.price).toFixed(2);
    $template.querySelector('.card-text').textContent = product.description;
    return $template;
}

function _translate(img, offset=-150){
    let rect = img.getBoundingClientRect();
    let elements = ['translate3D('];
    return [...elements, rect.left - offset + 'px,', rect.top - offset + 'px,0)'].join('');
}

function moveToCart(imgItem, win) {
    if (imgItem) {
        let imgClone = imgItem.cloneNode(true);
        imgClone.classList.add('offset-img');

        document.body.appendChild(imgClone);

        imgItem.style.transform = 'rotateY(180deg)';
        win.style.display = 'block';

        imgClone.animate([{
            transform: _translate(imgItem)
            },
            {
                transform: _translate(document.querySelector('#sidebarCollapse'), 50) + 'perspective(500px) scale3d(0.1, 0.1, 0.2)'
            },
        ], {
            duration: 2000,
        })
        .onfinish = function() {
            imgClone.remove();
            imgItem.style.transform = 'rotateY(0deg)';
            win.style.display = 'none';
        };
    }
}

function saveCartToStore(product) {

    let tmpProducts = getProducts();

    if(tmpProducts.length > 0){
      let exist = tmpProducts.some(elem => {
        return elem.id === product.id;
      });
      if(exist){
        tmpProducts.forEach(elem => {
            if(elem.id === product.id){
              elem.amount += 1;
            }
        })
      } else {
        tmpProducts.push(new Product(product.id, product.name, product.price, product.picture, 1));
      }
    }
    else{
      tmpProducts.push(new Product(product.id, product.name, product.price, product.picture, 1));
    }
    window.localStorage.setItem("basket",JSON.stringify(tmpProducts));
}


function initStorage() {
    window.localStorage.getItem("basket") ?
      window.localStorage.getItem("basket") :
      window.localStorage.setItem("basket", JSON.stringify([]));
}

function getProducts() {
    return JSON.parse(window.localStorage.getItem("basket"));
}


function removeProduct(index) {
    let tmpProducts = getProducts();
    tmpProducts.splice(tmpProducts.indexOf(tmpProducts.find(x => x.id === +(index))), 1);
    window.localStorage.setItem("basket", JSON.stringify(tmpProducts));
}

function plusProduct(id) {
    let tmpProducts = getProducts();
    tmpProducts.forEach(elem => {
        if (elem.id === +(id)) {
            elem.amount += 1;
        }
    });
    window.localStorage.setItem("basket", JSON.stringify(tmpProducts));
}

function minusProduct(id) {
    let tmpProducts = getProducts();
    tmpProducts.forEach(elem => {
        if (elem.id === +(id)) {
            elem.amount -= 1;
        }
    });
    window.localStorage.setItem("basket", JSON.stringify(tmpProducts));
}


const url = '/api/shop';

(function () {

    el('#sidebarCollapse').addEventListener('click', () => openCart());
    el('.dismiss').addEventListener('click', () => closeCart());
    el('.overlay').addEventListener('click', () => closeCart());

    const template = el('#productItem').content;
    const content = el('#cartItem').content;

    // ---------------------Step 1-----------------------------------
    fetch(url)
        .then(function (response) {
            if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' + response.status);
                return;
            }
            response.json().then(function (data) {

                // Make Product Item
                data.forEach((item) => {
                    el('.showcase').append(makeProductItem(template, item).cloneNode(true));
                });

                initStorage();


                // ---------------------add-to-cart------------------------------

                let addToCarts = document.querySelectorAll('.add-to-cart');

                addToCarts.forEach(function (addToCart) {
                    addToCart.addEventListener('click', function () {

                        let id = this.closest('.col-md-4').getAttribute('productId');
                        let dataItem = data[0];

                        // console.log(data[0]);
                        // console.log(product);
                        // создадим объект
                        let product = getProduct(dataItem);
                        console.log(product);
                        saveCartToStore(product);
                        

                        let imgItem = this.closest('.card').querySelector('img');
                        let win = this.closest('.card').querySelector('.win');
                        moveToCart(imgItem, win);

                    });
                });


                document.querySelector('.cart-items').addEventListener(
                    'click',
                    function (e) {
                        if (e.target && e.target.matches('.remove-item')) {
                            let index = e.target.closest('.cart-item').getAttribute('id');
                            removeProduct(index);
                            e.target.parentNode.parentNode.remove();
                            changeTotal();
                        }

                        if (e.target && e.target.matches('.plus')) {
                            let el = e.target;
                            let price = parseFloat(
                                el.parentNode.nextElementSibling
                                .querySelector('.item-price')
                                .getAttribute('price')
                            );

                            let id = el.closest('.cart-item').getAttribute('id');
                            plusProduct(id);
                            let val = parseInt(el.previousElementSibling.innerText);
                            val++;
                            el.previousElementSibling.innerText = val;

                            el.parentNode.nextElementSibling.querySelector(
                                '.item-price'
                            ).innerText = parseFloat(price * val).toFixed(2);
                            changeTotal();

                        }

                        if (e.target && e.target.matches('.minus')) {
                            let el = e.target;
                            let price = parseFloat(
                                el.parentNode.nextElementSibling
                                .querySelector('.item-price')
                                .getAttribute('price')
                            );

                            let id = el.closest('.cart-item').getAttribute('id');
                            let val = parseInt(el.nextElementSibling.innerText);
                            if (val > 1) {
                                val--;
                                el.nextElementSibling.innerText = val;
                                minusProduct(id);
                            }

                            el.parentNode.nextElementSibling.querySelector(
                                '.item-price'
                            ).innerText = parseFloat(price * val).toFixed(2);
                            changeTotal();

                        }
                    },
                    false
                );

                // =================Очистка всего хранилища================
                document.querySelector('.clear-cart').addEventListener('click', () => {
                    localStorage.removeItem('basket');
                    initStorage();
                    document.querySelector('.cart-items').innerHTML = '';
                    updateTotal();
                });


                // ----------------------view-detail------------------------------
                const viewDetails = document.querySelectorAll('.view-detail');
                viewDetails.forEach(function (element) {
                    element.addEventListener('click', function () {
                        let dataId = this.closest('.col-md-4').getAttribute('productId');
                        carousel(data[dataId]);
                    });
                });
            });
        })
        .catch(function (err) {
            console.log('Fetch Error :-S', err);
        });
})();
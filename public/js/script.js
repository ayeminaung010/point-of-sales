const addToCart = document.querySelectorAll('#addToCart');

let amount = document.querySelector('#cartAmount').innerHTML * 1;

const cartAmount = document.querySelector('#cartAmount');

document.addEventListener('click', e =>{
    if (e.target.matches('#addToCart')){
        const currentProduct = e.target.closest('#currentProduct');
        const currentImg = currentProduct.querySelector('#currentImg');

        const productId = currentProduct.querySelector('#productId').value;

        const newImg = new Image();
        newImg.src = currentImg.src;
        newImg.style.height = 50 + 'px';
        newImg.style.opacity = '0.8';
        newImg.style.position = 'fixed';
        newImg.style.transition = 0.5 + 's';
        newImg.style.top = currentProduct.getBoundingClientRect().top + 50 + 'px';
        newImg.style.left = currentProduct.getBoundingClientRect().left  + 50+ 'px';
        document.body.append(newImg);

        const cart = document.querySelector('#cart');
        setTimeout(() => {
            newImg.style.transform = 'rotate(360deg)';
            newImg.style.top = cart.getBoundingClientRect().top + 'px';
            newImg.style.left = cart.getBoundingClientRect().left + 'px';
            newImg.style.height = 30 + 'px';
            newImg.style.zIndex = 3000;
        },100)

        setTimeout(()=> {
            newImg.remove();
            cart.classList.add('animate__jello');
            cart.addEventListener('animationend',function(){
                cart.classList.remove('animate__jello');
            })
            amount++;
            cartAmount.innerHTML = amount;

            const data = {
                'productId' : productId,
                'qty' : 1,
            }
            axios.get('addToCart',  {
                params: data
                })
                .then(function (response) {
                console.log(response);

                })
                .catch(function (error) {
                console.log(error);
                });
        },500)
    }
})




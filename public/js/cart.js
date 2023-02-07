const btnRemoves = document.querySelectorAll('#btnRemove')
const btnMinus = document.querySelectorAll('.btn-minus')
const btnPlus = document.querySelectorAll('.btn-plus')

const subTotal = document.querySelector('#subTotal')
const finalPrice = document.querySelector('#finalPrice')
const clearBtn = document.querySelector('#clearBtn')
const checkOut = document.querySelector('#checkOut')
const finalPriceInput = document.querySelector('#finalPriceInput')

//Final price //total price
const updateTotalPrice = () =>{
    const totalPrices = document.querySelectorAll('#total');
    const total =  [...totalPrices].reduce((preValue,currentV) =>{
    return preValue + parseFloat(currentV.innerText.replace('kyats',''))
    },0)

    subTotal.innerHTML = total +' ' + 'kyats';
    finalPrice.innerText = (total + 5000) + 'kyats';
    finalPriceInput.value = total;
}
updateTotalPrice();

//btn removes
btnRemoves.forEach((btnRemove) =>{
    btnRemove.addEventListener('click',function(e){
        const currentProduct = e.target.closest('#currentProduct');
        const cartId = currentProduct.querySelector('.cartId');
        currentProduct.remove();
        updateTotalPrice();
        const data = {
            'cartId' : cartId.value
        }

        axios.get('/user/removeFromCart',  {
            params: data
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    })

})

//minus btn
btnMinus.forEach((btnM) =>{
    btnM.addEventListener('click',function(e){
        const currentProduct = e.target.closest('#currentProduct');
        const productPrice = currentProduct.querySelector('#productPrice');
        const qty = currentProduct.querySelector('#qty');
        const totalPrice = currentProduct.querySelector('#total');
        const cartId = currentProduct.querySelector('.cartId');

        const total =  productPrice.innerText.replace('kyats','') * qty.value;
        totalPrice.innerHTML = total + ' ' +'kyats';
        updateTotalPrice();
        const count  = {
            'qty' : qty.value,
            'cartId' : cartId.value
        }
        axiosCount(count);

    })
})


//plus btn
btnPlus.forEach((btnP) =>{
    btnP.addEventListener('click',function(e){
        const currentProduct = e.target.closest('#currentProduct');
        const productPrice = currentProduct.querySelector('#productPrice');
        const qty = currentProduct.querySelector('#qty');
        const totalPrice = currentProduct.querySelector('#total');
        const cartId = currentProduct.querySelector('.cartId');

        const total =  productPrice.innerText.replace('kyats','') * qty.value;
        totalPrice.innerHTML = total + ' ' +'kyats';
        updateTotalPrice();
        const count  = {
            'qty' : qty.value,
            'cartId' : cartId.value
        }
        console.log(count);
        axiosCount(count);
    })
})

//axios count update
const axiosCount = (data) => {
    axios.get('/user/countUpdate',  {
        params: data
    })
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
}

//clear btn
clearBtn.addEventListener('click',function(){
    const dataTable = document.querySelector('#dataTable');
    dataTable.remove();
    updateTotalPrice();
    window.location.reload();
    axios.get('/user/clearCart')
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
})


const productIds = document.querySelectorAll('.productId');
const qtys = document.querySelectorAll('#qty');

//checkOut
const dataTableRows = document.querySelectorAll('#dataTable tbody tr');
checkOut.addEventListener('click',function(){
    const random = Math.floor(Math.random() * 10000000000);
    const orderList = [];
    const final_price = parseInt(finalPrice.innerHTML.replace('kyats', ''));
    const orderCode = 'POS'+'_' + random;
    dataTableRows.forEach(function(row) {
      const userId = row.querySelector('.userId').value;
      const productId = row.querySelector('.productId').value;
      const qty = row.querySelector('#qty').value;
      const total = parseInt(row.querySelector('#total').innerHTML.replace('kyats', ''));

      orderList.push({
        'user_id': userId,
        'product_id': productId,
        'qty': qty,
        'total': total,
        'order_code': orderCode,
      });
    });
    localStorage.setItem('order_list', JSON.stringify(orderList));
    localStorage.setItem('final_price', final_price);
    localStorage.setItem('order_code', orderCode);

    axios.get('/user/payment',  {
        params: Object.assign({},orderList)
    })
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });

    window.location.href = '/user/payment';
})

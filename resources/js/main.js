var prods;
function AddProducts()
{
    let name = document.querySelector('#name').value
    let price  = document.querySelector('#price').value
    document.querySelector('#name').value=''
    document.querySelector('#price').value=''
    let xhr = new XMLHttpRequest();
    let url = 'http://127.0.0.1:8000/products-add'
    xhr.open("POST",url,true)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xhr.onload = function() {
        let response = xhr.responseText;
        let product = {'name':name,'price':price};
        prods.push(product)
        console.log(product)
        AddTrToProducts(product, prods.length-1)
        console.log(response)    
    }
    let product ='name='+ encodeURIComponent(name) + '&price='+encodeURIComponent(price);
    xhr.send(product);
        
}

window.onload = function()
{
    let xhr = new XMLHttpRequest();
    let url = 'http://127.0.0.1:8000/products-search'+'';
    xhr.open("GET",url,true)
    xhr.onload = function() {
        let response = JSON.parse(xhr.responseText);
        prods = response;
        for(let i=0;i<response.length;i++)
        {
            AddTrToProducts(response[i],i)
        }
    }
    xhr.send();
}

function AddTrToProducts(prod, id)
{
    let tbody = document.querySelector('#prods');
    let tr = document.createElement('tr')
    let tdName = document.createElement('td')
    let tdPrice = document.createElement('td')
    let tdDel = document.createElement('td')
    let delButton = document.createElement('button')
    delButton.innerHTML='Delete'
    delButton.addEventListener('click',DeleteProduct);
    delButton.classList.add('btn', 'btn-danger');
    delButton.id=id;
    tdDel.append(delButton);
    tdName.innerHTML=prod.name
            tdPrice.innerHTML=prod.price
            tr.append(tdName,tdPrice,tdDel)
            tbody.append(tr)
}
function AddTrToProductsSearch(prod)
{
    let tbody = document.querySelector('#prods');
    let tr = document.createElement('tr')
    let tdName = document.createElement('td')
    let tdPrice = document.createElement('td')
    let tdDel = document.createElement('td')
    let delButton = document.createElement('button')
    delButton.innerHTML='Delete'
    delButton.addEventListener('click',DeleteProduct);
    delButton.classList.add('btn', 'btn-danger');
    id = prods.findIndex(p=>p.name==prod.name && p.price==p.price);
    delButton.id=id;
    tdDel.append(delButton);
    tdName.innerHTML=prod.name
            tdPrice.innerHTML=prod.price
            tr.append(tdName,tdPrice,tdDel)
            tbody.append(tr)
}

function DeleteProduct()
{
    let tr = event.target.parentElement.parentElement;
    let id =event.target.id;
    delete prods[id];
    let xhr = new XMLHttpRequest();
    let url = 'http://127.0.0.1:8000/products-del'
    xhr.open("POST",url,true)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xhr.onload = function() {
        let response = xhr.responseText;
        tr.remove();
        console.log(response)    
    }
    let delid ='delid='+ encodeURIComponent(id);
    xhr.send(delid);

}
@extends('layouts.main')
@section('title','Products')
@section('content')
    <script>
        let prods = [];
        function AddProducts()
        {
            let name = document.querySelector('#name').value
            let price  = document.querySelector('#price').value
            document.querySelector('#name').value=''
            document.querySelector('#price').value=''
            let xhr = new XMLHttpRequest();
            let url = '{{(route("addprod"))}}?name='+name+'&price='+price
            xhr.open("GET",url,true)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            xhr.onload = function() {
                let response = xhr.responseText;
                let product = {'name':name,'price':price};
                if(prods[0]==undefined)
                {
                    prods=[];
                }
                prods.push(product)
                console.log(product)
                AddTrToProducts(product, prods.length-1)
                console.log(response)    
            }
            xhr.send();
                
        }

        window.onload = function()
        {
            let xhr = new XMLHttpRequest();
            let url = '{{route("products-search")}}'+'';
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
            let url = '{{route("delprod")}}?delid='+id
            xhr.open("GET",url,true)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            xhr.onload = function() {
                let response = xhr.responseText;
                tr.remove();
                console.log(response)    
            }
            let delid ='delid='+ encodeURIComponent(id);
            xhr.send(delid);

        }
        function SearchProduct()
        {
            console.log('startSearch')
            let search = document.querySelector('#search').value
            console.log(search)
            let xhr = new XMLHttpRequest();
            let url = '{{route("products-search")}}'+search;
            xhr.open("GET",url,true)
            xhr.onload = function() {
                let response = JSON.parse(xhr.responseText);
                console.log(response)
                let tbody = document.querySelector('#prods');
                $('#prods').empty()
                for(let prod of response)
                {
                    AddTrToProductsSearch(prod)
                }
                console.log('endSearch')
            }
            xhr.send();
        }
    </script>
    <div class="center-block col-sm-5 p-3 my-1 bg-dark text-white">
        <form action="" onsubmit="event.preventDefault(); AddProducts()">
            <label for="">Name:</label>
            <br>
            <input type="text" id='name' require>
            <br>
            <label for="">Price:</label>
            <br>
            <input type="number" min='0' step='0.1' id='price' require>
            <br>
            <br>
            <input type="submit" value='Add'>
        </form>
    </div>
    <div class="center-block col-sm-5 p-5 my-1 bg-dark text-white">
        <br>
        <label for="">Price:</label>
        <br>
        <input type="text" id='search' onkeyup="SearchProduct()">
        <br>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id='prods'>

            </tbody>
        </table>
    </div>
@endsection
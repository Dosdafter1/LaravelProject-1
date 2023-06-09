<?php
use App\Models\Category;
use App\Models\Product;
/** @var Category[] $categories
 *  @var Product[] $products
 */
 ?>
@extends('layouts.main')
@section('title','Products')
@section('content')

    <script>
        let prods = [];
        function AddTrToProductsSearch(prod)
        {
            let tbody = document.querySelector('#prods');
            let tr = document.createElement('tr')
            let tdId = document.createElement('td')
            let tdName = document.createElement('td')
            let tdPrice = document.createElement('td')
            let tdQuant = document.createElement('td')
            let tdCategory = document.createElement('td')
            let tdImage = document.createElement('td')
            let tdOther = document.createElement('td')
            
            let delButton = document.createElement('button')
            let i = document.createElement('i')
            i.classList.add('fa','fa-trash');
            delButton.append(i)
            delButton.addEventListener('click',DeleteProduct);
            delButton.classList.add('btn', 'btn-sm', 'btn-outline-danger');
            delButton.id=prod.id;
            
            let aEdit = document.createElement('a')
            aEdit.href= "http://127.0.0.1:8000/products/edit/"+prod.id+"%7D";
            let ia = document.createElement('i')
            ia.classList.add('fa','fa-pencil');
            aEdit.append(ia)
            aEdit.classList.add('btn', 'btn-sm', 'btn-outline-info');
            
            let aShow = document.createElement('a')
            aShow.href= "http://127.0.0.1:8000/products/show/"+prod.id+"%7D";
            let is = document.createElement('i')
            is.classList.add('fa','fa-eye');
            aShow.append(is)
            aShow.classList.add('btn', 'btn-sm', 'btn-outline-secondary');

            tdOther.append(aEdit,delButton,aShow);

            
            if(prod.image!=null)
            {
                let image = document.createElement('img')
                image.src='http://127.0.0.1:8000/storage//products/'+prod.image
                image.style.width='100px';
                tdImage.append(image)
            }
            
            
            tdId.innerHTML = prod.id;
            tdName.innerHTML=prod.title
            tdPrice.innerHTML=prod.price
            tdQuant.innerHTML = prod.quantity
            
            @foreach ($categories as $c)
                if(prod.category_id=={{$c->id}})
                    {
                        tdCategory.innerHTML = '{{$c->title}}'
                    }
            @endforeach
            tr.append(tdId,tdName,tdPrice,tdQuant,tdCategory,tdImage,tdOther)
            tbody.append(tr)
        }

        function DeleteProduct()
        {
            let tr = event.target.parentElement.parentElement.parentElement;
            let id =event.target.parentElement.id;
            if(id=='')
            {
                id =event.target.id;
            }
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
            xhr.send();
        }
        function SearchProduct()
        {
            let search = document.querySelector('#search').value
            let xhr = new XMLHttpRequest();
            let url = '{{route("products-search")}}/'+search;
            xhr.open("GET",url,true)
            xhr.onload = function() {
                let response = JSON.parse(xhr.responseText);
                let tbody = document.querySelector('#prods');
                $('#prods').empty()
                for(let prod of response)
                {
                    AddTrToProductsSearch(prod)
                }
            }
            xhr.send();
        }
    </script>

    <div class='container bg-dark text-white w-50' style='margin-left: 25vw; min-width: 500px; margin-top:-7vh;'>
        @if(Auth::check())
        <div style="padding-top: 15px; padding-left: 2vw;">
            <form action="{{route('addprod')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class='row mt-5'>
                    <div class='col-md-4'>
                        <div class='mb-3'>
                            <label class='form-label'>Title:
                                <input type="text" name='title' class='form-control' require>
                            </label>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Price:
                                <input type="number" min='0' step='0.1' name='price' class='form-control' require>
                            </label>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Quantity:
                                <input type="number" min='0' step='1' name='quantity' class='form-control' require>
                            </label>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Category:
                                <select name="category_id" id="categoryid" class='form-control'>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Select image
                                <input type="file" name='image' id='image' class='form-control' accept="image/*">
                            </label>
                        </div>
                        <input class='btn btn-outline-success' type="submit" value='Add'>
                    </div>
                </div>
            </form>
        </div>
        @endif
        <div style="padding-top: 15px; padding-left: 2vw;">
            <br>
            <label form-label>Title:
                <input class='form-control' type="text" id='search' onkeyup="SearchProduct()">
            </label>
            <br>
            <br>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Other</th>
                    </tr>
                </thead>
                <tbody id='prods'>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{Category::find($product->category_id)->title}}</td>
                            <td>
                                @if(!empty($product->getImageUrl()))
                                <img style="width: 100px" src="{{$product->getImageUrl()}}" 
                                        title="{{$product->title}}">
                                @endif
                            </td>
                            <td>
                                @if(Auth::check())
                                <a class='btn btn-sm btn-outline-info' href="{{route('products-edit',[$product])}}"><i class='fa fa-pencil'></i></a>
                                    <button class='btn btn-sm btn-outline-danger' id='{{$product->id}}' onclick='DeleteProduct()'>
                                        <i class='fa fa-trash'></i>
                                    </button>
                                @endif
                                <a class='btn btn-sm btn-outline-secondary' href="{{route('products-show',[$product])}}"><i class='fa fa-eye'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
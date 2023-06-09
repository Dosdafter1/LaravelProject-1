<?php 
    namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
    use App\Models\Category;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

        class ProductsController extends Controller {
            public function index()
            {
                $categoris = Category::query()->get();
                $products = Product::query()->get();
                return view('pages.products.products',[
                    'categories'=>$categoris,
                    'products'=>$products    
                ]);
            }
            public function search($search='')
            {
                $products = Product::query()->where('title','LIKE',"%$search%")->get();
                return response()->json($products);
            }
            public function add(ProductRequest $request): RedirectResponse
            {   
                $product = new Product($request->validated());
                if($request->hasFile('image'))
                {
                    $request->setImage($product, $request->file('image'));
                }
                $product->save();
                return redirect(route('products'));
            }
            public function delete(Request $request, Product $product=null) 
            {
                if($product===null)
                {
                    $delid=intval($request->input('delid'));
                    $res = Product::find($delid);
                    $res->delete();
                    return response("product deleted");
                }
                else {
                    $product->delete();
                    return redirect(route('products'));
                }
            }
            public function edit(Product $product)
            {
                $categoris = Category::query()->get();
                return view('pages.products.edit',[
                    'categories'=>$categoris,
                    'product'=>$product]);
            }
            public function update(ProductRequest $request, Product $product)
            {
                $product->fill($request->validated());
                if($request->hasFile('image'))
                {
                    $request->setImage($product, $request->file('image'));
                }
                $product->save();
                return redirect(route('products'));
            }
            public function show(Product $product)
            {
                return view('pages.products.show',[
                    'product'=>$product
                ]);
            }
        }
?>


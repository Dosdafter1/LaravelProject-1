<?php 
    namespace App\Http\Controllers;
    use App\Models\Product;
    use Illuminate\Http\Request;
    
        class ProductsController extends Controller {
            private $products;
            public function __construct()
            {
                $this->products = Product::GetAllProductsFromFiles();
            }
            public function index()
            {
                return view('pages.products');
            }
            public function search($search='')
            {
                return response()->json(Product::GetProductsFromFilesByName($search));
            }
            public function addProd(Request $request)
            {
                    $name = $request->input('name');
                    $price = $request->input('price');
                    if($this->products===null)
                    {
                        $this->products=[];
                    }
                    $product = new Product;
                    $product->name=$name;
                    $product->price=$price;
                    $this->products[]=$product;
                    Product::SaveProductToFile($this->products);
                    return response();
            }
            public function delProd(Request $request) 
            {
                $delid=intval($request->input('delid'));
                $prods = Product::GetAllProductsFromFiles();
                unset($prods[$delid]);
                $newprods=[];
                foreach($prods as $p)
                {
                    $newprods[]=$p;
                }
                Product::SaveProductToFile($newprods);
                return response("product deleted");
            }
        }
?>


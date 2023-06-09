<?php 
namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

    class CategoryController extends Controller {

        public function __construct()
        {
            $this->middleware('auth');
        }

        public function index(Request $request): View
        {
            $search = $request->get('search','');
            $categories = Category::query()->where('title','LIKE',"%$search%")->get();
            return view('pages.category.index',[
                'search'=>$search,
                'categories'=>$categories,
            ]);
        }
        public function create():View
        {
            return view('pages.category.create');
        }
        public function store(CategoryRequest $request):RedirectResponse
        {
            $category = new Category($request->validated());
            $request->file('image');
            if($request->hasFile('image'))
            {
                $request->setImage($category, $request->file('image'));
            }
            $category->save();
            return redirect(route('category'));
        }
        public function edit(Category $category){
            return view('pages.category.edit',['category'=>$category]);
        }
        public function update(CategoryRequest $request,Category $category): RedirectResponse{
            $category->fill($request->validated());
            if($request->hasFile('image'))
            {
                $request->setImage($category, $request->file('image'));
            }
            $category->save();
            return redirect(route('category'));
        }
        public function delete(Category $category):RedirectResponse
        {
            $category->delete(); 
            return redirect(route('category'));
        }
        public function show(Category $category)
        {
            return view('pages.category.show',['category'=>$category]);
        }
    }
?>
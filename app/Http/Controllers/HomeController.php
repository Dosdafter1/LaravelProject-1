<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

    class HomeController extends Controller {
        public function index()
        {
            return view('pages.home',['name'=>'Olexandr']);
        }
        public function countries(Request $request)
        {
            return view('pages.countries');
        }
        public function products(Request $request)
        {
            return view('pages.products');
        }
        public function map()
        {
            return view('pages.map');
        }
    }
 ?>
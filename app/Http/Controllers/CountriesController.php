<?php 
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

    class CountriesController extends Controller {
        public function index()
        {
            return view('pages.countries');
        }
        public function search($search='')
        {
            $rescountries=[];
            $countries = array(
                "Ukraine",
                "United States",
                "Canada",
                "United Kingdom",
                "Germany",
                "France",
                "Italy",
                "Spain",
                "Australia",
                "Japan",
                "China",
                "India",
                "Brazil",
                "Russia",
                "Mexico",
                "South Korea",
                "Netherlands",
                "Switzerland",
                "Sweden",
                "Norway",
                "Denmark",
                "Finland",
                "Belgium",
                "Austria",
                "Greece",
                "Portugal",
                "Ireland",
                "New Zealand",
                "Singapore",
                "Thailand",
                "South Africa"
            );
                $rescountries = array_filter($countries,
                                function($name) use($search){
                                    return str_contains(strtolower($name),strtolower($search));
                });
                $res =[];
                foreach($rescountries as $c)
                {
                    $res[]=$c;
                } 
                return response()->json($res);
        }
    }
?>
<?php 
namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Donate;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

    class DonateController extends Controller {
        public function index()
        {
            return view('pages.pay.donates.index',['donates'=>Donate::get()]);
        }
        public function donate(Donate $donate)
        {
            return view('pages.pay.donates.donate',['donate'=>$donate]);
        }
    }
?>
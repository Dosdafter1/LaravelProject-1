<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Donate;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

    class DonateController extends Controller {
        public function __construct()
        {
            $this->middleware('auth');
        }
        public function create()
        {
            return view('admin.donates.create');
        }
        public function store(Request $request): RedirectResponse
        {
            $donate = new Donate($request->validate(['title'=>'required|max:100',
                                                    'descriptions'=>'required|max:200',
                                                    'required_amount'=>' ']));
            $donate->save();
            return redirect()->route('donate');
        }
        public function edit(Donate $donate)
        {
            return view('admin.donates.edit',['donate'=>$donate]);
        }
        public function update(Donate $donate, Request $request)
        {
            $donate->fill($request->validate(['title'=>'required|max:100',
            'descriptions'=>' ',
            'required_amount'=>' ']));
            $donate->save();
            return redirect()->route('donate');
        }
        public function show(Donate $donate)
        {
            return view('admin.donates.show',['donate'=>$donate]);
        }
        public function destroy(Donate $donate): RedirectResponse
        {
            $donate->delete();
            return redirect()->route('donate');
        }
    }
?>
<?php

namespace Modules\Map\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Map\Entities\Marker;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('map::admin.map.index',['models'=>Marker::get()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('map::admin.map.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request): RedirectResponse
    {
        $marker = new Marker($request->validate(['popup_text'=>'nullable',
                                                    'lat'=>'',
                                                    'long'=>'']));
        $marker->save();
        return redirect()->route('map.index');
    }

    public function show(Marker $marker)
    {
        return view('map::admin.map.show',['marker'=>$marker]);
    }

    public function edit(Marker $marker)
    {
        return view('map::admin.map.edit',['marker'=>$marker]);
    }

    public function update(Request $request, Marker $marker): RedirectResponse
    {
        $marker->fill($request->validate(['popup_text'=>'nullable',
                                            'lat'=>'',
                                            'long'=>'']));
        $marker->save();
        return redirect()->route('admin.map.index');
    }

    public function destroy(Marker $marker): RedirectResponse
    {
        $marker->delete();
        return redirect()->route('admin.map.index');

    }
}

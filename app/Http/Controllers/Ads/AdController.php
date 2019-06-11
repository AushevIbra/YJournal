<?php

namespace App\Http\Controllers\Ads;

use App\Http\Requests\StoreAds;
use App\Models\Ads\Ad;
use App\Models\Ads\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller {

    public function ads(){
        $ads = Ad::filter();
        return view('ads.ads', compact('ads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return redirect()->route('board');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = Category::where('parent_id', 0)->with('children')->get();

        return view('ads.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAds $request){
        $ad = Ad::create([
            'name'        => $request->post('name'),
            'number'      => $request->post('number'),
            'category_id' => $request->post('category_id'),
            'user_id'     => !auth()->guest()? auth()->user()->id: null,
            'address'     => $request->post('address'),
            'content'     => $request->post('content'),
            'isFree'      => $request->post('isFree')? true: false,
            'imgs'        => $request->post('imgs')? json_encode($request->post('imgs')): null,
            'price'       => $request->post('price'),
            'title'       =>$request->post('title'),
        ]);

        return redirect()->route('ads.show', $ad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $ad = Ad::findOrFail($id);
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}

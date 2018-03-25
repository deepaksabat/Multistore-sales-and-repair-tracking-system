<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shop()
    {
        $pageTitle = 'Available Shop List';
        $shops = Shop::active()->get();
        return view('front.shop_list', compact('pageTitle', 'shops'));
    }

    public function shopSingle($slug)
    {
        $shop = Shop::where('slug', $slug)->first();
        $title = $shop->name;


        //if User LoggedIn, check if this user previously joined with this merchant
        $is_joined = null;
        if(Auth::check())
        {
            $user = Auth::user();
            $is_joined = $user->joinedShops()->wherePivot('user_id', $user->id)->wherePivot('shop_id', $shop->id)->first();
        }

        return view('front.shop_single', compact('shop', 'title', 'is_joined'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class StaticPagesController extends Controller
{
    public function home()
    {
        $feed_item=[];
        if(Auth::check())
        {
            $feed_item=Auth::user()->feed()->paginate(30);
        }
        return view('static_page/home',compact('feed_item'));
    }
    public function help()
    {
        return view('static_page/help');
    }
    public function about()
    {
        return view('static_page/about');
    }
    public function test()
    {
        return view('static_page.test');
    }
}

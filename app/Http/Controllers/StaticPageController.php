<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    /**
     * 利用規約ページを表示
     */
    public function terms()
    {
        return view('static.terms');
    }

    /**
     * プライバシーポリシーページを表示
     */
    public function privacy()
    {
        return view('static.privacy');
    }
}

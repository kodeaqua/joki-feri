<?php

namespace App\Http\Controllers;

use App\Models\BreakRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page_title = "Dasbor";
        $page_description = "Informasi mengenai akun anda.";
        $latest = BreakRequest::where('user_id', Auth::user()->id)->latest()->first();
        $breakrequestrecord = BreakRequest::where('user_id', Auth::user()->id)->paginate(5);
        return view('menu.home', compact('page_title', 'page_description', 'latest', 'breakrequestrecord'));
    }
}

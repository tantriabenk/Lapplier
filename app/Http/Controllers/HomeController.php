<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProductHelp;

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
        // print_r(ProductHelp::get_chart_product_stock());
        // exit;
        return view('home');
    }
}

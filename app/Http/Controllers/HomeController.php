<?php

namespace App\Http\Controllers;

use App\Halls;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $halls = Halls::all();

        return view('main', compact('halls'));

    }
    public function aboutAction()
    {
        return view('about');
    }
}

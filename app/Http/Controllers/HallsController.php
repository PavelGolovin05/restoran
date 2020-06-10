<?php

namespace App\Http\Controllers;

use App\Halls;
use Illuminate\Http\Request;

class HallsController extends Controller
{
    public function indexAction()
    {
        $halls = Halls::all();
        return view('halls.index',compact('halls'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Dishes;
use App\DishesEvent;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function indexAction()
    {
        $categories = Categories::all();
        $text = '';
        $counts = '';
        foreach ($categories as $category){
            $text .= '"'.$category->name .'",';
            $value = DishesEvent::join('dishes','dishes_event.dish_id','dishes.id')
                ->where('dishes.category_id',$category->id)->sum('dishes_event.count');
            $counts .= $value .',';
        }

        return view('statistic',compact('text','counts'));
    }

    public function paramAction(Request $request)
    {
        $date1 = $request->get('date1');
        $date2 = $request->get('date2');
        $date1 = str_replace('T', ' ', $date1);
        $date2 = str_replace('T', ' ', $date2);
        $categories = Categories::all();
        $text = '';
        $counts = '';
        //$categories->map(function ($item) use (&$text, &$counts){
        foreach ($categories as $category){
            $text .= '"'.$category->name .'",';
            $value = DishesEvent::join('dishes','dishes_event.dish_id','dishes.id')
                ->where('dishes.category_id',$category->id)->sum('dishes_event.count');

            $counts .= $value .',';
        }
        return view('statistic',compact('text','counts'));;
    }
}

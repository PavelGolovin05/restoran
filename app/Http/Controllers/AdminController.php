<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Dishes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function indexAction()
    {
        return view('admin.index');
    }
    public function categoryAction()
    {
        return view('admin.addCategory');
    }
    public function dishesAction()
    {
        return view('admin.dishes');
    }
    public function addDishFormAction()
    {
        $categories = Categories::all();
        return view('admin.addDish',compact('categories'));
    }
    public function addDishAction(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $price = $request->get('price');
        $weight = $request->get('weight');
        $measure = $request->get('measure');
        $photo_link = $request->get('photo_link');
        $category = $request->get('category');

        $dish = new Dishes([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'weight' => $weight,
            'measure' => $measure,
            'photo_link' => $photo_link,
            'category' => $category,
        ]);
        $dish->save();
        return redirect()->back()->with(['Блюдо добавлено', 'The Message']);
    }
    public function removeDishFormAction()
    {
        $dishes = Dishes::where('dishes.is_stop_list','=',0)->get();
        return view('admin.removeDishForm',compact('dishes'));
    }
    public function removeDishAction(Request $request)
    {
        $id = $request->get('id');
        $query = 'update dishes set is_stop_list = 1 where id ='.$id;
        $dish = DB::update($query);
        return redirect()->back()->with(['Блюдо добавлено в стоп-лист', 'The Message']);
    }
    public function removeDishFromStopFormAction()
    {
        $dishes = Dishes::where('dishes.is_stop_list','=',1)->get();
        return view('admin.removeDishFromStop',compact('dishes'));
    }
    public function removeDishFromStopAction(Request $request)
    {
        $id = $request->get('id');
        $query = 'update dishes set is_stop_list = 0 where id ='.$id;
        $dish = DB::update($query);
        return redirect()->back()->with(['Блюдо удалено из стоп-листа', 'The Message']);
    }
    public function addCategoryAction(Request $request)
    {
        $category = $request->get('category');

        $newCategory = new Categories([
            'name' => $category,
        ]);
        $newCategory->save();
        return redirect()->back()->with(['Категория добавлена', 'The Message']);
    }
}

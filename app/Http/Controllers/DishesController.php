<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Dishes;
use App\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DishesController extends Controller
{
    public function indexAction()
    {
        $dishes = Dishes::where('dishes.is_stop_list','=',0)->get();

        $categories = Categories::all();

        $ingredients = Ingredients::all();

        return view('dishes.index', compact('dishes', 'categories', 'ingredients'));
    }

    public function dishAction($id)
    {
        $dish = Dishes::find($id);

        $ingredients = Ingredients::join('dish_ingredients','dish_ingredients.ingredient_id','=','ingredients.id')
            ->join('dishes','dishes.id','=','dish_ingredients.dish_id')
            ->where('dishes.id',$id)
            ->select('ingredients.name')->get();
            return view('dishes.dish', compact('dish', 'ingredients'));

    }

    public  function findDishesAction(Request $request)
    {

        $category = $request->get('category');
        $ingredient = $request->get('ingredient');
        $name = $request->get('name');

        $dishes = Dishes::where('dishes.name',$name)->get();

        $ingredients = Ingredients::all();

        $categories = Categories::all();


        if($category == 0 && $ingredient == 0 && strlen($name) == 0){
            return redirect()->back()->with('message', 'Вы ничего не выбрали');
        }

        if($category > 0 && $ingredient == 0 && strlen($name) == 0){
            $categories = Categories::where('id',$category)->get();
            $dishes = Dishes::where('dishes.category_id',$category)->get();
        }

        if($category == 0 && $ingredient > 0 && strlen($name) == 0){
            $categories = Dishes::join('dish_ingredients','dish_ingredients.dish_id','=','dishes.id')
                ->join('ingredients','ingredients.id','=','dish_ingredients.ingredient_id')
                ->join('categories','categories.id','=','dishes.category_id')
                ->where('ingredients.id',$ingredient)
                ->select('dishes.category_id as id','categories.name')->get();

            $dishes = Dishes::join('dish_ingredients','dish_ingredients.dish_id','=','dishes.id')
                ->join('ingredients','ingredients.id','=','dish_ingredients.ingredient_id')
                ->where('ingredients.id',$ingredient)
                ->select('dishes.id','dishes.name','dishes.description','dishes.price','dishes.weight','dishes.measure','dishes.photo_link','dishes.category_id')->get();
        }

        if($category > 0 && $ingredient > 0 && strlen($name) == 0){
            $categories = Categories::where('id',$category)->get();
            $query = 'select dishes.id, dishes.name,dishes.price,dishes.weight,dishes.measure,dishes.photo_link,dishes.category_id from dishes join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dishes.category_id ='.$category.' AND dish_ingredients.ingredient_id ='.$ingredient;
            $dishes = DB::select($query);
        }

        if($category == 0 && $ingredient == 0 && strlen($name) > 0){
            $query = 'select categories.id, categories.name from categories join
            dishes on dishes.category_id = categories.id where dishes.name Like '."'%".$name."%' GROUP BY categories.id";
            $categories = DB::select($query);
            $query = 'select * from dishes where name Like '."'%".$name."%'";
            $dishes = DB::select($query);
        }

        if($category > 0 && $ingredient == 0 && strlen($name) > 0){
            $query = 'select categories.id, categories.name from categories join
            dishes on dishes.category_id = categories.id where categories.id = '.$category.' AND dishes.name Like '."'%".$name."%' GROUP BY categories.id";
            $categories = DB::select($query);
            $query = 'select * from dishes where category_id = '.$category.' AND dishes.name Like '."'%".$name."%' ";
            $dishes = DB::select($query);
        }

        if($category == 0 && $ingredient > 0 && strlen($name) > 0){
            $query ='select categories.id, categories.name from categories join
            dishes on categories.id = dishes.category_id join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dish_ingredients.ingredient_id = '.$ingredient.' AND dishes.name Like  '."'%".$name."%'";
            $categories = DB::select($query);
            $query = 'select dishes.id, dishes.name,dishes.description,dishes.price,dishes.weight,dishes.measure,dishes.photo_link,dishes.category_id from dishes join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dishes.name Like'."'%".$name."%'".' AND dish_ingredients.ingredient_id ='.$ingredient;
            $dishes = DB::select($query);

        }

        if($category > 0 && $ingredient > 0 && strlen($name) > 0){
            $query ='select categories.id, categories.name from categories join
            dishes on categories.id = dishes.category_id join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dish_ingredients.ingredient_id = '.$ingredient.' AND dishes.name Like  '."'%".$name."%'".' AND dishes.category_id ='.$category.' GROUP BY categories.id ';
            $categories = DB::select($query);
            $query = 'select dishes.id, dishes.name,dishes.description,dishes.price,dishes.weight,dishes.measure,dishes.photo_link,dishes.category_id from dishes join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dishes.name Like'."'%".$name."%'".' AND dish_ingredients.ingredient_id ='.$ingredient.' AND dishes.category_id ='.$category;
            $dishes = DB::select($query);
        }
        if ($dishes == null) {
            return redirect()->back()->with('message', 'Нету блюд по данным критерием');
        }
        return view('dishes.index',compact('dishes', 'ingredients','categories') );
    }
}

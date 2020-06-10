<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Dishes;
use App\DishesEvent;
use App\Events;
use App\EventTypes;
use App\Halls;
use App\Ingredients;
use App\Reservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function indexAction()
    {
        $halls = Halls::all();
        $types = EventTypes::all();
        return view('events.index', compact('halls','types'));
    }
    public function addEventAction(Request $request)
    {
        $user_id = Auth::user()->id;
        $hall_id = $request->get('hall_id');
        $date_time_event = $request->get('date');
        $type_event = $request->get('event_type');
        $count_peoples = $request->get('count');

        $date_time_event = str_replace('T', ' ',  $date_time_event);

        $dEvent = Carbon::create( $date_time_event);

        if($request->get('hall_id') < 1)
        {
            return redirect()->back()->with('message', 'Вы не выбрали зал!');
        }
        $hall = Halls::find($request->get('hall_id'));
        if ($dEvent->hour > 21 ) {
            return redirect()->back()->with('message', 'В это время ресторан уже закрыт!');
        }
        $curHour = Carbon::today()->hour;
        $curDay = Carbon::today()->day;
        if($dEvent->day < $curDay + 2 ) {
            return redirect()->back()->with('message', 'Необходимо бронировать мероприятие минимум за 2 дня!');
        }

        $event = new Events([
            'user_id' => $user_id,
            'hall_id' => $hall_id,
            'event_type_id' =>$type_event,
            'count_peoples' =>$count_peoples,
            'date_time_event' => $date_time_event,
        ]);

        $event->save();

        return redirect()->back()->with(['Вы успешно заказали мероприятие', 'The Message']);
    }
    public function myEventsAction()
    {
        $user_id = Auth::user()->id;
        $curDay = Carbon::today()->day;
        $query = 'select events.id as id,hall_types.name,halls.id as hall,events.date_time_event,events.count_peoples,event_types.name as type
        from events join event_types on events.event_type_id = event_types.id
        join halls on events.hall_id = halls.id join hall_types on halls.hall_type_id = hall_types.id
        where events.user_id = '.$user_id.' AND day(events.date_time_event) > '.$curDay;
        $events = DB::select($query);

        $query = 'select events.id, dishes.name,dishes_event.count from events join dishes_event on dishes_event.event_id = events.id join
        dishes on dishes.id = dishes_event.dish_id WHERE events.user_id = '.$user_id;
        $dishes = DB::select($query);

        return view('events.myEvents', compact('events','dishes'));
    }
    public function dishesAction(Request $request)
    {
        $eventId = $request->get('event');

        $dishes = Dishes::where('dishes.is_stop_list','=',0)->get();

        $categories = Categories::all();
        $ingredients = Ingredients::all();
        return view('events.dishes',compact('dishes','categories','eventId','ingredients'));
    }
    public function addDishesAction(Request $request)
    {
        $event = $request->get('event');
        $dish = $request->get('dish');
        $count = $request->get('count');

        $dishesEvents = new DishesEvent([
            'event_id' => $event,
            'dish_id' => $dish,
            'count' => $count,
        ]);
        $dishesEvents->save();
        return redirect()->back()->with(['Блюдо успешно добавлено к заказу', 'The Message']);
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
                ->select('dishes.id','dishes.name','dishes.price','dishes.weight','dishes.measure','dishes.photo_link','dishes.category_id')->get();
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
            $query = 'select dishes.id, dishes.name,dishes.price,dishes.weight,dishes.measure,dishes.photo_link,dishes.category_id from dishes join
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
            $query = 'select dishes.id, dishes.name,dishes.price,dishes.weight,dishes.measure,dishes.photo_link,dishes.category_id from dishes join
            dish_ingredients on dish_ingredients.dish_id = dishes.id
            where dishes.name Like'."'%".$name."%'".' AND dish_ingredients.ingredient_id ='.$ingredient.' AND dishes.category_id ='.$category;
            $dishes = DB::select($query);
        }
        if ($dishes == null) {
            return redirect()->back()->with('message', 'Нету блюд по данным критерием');
        }
        return view('events.dishes',compact('dishes', 'ingredients','categories') );
    }
}

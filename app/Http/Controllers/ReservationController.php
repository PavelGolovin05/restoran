<?php

namespace App\Http\Controllers;

use App\EventTypes;
use App\Halls;
use App\Reservations;
use App\Tables;
use Carbon\Carbon;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function indexAction()
    {
        $halls = Halls::all();

        return view('reservation.index', compact('halls'));
    }

    public function tablesAction(Request $request)
    {

        $date = $request->get('date');

        $date = str_replace('T', ' ', $date);

        $dReservation = Carbon::create($date);

        if($request->get('hall_id') < 1)
        {
            return redirect()->back()->with('message', 'Вы не выбрали зал!');
        }
        $hall = Halls::find($request->get('hall_id'));
        if ($dReservation->hour > 21 ) {
            return redirect()->back()->with('message', 'В это время ресторан уже закрыт!');
        }
        $curHour = Carbon::now()->hour;
        $curDay = Carbon::now()->day;
        if($dReservation->hour < $curHour && $dReservation->day == $curDay ) {
            return redirect()->back()->with('message', 'Это время уже прошло!');
        }
        $tables = Tables::where('hall_id',$request->get('hall_id'))->get();


       if ($dReservation->day < $curDay ) {
           return redirect()->back()->with('message', 'Невозможно забронировать на прошедшую дату');
       }

       if ($dReservation->day > $curDay + 1) {
           return redirect()->back()->with('message', 'Невозможно забронировать дальше чем на 1 день');
       }
        $query = 'select * from reservations where day(date_time_reservation) ='.$dReservation->day.
            ' AND hour(date_time_reservation) >='.($dReservation->hour -2).
            ' AND hour(date_time_reservation) <='.($dReservation->hour +2).' Order By date_time_reservation';
        $reservations = DB::select($query);

        $arr = [];

      foreach ($reservations as $reservation){
            $HourOfRezervation = Carbon::create($reservation->date_time_reservation)->hour;
            if (abs($HourOfRezervation - $dReservation->hour)<2) {
                $arr[] = $reservation->table_id;
            }
      }
      $tables = $tables->filter(function ($item) use ($arr){
          return !in_array($item->id, $arr);
      });
        return view('reservation.hall', compact('hall','date', 'tables'));
    }

    public function addReservationAction(Request $request)
    {
            $user_id = Auth::user()->id;
            $table_id = $request->get('table_id');
            $date_time_reservation = $request->get('date');
        $reservation = new Reservations([
            'user_id' => $user_id,
            'table_id' => $table_id,
            'date_time_reservation' => $date_time_reservation
        ]);

        $reservation->save();

        return redirect()->back()->with(['Вы успешно забронировали столик', 'The Message']);
    }
    public function myReservationsAction()
    {
        $user_id = Auth::user()->id;
        $reservations = Reservations::join('tables','reservations.table_id','tables.id')
            ->join('hall_types','tables.hall_id','hall_types.id')
        ->select('hall_types.name','tables.table_num','tables.hall_id','reservations.date_time_reservation')
            ->where('reservations.user_id','=',$user_id)->get();

        return view('reservation.myReservations', compact('reservations'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Booked;
use Illuminate\Http\Request;

class BookedController extends Controller
{
    public function extendBooking(Request $req){
        $booking_id = $req -> input("booking_id");
        $booking = Booked::where('booking_id',$booking_id)->first();
        $booking -> extendBooking();
        return redirect()->action(
            'BookController@bookedBooks'
        );
    }

    public function closeBooking(Request $req){
        $booking_id = $req -> input("booking_id");
        $booking = Booked::where('booking_id',$booking_id)->first();
        $booking -> closeBooking();
        return redirect()->action(
            'BookController@bookedBooks'
        );
    }


}

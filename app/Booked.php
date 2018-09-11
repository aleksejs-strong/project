<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    protected $table = 'booked';
    protected $primaryKey = 'booking_id';

    public function allBooked(){
        $booking = DB::table('booked')
            ->join('books', 'books.book_id', '=', 'booked.book_id')
            ->select('username','booked.booking_id','books.book_id','booked.booked_at','booked.until_at', 'books.author', 'books.publishing_year' , 'books.name') -> get();
        return $booking;
    }
    public function closeBooking(){
        DB::table('books')
            ->where('book_id',$this -> book_id)
            -> increment('quantity');
        $this ->delete();

    }
    public function extendBooking(){
        DB::table('booked')
            ->where('booking_id', $this -> booking_id )
            ->update (['until_at' => date('Y-m-d', strtotime($this -> until_at. ' +1 week'))]);

    }
    public function getBooked($username)
    {
        $bookings = DB::table('booked')
            -> join('books', 'books.book_id', '=', 'booked.book_id')
            -> select('username','booked.booking_id', 'books.author', 'books.publishing_year' , 'books.name')
            -> where('username',$username)
            -> get();
        return $bookings;
    }
}

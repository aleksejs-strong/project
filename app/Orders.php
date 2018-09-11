<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Orders extends Model
{
    protected $primaryKey = 'order_id';

    public function acceptBooking(){
        $orderInfo = DB::table('orders')
            ->join('books', 'books.book_id', '=', 'orders.book_id')
            ->select('books.book_id','username','orders.order_id', 'books.author', 'books.publishing_year' , 'books.name')
            ->where('orders.order_id',$this->order_id)
            ->first();



        DB::table('booked')->insert([
            [
                'username' => $orderInfo->username,
                'book_id' => $orderInfo -> book_id,
                'booked_at' => date("Y-m-d"),
                'until_at' => date('Y-m-d', strtotime(date("Y-m-d"). ' +2 week'))
            ]

        ]);

        $this -> delete();

    }
    public function rejectBooking(){
        Book::where('book_id',$this->book_id) -> increment('quantity');
        $this -> delete();
    }
}

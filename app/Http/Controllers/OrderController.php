<?php

namespace App\Http\Controllers;

use App\Booked;
use App\Orders;
use Illuminate\Http\Request;
use App\Book;
use App\User;
use DB;
use Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $req){
        $book_id = $req -> input("order_book_id");

        $user_name = $req -> input("order_user");

        $book = Book::where('book_id',$book_id)->first();
        $user = Auth::user();




        if($book -> quantity > 0){

            DB::table('orders')->insert([
                ['username' => $user -> username, 'book_id' => $book -> book_id]

            ]);

            Book::where('book_id',$book_id) -> decrement('quantity');

            return view('studentView',['books' => Book::all(),'user' => $user['username'], 'added' => true]);
        }

        return view('studentView',['books' => Book::all(),'user' => $user['username'], 'added' => false]);
    }
    public function booklist(){
        $user = Auth::user();
        return view('studentView',['books' => Book::all(),'user' => $user['username']]);
    }

    public function listOrders(){
        $user = Auth::user();
        $booked = new Booked();


        return view('orders', ['orders' => $user -> getOrders(),'booked' => $booked->getBooked($user->username)]);
    }

    public function showOrders(){
        $orders = DB::table('orders')
            ->join('books', 'books.book_id', '=', 'orders.book_id')
            ->select('username','orders.order_id', 'books.author', 'books.publishing_year' , 'books.name') -> get();
        return view ('processOrders',['orders' => $orders]);
    }

    public function acceptOrder(Request $req){
        $user = Auth::user();
        $order_id = $req -> input("order_id");
        $order = Orders::where('order_id',$order_id)->first();
        $order -> acceptBooking();
//
//        $orders = DB::table('orders')
//            ->join('books', 'books.book_id', '=', 'orders.book_id')
//            ->select('username','orders.order_id', 'books.author', 'books.publishing_year' , 'books.name') -> get();
        return redirect()->action(
            'OrderController@showOrders'
        );
       // return view ('processOrders',['orders' => $user -> getAllOrders()]);



    }
    public function rejectOrder(Request $req){
        $user = Auth::user();
        $order_id = $req -> input("order_id");
        $order = Orders::where('order_id',$order_id)->first();
        $order -> rejectBooking();
//        $orders = DB::table('orders')
//            ->join('books', 'books.book_id', '=', 'orders.book_id')
//            ->select('username','orders.order_id', 'books.author', 'books.publishing_year' , 'books.name') -> get();
        //return view ('processOrders',['orders' => $user -> getAllOrders()]);
        return redirect()->action(
            'OrderController@showOrders'
        );
    }
}

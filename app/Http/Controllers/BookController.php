<?php

namespace App\Http\Controllers;
use App\Book;

use App\Booked;
use \Input;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function librarianBookList(){
        return view('librarianView',['books' => Book::all()]);
    }
    public function bookedBooks(){
        $booked = new Booked();
        return view('bookedBooks',['bookings' => $booked -> allBooked()]);
    }
    public function addBookView(){
        return view('addBook');
    }
    public function addBook(Request $req){
        $name = $req -> input("bookname");
        $author = $req -> input("author");
        $publishingyear = $req -> input("publishingyear");
        $quantity = $req -> input("quantity");

        $book = new Book();
        $addbook = $book -> addBook(array(
            "name"              => $name,
            "author"            => $author,
            "publishingyear"    => $publishingyear,
            "quantity"          => $quantity
        ));
        if($addbook){
            return view('addBook',['successMessage'=>"Book was added"]);
        }else{
            return view('addBook', ['errorMessage'=>"Something went wrong. Try again."]);
        }

    }
    public function deleteBook(Request $req){
        $book_id = $req -> input("book_id");
        $book = new Book();
        $action = $book -> deleteBook($book_id);
        if($action){
            return view('adminView',['books' => Book::all(),'successMessage'=>"Book was deleted"]);
        }else{
            return view('adminView', ['books' => Book::all(),'errorMessage'=>"Book wan't deleted"]);
        }
    }
    public function addimageView(){
        return view('addimage', ['books' => Book::all()]);
    }
    public function addimage(Request $req){
        $book_name = $req -> input("book_name");
        echo $book_name;
        if(Input::hasFile('fileToUpload')){

            $file = Input::file('fileToUpload');
            $file -> move('uploads', $book_name .".jpg");
            return view('addimage', ['books' => Book::all()]);

        }
    }
}

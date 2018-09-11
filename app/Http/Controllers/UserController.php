<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Book;
use DB;
use Auth;
use Mail;

class UserController extends Controller
{
    public function addStudentView(Request $req){
        $booking_id = $req -> input("booking_id");
        return view('addStudent');
    }
    public function addStudent(Request $req){
        if(Auth::user()->hasRole('admin')){
            $role = $req -> input("role");
            if(strval($role) != 'student' ){
                if(strval($role) != 'librarian'){
                    echo $role . " ". "librarian";
                }

                //return view('addStudent', ['errorMessage'=>"ERROR: Please, select role"]);
            }
        }

        $first = $req -> input("firstname");
        $last = $req -> input("lastname");
        $phone = $req -> input("phone");

        if(strlen($req -> input("password"))>5){
            $password = Hash::make($req -> input("password"));
        }else{
            return view('addStudent', ['errorMessage'=>"ERROR: Password to short"]);
        }

        $user = new User();
        $checkMessage = $user -> checkStudent(
            array(
                "firstname"     => $first,
                "lastname"      => $last,
                "phone"         => $phone
            ));

        if($checkMessage[0]){

            return view('addStudent', ['successMessage'=>$user -> addStudent(array(
                "firstname"     => $first,
                "lastname"      => $last,
                "password"      => $password,
                "phone"         => $phone,
                "role"          => $role
            ))]);
        }else{
            return view('addStudent', ['errorMessage'=>$checkMessage[1]]);
        }

    }
    public function getAdminView(){
        return view('adminView',['books' => Book::all()]);
    }
    public function sendMail(){
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
        Mail::send('mail', $data, function($message) {
            $message->to('strongermaner@gmail.com', 'Artisans Web')
                ->subject('Artisans Web Testing Mail');
            $message->from('library.laravel.mailer@gmail.com','Sajid Sayyad');
        });
    }
}

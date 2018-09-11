<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use View;
use Auth;
use Redirect;
use App\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    public function showWelcome()
    {
        return View::make('hello');
    }
    public function showLogin()
    {
        return View::make('login');
    }
    public function doLogin()
    {

        $rules = array(
            'username'    => 'required|username',
            'password' => 'required|alphaNum|min:3'
        );


            $userdata = array(
                'username' 	=> Input::get('username'),
                'password' 	=> Input::get('password')
            );

            if (Auth::attempt($userdata)) {
                $user = Auth::user();
                if($user-> hasRole("Student")){
                    return view('studentView',['books' => Book::all(),'user' => $user['username']]);

                }elseif ($user-> hasRole("Librarian")){
                    return view('librarianView',['books' => Book::all()]);
                }elseif ($user-> hasRole("Admin")){
                    return view('adminView',['books' => Book::all()]);
                }
            } else {
                // validation not successful, send back to form
                return view('login',['errorMessage' => 'INPUT ERROR: Bad Username or Password']);
            }

    }
    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
}

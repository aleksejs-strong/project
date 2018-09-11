<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {

        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');

    }

    public function orders()
    {
        $this->primaryKey = "username";
        $out = $this->belongsToMany('App\Book', 'orders', 'username', 'book_id');
        $this->primaryKey = "id";
        return $out;
    }

    public function userHasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {

        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasorders($in)
    {
        //return $this->orders()->where('username', $in)->get()->author;

    }

    protected $fillable = [
        'password'
//        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getOrders()
    {
        $orders = DB::table('orders')
            ->join('books', 'books.book_id', '=', 'orders.book_id')
            ->where('username', $this->username)
            ->select('orders.order_id', 'books.author', 'books.publishing_year', 'books.name')->get();
        return $orders;
    }

    public function getAllOrders()
    {
        $orders = DB::table('orders')
            ->join('books', 'books.book_id', '=', 'orders.book_id')
            ->select('username', 'orders.order_id', 'books.author', 'books.publishing_year', 'books.name')->get();
        return $orders;
    }

    public function generateNumbers()
    {
        $result = '';
        for ($i = 0; $i < 5; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function generateUsername($first, $last)
    {
        $result = strtolower($first[0]) . strtolower($last[0]) . $this->generateNumbers();

        while ($this::where('username', $result)->count() != 0) {
            $result = $first[0] . $last[0] . $this->generateNumbers();
        };
        return $result;
    }

    public function addStudent($arr)
    {
        $username = $this->generateUsername($arr['firstname'], $arr['lastname']);

        $userInsert = DB::table('users')->insert([
            'username' => $username,
            'password' => $arr['password'],
            'email' => strtolower($arr['firstname']) . strtolower($arr['lastname']) . "@some.com",
            'phone' => $arr['phone']
        ]);
        $user = $this::where('username', $username)->first();
        if($arr['role']!= NULL){
            $user->roles()->attach(Role::where('name', $arr['role'])->first());
        }else {
            $user->roles()->attach(Role::where('name', 'Student')->first());
        }
        return $username;

    }

    public function checkStudent($arr)
    {
        $phone = preg_replace("/[^A-Za-z0-9]/", "", $arr['phone']);
        if (User::where('phone', $phone)->count() != 0) {
            return [false, "ERROR: Phone number already exists"];
        } elseif (strlen($phone) != 8) {
            return [false, "ERROR: Phone number should be 8 characters"];
        } elseif (User::where('email', strtolower($arr['firstname']) . strtolower($arr['lastname']) . "@some.com")->count() != 0) {
            return [false, "ERROR: Person with same name and surname already exist"];
        }
        return [true, "Acceptable credentials"];


    }

    public function accessError()
    {
        return view('error');
    }
}
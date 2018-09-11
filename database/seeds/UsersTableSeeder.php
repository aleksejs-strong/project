<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_student = Role::where('name', 'Student') -> first();
        $role_admin = Role::where('name', 'Admin') -> first();
        $role_librarian = Role::where('name', 'Librarian') -> first();

        $admin = new User();
        $admin-> username = 'admin';
        $admin -> password = Hash::make('admin');
        $admin -> email = "admin@some.com";
        $admin -> phone = "2".(string)rand(1111111,9999999);
        $admin -> save();
        $admin -> roles() -> attach($role_admin);

        $librarian = new User();
        $librarian -> username = 'librarian';
        $librarian  -> password = Hash::make('librarian');
        $librarian  -> email = "librarian@some.com";
        $librarian  -> phone = "2".(string)rand(1111111,9999999);
        $librarian  -> save();
        $librarian -> roles() -> attach($role_librarian);


        $students = array(
            "ar17016"  => array("Aleksejs","Romanuks","123456"),
            "az11111"  => array("Aidis","Zvinelis","123456"),
            "fm22222"  => array("Falks","Melderis","123456"),
            "lp33333"  => array("Lindons","Priede","123456"),
            "mr44444"  => array("Matis","Romanovskis","123456"),
            "no55555"  => array("Nansija","Ose","123456"),
            "ip66666"  => array("Ivande","Pole","123456")
        );
        foreach ($students as $key => $val) {
            $student = new User();
            $student -> username = $key;
            $student -> password = Hash::make($val[2]);
            $student -> email = lcfirst($val[0]).lcfirst($val[1])."@some.com";
            $student -> phone = "2".(string)rand(1111111,9999999);
            $student -> save();
            $student -> roles() -> attach($role_student);




//            DB::table('users')->insert([
//                'username' => $key,
//                'password' =>  Hash::make($val[2]),
//                'email' => lcfirst($val[0]).lcfirst($val[1])."@some.com",
//                'phone' => "2".(string)rand(1111111,9999999)
//            ]);


        }
    }
}

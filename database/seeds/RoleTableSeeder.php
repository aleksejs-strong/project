<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'The admin user';
        $role_admin->save();

        $role_librarian = new Role();
        $role_librarian->name = 'Librarian';
        $role_librarian->description = 'The librarian user';
        $role_librarian->save();

        $role_student = new Role();
        $role_student ->name = 'Student';
        $role_student ->description = 'The student user';
        $role_student ->save();
    }
}

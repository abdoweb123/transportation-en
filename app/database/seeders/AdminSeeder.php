<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        Admin::create([
            'name'=>'ali',
            'email'=>'ali@gmail.com',
            'type'=>1,
            'password'=>bcrypt('ali@gmail.com'),

        ]);

    }

} //end of seeder

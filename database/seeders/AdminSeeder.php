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
            'password'=>bcrypt('ali@gmail.com'),
            'admin_id'=>'1',
        ]);

    }

} //end of seeder

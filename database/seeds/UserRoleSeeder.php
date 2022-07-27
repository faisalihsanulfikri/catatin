<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    private function countData($type){
        return DB::table('user_role')->where('type', $type)->get()->count();
    }

    public function run()
    {
        if(self::countData('administrator') == 0){
            DB::table('user_role')->insert([
                'type' => 'administrator'
            ]);
        }
    }
}

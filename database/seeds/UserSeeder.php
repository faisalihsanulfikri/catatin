<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private function countData($email){
        return DB::table('user')->where('email', $email)->get()->count();
    }

    public function run()
    {
        if(self::countData('faisal@catatin.com') == 0){
            DB::table('user')->insert([
                'name' => 'Faisal Ihsanul Fikri',
                'email' => 'faisal@catatin.com',
                'password' => Hash::make('qwerty'),
                'user_role_id' => 1,
            ]);

            $user = DB::table('user')->where('email', 'faisal@catatin.com')->first();
            $this->generateWealth($user->id);

        }
        if(self::countData('yuni@catatin.com') == 0){
            DB::table('user')->insert([
                'name' => 'Yuni Destiani Putri',
                'email' => 'yuni@catatin.com',
                'password' => Hash::make('qwerty'),
                'user_role_id' => 1,
            ]);

            $user = DB::table('user')->where('email', 'yuni@catatin.com')->first();
            $this->generateWealth($user->id);
        }
        if(self::countData('faisal-month@catatin.com') == 0){
            DB::table('user')->insert([
                'name' => 'Faisal Month',
                'email' => 'faisal-month@catatin.com',
                'password' => Hash::make('qwerty'),
                'user_role_id' => 1,
            ]);

            $user = DB::table('user')->where('email', 'faisal-month@catatin.com')->first();
            $this->generateWealth($user->id);

        }
    }

    public function generateWealth($user_id)
    {
        DB::table('wealth')->insert([
            'amount' => 0,
            'user_id' => $user_id
        ]);
    }
}

<?php

use App\Models\User;
use App\Models\Application;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'user@user.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $applications = [
            [
                'user_id'          => '2',
                'name'          => 'Test Name',
            ],
        ];

        User::insert($accounts);
        Application::insert($applications);
    
        
    }
}

<?php

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'name'           => 'Johnpaul Admin',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'user@user.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'name'           => 'Johnpaul User',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $events = [
            [
                'event_id'          => 'EVT985529',
                'category'          => 'Activity',
                'title'          => 'A pariatur Rerum no',
                'location'          => 'Voluptatem ',
                'date'          => '2022-09-13',
                'time'          => '22:29',
                'isOpen'          => 'YES',
                'description'          => 'Qui aut fugiat dist',
               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'event_id'          => 'EVT985836',
                'category'          => 'Activity',
                'title'          => 'Quo eum illo veritat',
                'location'          => 'Laborum eu minim iru ',
                'date'          => '2022-09-13',
                'time'          => '13:12',
                'isOpen'          => 'YES',
                'description'          => 'Quae ut possimus vo',
               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'event_id'          => 'EVT985811',
                'category'          => 'Event',
                'title'          => 'Velit repudiandae er',
                'location'          => 'Voluptatem ',
                'date'          => '2022-09-13',
                'time'          => '22:59',
                'isOpen'          => 'YES',
                'description'          => 'Qui aut fugiat dist',
               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];


        
        User::insert($accounts);
        Event::insert($events);
     
        
    }
}

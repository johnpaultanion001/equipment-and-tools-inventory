<?php

use App\Models\User;
use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'name'           => 'Test Admin',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'user@user.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'name'           => 'Test User',
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
                'title'          => 'Basketball',
                'location'          => 'Basketball Court',
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
                'title'          => 'Volleyball',
                'location'          => 'Volleyball Court',
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

        $sponsors = [
            [
               'title'          => 'Mayor',
               'image'           => 'bg1.jpg',
               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'          => 'Kagawad',
                'image'           => 'bg2.jpg',
                
                 'created_at' => date("Y-m-d H:i:s"),
                 'updated_at' => date("Y-m-d H:i:s"),
             ],
             [
                'title'          => 'Sk Chairman',
                'image'           => 'bg3.jpg',
                
                 'created_at' => date("Y-m-d H:i:s"),
                 'updated_at' => date("Y-m-d H:i:s"),
             ],
             [
                'title'          => 'Home Owner',
                'image'           => 'bg4.jpg',
                
                 'created_at' => date("Y-m-d H:i:s"),
                 'updated_at' => date("Y-m-d H:i:s"),
             ],
             [
                'title'          => 'Village Owner',
                'image'           => 'bg5.jpg',
                
                 'created_at' => date("Y-m-d H:i:s"),
                 'updated_at' => date("Y-m-d H:i:s"),
             ],
        ];


        
        User::insert($accounts);
        Event::insert($events);
        Sponsor::insert($sponsors);
     
        
    }
}

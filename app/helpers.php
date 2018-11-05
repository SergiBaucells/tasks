<?php

use App\Task;
use App\User;

if (!function_exists('create_primary_user')) {
    function create_primary_user()
    {
        $user = User::where('email', 'sergibaucells@gmail.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'Sergi Baucells',
                'email' => 'sergibaucells@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', '123456'))
            ]);
        }
    }
}

if (!function_exists('create_example_tasks')) {
    function create_example_tasks()
    {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }

    if (!function_exists('login')) {
        function login($test, $guard = null): void
        {
            $user = factory(User::class)->create();
            $test->actingAs($user, $guard); //WEB
            //        $this->actingAs($user,'api'); //API
        }
    }
}


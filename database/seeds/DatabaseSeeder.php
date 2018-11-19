<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        create_primary_user();
        create_example_tasks();
        create_example_tags();
        initialize_roles();

        // Crea usuaris de proves
        sample_users();

    }
}

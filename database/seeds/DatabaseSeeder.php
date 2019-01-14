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
        create_example_tasks_with_tags();
        initialize_roles();
        sample_logs();

        // Crea usuaris de proves
        sample_users();

    }
}

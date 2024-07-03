<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path_criar = base_path('database/criar.sql');
        $path_povoar = base_path('database/povoar.sql');
        $path_indexes = base_path('database/indexes.sql');
        $path_transactions = base_path('database/transactions.sql');
        $path_triggers = base_path('database/triggers.sql');

        $file_criar = file_get_contents($path_criar);
        $file_povoar = file_get_contents($path_povoar);
        $file_indexes = file_get_contents($path_indexes);
        $file_transactions = file_get_contents($path_transactions);
        $file_triggers = file_get_contents($path_triggers);

        DB::unprepared($file_criar);
        DB::unprepared($file_povoar);
        DB::unprepared($file_indexes);
        DB::unprepared($file_transactions);
        DB::unprepared($file_triggers);

        $this->command->info('Database seeded!');
    }
}

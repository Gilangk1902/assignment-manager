<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Board;
use App\Models\User;
use App\Models\Task;
use App\Models\Group;
use Database\Factories\TaskFactory;
use Hash;
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
        User::factory()->create([
            'name' => 'Gilang Kurniawan',
            'email' => 'gilangk1902@gmail.com',
            'password' => Hash::make('test123')
        ]);

        User::factory(10)->create();

        Board::factory(2)->create();    
        Group::factory(3)->create();
        Task::factory(3)->create();
    }
}

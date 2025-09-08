<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $categories = Category::factory(6)->create();

        $mainTasks = Task::factory(25)->create([
            'parentTask_id' => null,
        ]);
        
        // Create sub Task
        $mainTasks->each(function ($main) {
            // if fake is 60% then create the sub task
            if (fake()->boolean(60)) {
                Task::factory(fake()->numberBetween(1, 3))->create([
                    'parentTask_id' => $main->id,
                ]);
            }
        });

        // query is used instead of all because it gathers the elements from the database
        // in chunks like when we sasy // select * from db.table limit 1000;
        Task::query()->each(function (Task $task) use ($users, $categories) {
            $task->users()->attach($users->random(fake()->numberBetween(1, 3))->pluck('id'));
            $task->categories()->attach($categories->random(fake()->numberBetween(1, 3))->pluck('id'));
        });
    }
}

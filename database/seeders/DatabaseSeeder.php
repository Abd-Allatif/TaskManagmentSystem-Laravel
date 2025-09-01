<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users & Categories
        $users      = User::factory(10)->create();
        $categories = Category::factory(6)->create();

        // Create parent (root) tasks
        $parents = Task::factory(25)->create([
            'parentTask_id' => null,
        ]);

        // Some parents get subtasks (1–3 each)
        $parents->each(function ($parent) {
            if (fake()->boolean(60)) {
                Task::factory(fake()->numberBetween(0,1))->create([
                    'parentTask_id' => $parent->id,
                    // keep other fields auto from factory
                ]);
            }
        });

        // Attach users & categories to ALL tasks (parents + subtasks)
        Task::query()->each(function (Task $task) use ($users, $categories) {
            $task->users()->attach($users->random(fake()->numberBetween(0,1))->pluck('id'));
            $task->categories()->attach($categories->random(fake()->numberBetween(0,1))->pluck('id'));
        });
    }
}

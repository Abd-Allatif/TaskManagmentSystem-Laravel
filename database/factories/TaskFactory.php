<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $created = $this->faker->dateTimeBetween('-60 days', '-1 day');

        $status = $this->faker->randomElement(['pending', 'in_progress', 'completed']);
        $end    = $status === 'completed' ? true : $this->faker->boolean(10);

        return [
            'title'         => $this->faker->sentence(4),
            'description'   => $this->faker->paragraph(),
            'create_date'   => $created, // matches your column name
            // deadline is DATE, so store a date string after create_date
            'deadline'      => Carbon::instance($created)->addDays($this->faker->numberBetween(1, 60))->toDateString(),
            'status'        => $status,
            'end_flag'      => $end,
            'parentTask_id' => null, // root by default
        ];
    }
}

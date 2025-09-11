<?php

namespace Database\Factories;

use App\enums\Status;
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
        $created = fake()->dateTimeBetween('-60 days', '-1 day');
        $status = fake()->randomElement([Status::Pending, Status::In_Progress, Status::Completed,Status::Expired]);
        $end = $status == Status::Completed ? true : false;

        return [
            'title'         => fake()->sentence(3),
            'description'   => fake()->paragraph(),
            'create_date'   => $created,
            'deadline'      => Carbon::instance($created)->addDays(fake()->numberBetween(1, 60))->toDateString(),
            'status'        => $status,
            'end_flag'      => $end,
            'parentTask_id' => null,
        ];
    }
}

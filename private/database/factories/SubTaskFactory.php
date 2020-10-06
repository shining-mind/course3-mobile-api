<?php

namespace Database\Factories;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => Task::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'deadline' => $this->faker->dateTimeBetween('now', '+30 days'),
        ];
    }
}

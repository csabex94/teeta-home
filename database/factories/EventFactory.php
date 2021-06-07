<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    return [
            'title' => $this->faker->text(60),
            'description' => $this->faker->paragraph(),
            'user_id' => 1,
            'spec_date' => Carbon::createFromTimeStamp($this->faker->dateTimeBetween('now', '+1 month')->getTimestamp())->toDateTimeString(),
            'spec_time' => $this->faker->time()
        ];
    }
}

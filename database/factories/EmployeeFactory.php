<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'occupation' => $this->faker->jobTitle,
            'bio' => $this->faker->text($maxNbChars = 200),
            'email' => $this->faker->safeEmail,
            'social_media' => $this->faker->userName,
            'company_id' => function() {
                return Company::factory()->create()->id;
            },
        ];
    }
}

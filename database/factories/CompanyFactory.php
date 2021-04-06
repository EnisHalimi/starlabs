<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'banner' => $this->faker->word,
            'website' => $this->faker->domainName,
            'quality1' => $this->faker->word,
            'quality2' => $this->faker->word,
            'quality3' =>  $this->faker->word,
            'user_id' => function() {
                return User::factory()->create()->id;
            },
        ];
    }
}

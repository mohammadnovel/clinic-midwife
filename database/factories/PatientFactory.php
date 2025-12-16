<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('16##00######000#'),
            'name' => $this->faker->name('female'),
            'date_of_birth' => $this->faker->dateTimeBetween('-40 years', '-20 years'),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'husband_name' => $this->faker->name('male'),
            'husband_phone' => $this->faker->phoneNumber(),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'bpjs_number' => $this->faker->numerify('000##########'),
        ];
    }
}

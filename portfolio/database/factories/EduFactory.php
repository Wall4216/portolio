<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Edu>
 */
class EduFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'institution' => 'Tis-bi-Russian',
            'period'=> '2020-2024',
            'degree' => 'Developer',
            'department' => 'Computer Science'
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Portfolio',
            'description' => 'Website-Portfolio',
            'link' => 'https://github.com/Wall4216/portolio',
            'photo'=> 'avatar.png'
        ];
    }
}

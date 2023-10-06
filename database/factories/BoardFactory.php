<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'slug' => fake()->slug(),
            'user_id' => 1
        ];
    }

    // Schema::create('boards', function (Blueprint $table) {
    //     $table->id(); 
    //     $table->foreignId('user_id')->onDelete('cascade');
    //     $table->text('title');
    //     $table->timestamps();
    //     $table->string('slug')->unique();
    // });
}

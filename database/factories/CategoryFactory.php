<?php

namespace Database\Factories;
use App\Models\Backend\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     *
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'en_name' => $this->faker->name,
            'ar_name' => $this->faker->name,
            'en_detail' => $this->faker->text,
            'ar_detail' =>  $this->faker->text,
        ];
    }
}

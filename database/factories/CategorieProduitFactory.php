<?php

namespace Database\Factories;

use App\Models\CategorieProd;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CategorieProd>
 */
class CategorieProduitFactory extends Factory
{
    protected $model = CategorieProd::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomCategorie = $this->faker->unique()->words(3, true);

        return [
            'slug' => Str::slug($nomCategorie) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'nom_categorie' => ucfirst($nomCategorie),
            'description' => $this->faker->paragraphs(2, true),
            'image' => $this->faker->imageUrl(640, 480, 'fashion', true),
            'status' => $this->faker->boolean(85),
        ];
    } 
}

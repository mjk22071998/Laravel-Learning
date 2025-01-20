<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence(6); // Generates a random title

        // Generate a slug from the title
        $slug = Str::slug($title);

        // Check if the slug exists and modify it if necessary
        $slugCount = Post::where('slug', 'like', "$slug%")->count();
        if ($slugCount > 0) {
            $slug = $slug . '-' . ($slugCount + 1);
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraph(10),
        ];
    }
}
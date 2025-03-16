<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\User;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'author' => $this->faker->name(),
            'content' => $this->faker->paragraphs(3, true),
            'slug' => Str::slug($title),
            'image' => $this->faker->imageUrl(640, 480, 'articles', true),
            'status' => $this->faker->boolean(80), // 80% chance of being active
            'published_at' => $this->faker->optional()->dateTime(),
        ];
    }
}


<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data_time=$this->faker->date.''.$this->faker->time;
        return [
            'user_id'=>$this->faker->randomElement(['1','2','3']),
            'content'=>$this->faker->text,
            'status_id'=>$this->faker->randomElement(['1','2','3']),
            'parent'=>$this->faker->randomElement(['0','1','2','3']),
            'created_at'=>$data_time,
            'updated_at'=>$data_time
        ];
    }
}

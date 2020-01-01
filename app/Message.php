<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class Message extends Model
{
    const MAX_PERPAGE = 10;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message'
    ];

    /**
     * create fake message model data
     * @return array
     */
    public function fake() :array
    {
        $faker = Faker::create();
        return [
            'id' => $faker->randomNumber(null, true),
            'message' => $faker->sentence,
            'created_at' => $faker->date('Y-m-d H:i:s')
        ];
    }
}

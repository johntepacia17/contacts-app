<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name'    => $this->faker->name(),
            'company' => $this->faker->optional()->company(),
            'email'   => $this->faker->optional()->safeEmail(),
            'phone'   => $this->faker->optional()->phoneNumber(),
        ];
    }
}

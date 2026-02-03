<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->get();

        foreach ($users as $user) {
            Contact::factory()
                ->count(30)
                ->create(['user_id' => $user->id]);
        }
    }
}

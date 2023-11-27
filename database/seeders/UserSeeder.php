<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Task User',
            'email'=> 'task@app.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
        ]);
    }
}

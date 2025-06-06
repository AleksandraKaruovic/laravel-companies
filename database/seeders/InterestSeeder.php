<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class InterestSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $companies = Company::all();

        foreach ($users as $user) {
            
            $randomCompanies = $companies->random(rand(4, 8))->pluck('id');
            $user->interestedCompanies()->syncWithoutDetaching($randomCompanies);
        }
    }
}

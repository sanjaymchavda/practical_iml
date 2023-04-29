<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array = [
            "Google",
            "Yahoo",
            "Facebook",
            "Twitter",
            "Oracle",
            "Relience",
            "Essar",
            "Amazon",
            "Flipkart",
            "Alibaba",
            "Zomato",
            "Swiggy",
            "Torrent",
            "Tata"
        ];

        foreach ($array as $value) {
            Company::create(["name"=>$value]);
        }
    }
}

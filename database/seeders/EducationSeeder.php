<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            "10th",
            "12th",
            "BBA",
            "BCA",
            "BCOM",
            "BA",
            "MBA",
            "MCA",
            "MCOM",
            "MA",
            "MSCIT",
            "MSW",
            "PGDCA",
            "BPHARM"
        ];

        foreach ($array as $value) {
            Education::create(["name"=>$value]);
        }

    }
}

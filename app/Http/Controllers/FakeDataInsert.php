<?php

namespace App\Http\Controllers;

use App\Models\FakeUser;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FakeDataInsert extends Controller
{
    public function insert(Request $request)
    {
        Schema::disableForeignKeyConstraints();
        FakeUser::truncate();
        Schema::enableForeignKeyConstraints();
        $faker     = Faker::create();
        $userCount = $request->userCount;

        for ($i = 1; $i <= $userCount; $i++) {

            FakeUser::create([
                'name' => $faker->name,
            ]);
        }
    }
}

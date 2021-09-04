<?php

namespace App\Http\Controllers;

use App\Models\CountCheck;
use Illuminate\Http\Request;

class ResetCountCheckController extends Controller
{
    public function reset(Request $request)
    {

        CountCheck::truncate();
        $count = $request->count;
        if (!empty($count)) {

            for ($i = 0; $i < $count; $i++) {
                $result = CountCheck::insertGetId([
                    'is_scraped' => 0,
                ]);
            }
            dd("$count Count Created & Reset Successfully");

        } else {
            dd("please enter count Like /reset?count=20000");
        }
    }
}

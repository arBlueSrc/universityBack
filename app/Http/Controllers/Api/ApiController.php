<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Employee;
use App\Models\Good;
use App\Models\GoodProperty;
use App\Models\Lend;
use App\Models\Part;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\Store;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ApiController extends Controller
{
    public function registerForm(Request $request)
    {

        $user = UserAnswer::create([
            "name" => $request->name,
            "job" => $request->job,
            "phone" => $request->phone,
        ]);

        for ($i = 1; $i < 33; $i++){

            if ($request->$i != "-100"){
                Answer::create([
                    "question" => $i,
                    "rate" => $request->$i,
                    "user_id" => $user->id
                ]);
            }

        }

        return response()->json([
            'status' => true,
            'result' => "form submit successfully",
        ], 200);

    }


}

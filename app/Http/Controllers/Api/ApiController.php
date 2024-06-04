<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function login(Request $request)
    {



        return response()->json([
            'status' => false,
            'result' => "username is wrong.",
        ], 200);

    }


}

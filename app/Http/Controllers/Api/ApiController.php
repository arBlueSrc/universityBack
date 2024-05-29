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
    public function getQr($user_id)
    {
        echo URL::to('/api/getQr/2');
    }

    public function login(Request $request)
    {

        $user = UserAnswer::where('name', $request->input('username'))->first();

        if ($user) {
            $check_password = Hash::check($request->input('password'), $user->password);
            if ($check_password) {
                return response()->json([
                    'status' => true,
                    'result' => "login.",
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'result' => "password is not ok",
                ], 200);
            }
        }

        return response()->json([
            'status' => false,
            'result' => "username is wrong.",
        ], 200);

    }

    public function getDetail(Request $request)
    {
        $user_id = $request->input('user_id');

        //get employee data
        $employee = Employee::find($user_id);
        $user = new \stdClass();
        $user->name = Crypt::decrypt($employee->name);
        $user->last_name = Crypt::decrypt($employee->last_name);
        $user->part = Crypt::decrypt($employee->part->name);
        $user->store = Crypt::decrypt(Store::where('id', $employee->part->store_id)->first()->name);

        //get products
        $products_model = json_encode(Product::
        select('id', 'good_id', 'property_number',)
            ->where('employee_id', $user_id)
            ->with(array(
                'good' => function ($query) {
                    $query->select("id", 'name');
                }
            ))->get());

        $products = json_decode($products_model);

        $counter = 0;
        foreach ($products as $product) {

            $productProperty = json_encode(ProductProperty::where('product_id', $product->id)
                ->with(array(
                    'goodProperty' => function ($query) {
                        $query->select("id", 'name');
                    }
                ))
                ->select('id', 'value', 'good_properties_id')->get());

            $fpp = json_decode($productProperty);

            $lend = Lend::where('product_id', $products[$counter]->id)->latest('id')->first();
            if ($lend){
                if ($lend )
                $products[$counter]->is_loaned = ($lend->is_returned == 0) ? 1 : 0;
            }else{
                $products[$counter]->is_loaned = 0;
            }

            for ($i = 0; $i<sizeof($fpp) ; $i++){

                $fpp[$i]->value = Crypt::decrypt($fpp[$i]->value);

                $fpp[$i]->good_property->name = Crypt::decrypt($fpp[$i]->good_property->name);

            }

            $products[$counter]->products = $fpp;

            $counter += 1;

        }

        for ($i = 0; $i<sizeof($products) ; $i++) {
            $products[$i]->good->name = Crypt::decrypt($products[$i]->good->name);
        }

        return response()->json([
            'status' => true,
            'products' => $products,
            'user' => $user
        ], 200);

    }

    public function editProduct(Request $request)
    {

        //get input value
        $product_id = $request->input('product_id');
        $property_number = $request->input('property_number');
        $json_good_property = $request->input('good_property');


        //get list of product properties
        $good_property = json_decode($json_good_property);
        foreach ($good_property as $g_p) {
            ProductProperty::where('id', $g_p->id)->update([
                'value' => Crypt::encrypt($g_p->value)
            ]);
        }

        //update product property_number
        Product::find($product_id)->update([
            'property_number' => $property_number
        ]);


        return response()->json([
            'status' => true,
            'result' => 'Done!'
        ], 200);
    }

    public function lend(Request $request)
    {

        $product_id = $request->input('product_id');
        $borrower_id = $request->input('borrower_id');
        $lend_description = $request->input('lend_description');

        Lend::create([
            'product_id' => $product_id,
            'borrower_id' => $borrower_id,
            'lend_description' => $lend_description
        ]);

        return response()->json([
            'status' => true,
            'result' => 'Done!'
        ], 200);

    }

    public function staff()
    {
        $employee = Employee::select('id','name','last_name')->get();

        for ($counter = 0; $counter<sizeof($employee); $counter++){
            $employee[$counter]->name = Crypt::decrypt($employee[$counter]->name);
            $employee[$counter]->last_name = Crypt::decrypt($employee[$counter]->last_name);
        }

        return response()->json([
            'status' => true,
            'result' => $employee
        ], 200);
    }


    public function takeBack(Request $request)
    {

        $product_id = $request->input('product_id');
        $description = $request->input('description');

        $land = Lend::where('product_id',$product_id)->where('is_returned',0)->orderBy('id', 'desc')
            ->first();

        $land->update([
            'is_returned' => 1,
            'description' => $description,
        ]);

        return response()->json([
            'status' => true,
            'result' => 'Done!'
        ], 200);

    }


    // create product steps
    public function addProduct1()
    {
        $goods = Good::select('id', 'name')->get();
        $stores = Store::select('id', 'name')->get();
        $parts = Part::select('id', 'name')->get();
        $employees = Employee::select('id', 'name', 'last_name')->get();

        for ($i = 0; $i<sizeof($goods) ; $i++) {
            $goods[$i]->name = Crypt::decrypt($goods[$i]->name);
        }

        for ($i = 0; $i<sizeof($stores) ; $i++) {
            $stores[$i]->name = Crypt::decrypt($stores[$i]->name);
        }

        for ($i = 0; $i<sizeof($parts) ; $i++) {
            $parts[$i]->name = Crypt::decrypt($parts[$i]->name);
        }

        for ($i = 0; $i<sizeof($employees) ; $i++) {
            $employees[$i]->name = Crypt::decrypt($employees[$i]->name);
            $employees[$i]->last_name = Crypt::decrypt($employees[$i]->last_name);
        }

        $result = new \stdClass();
        $result->goods = $goods;
        $result->stores = $stores;
        $result->parts = $parts;
        $result->employees = $employees;

        //decrypt data


        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function addProduct2(Request $request)
    {

        $good_id = $request->input('good_id');

        $properties = GoodProperty::select('id', 'name')->where('good_id', $good_id)->get();

        for ($i = 0; $i<sizeof($properties) ; $i++) {
            $properties[$i]->name = Crypt::decrypt($properties[$i]->name);
        }

        return response()->json([
            'status' => true,
            'result' => $properties
        ], 200);
    }

    public function addProduct3(Request $request)
    {

        $good_id = $request->input('good_id');
        $store_id = $request->input('store_id');
        $part_id = $request->input('part_id');
        $employee_id = $request->input('employee_id');
        $property_number = $request->input('property_number');
        $json_good_property = $request->input('good_property');


        //create product
        $product = Product::create([
            'good_id' => $good_id,
            'store_id' => $store_id,
            'part_id' => $part_id,
            'employee_id' => $employee_id,
            'property_number' => $property_number
        ]);


        //get list of product properties
        $good_property = json_decode($json_good_property);
        foreach ($good_property as $g_p) {
            ProductProperty::create([
                'product_id' => $product->id,
                'good_properties_id' => $g_p->id,
                'value' => Crypt::encrypt($g_p->value)
            ]);
        }

        return response()->json([
            'status' => true,
            'result' => 'Done!'
        ], 200);

    }

}

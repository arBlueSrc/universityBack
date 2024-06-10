<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Employee;
use App\Models\Lend;
use App\Models\Part;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\Store;
use App\Models\UserAnswer;
use App\MyClass\GorGianToJalai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AnswerController extends Controller
{
    public function index()
    {
        $userAnswer = UserAnswer::all();
        return view('admin.answer.index', compact('userAnswer'));
    }

    public function create()
    {
        $parts = Part::get();
        return view('admin.answer.create', compact('parts'));
    }

    public function store(Request $request)
    {

        $valid_data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'part' => 'required',
        ]);

        Employee::create([
            'name' => Crypt::encrypt($valid_data['name']),
            'last_name' => Crypt::encrypt($valid_data['last_name']),
            'part_id' => $valid_data['part']
        ]);

        $employees = Employee::paginate(10);
        return view('admin.answer.index', compact('employees'));

    }

    public function edit($id)
    {

        $employee = Employee::where('id', $id)->first();
        $parts = Part::get();

        return view('admin.answer.edit', compact('employee', 'parts'));
    }

    public function destroy($id)
    {
        Employee::where('id', $id)->delete();

        $employees = Employee::paginate(10);
        return view('admin.answer.index', compact('employees'));
    }

    public function update(Request $request, $id)
    {
        $valid_data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'part' => 'required',
        ]);

        Employee::where('id', $id)->update([
            'name' => Crypt::encrypt($valid_data['name']),
            'last_name' => Crypt::encrypt($valid_data['last_name']),
            'part_id' => $valid_data['part']
        ]);

        $employees = Employee::paginate(10);
        return view('admin.answer.index', compact('employees'));
    }

    public function qrcode($user_id)
    {
        $user = Employee::where('id', $user_id)->first();
        $username = Crypt::decrypt($user->name) . " " . Crypt::decrypt($user->last_name);

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length("aes-128-cbc");
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = 'WHG7HsS84kIGvzzI';

        // Store the encryption key
        $encryption_key = "X9vIyNiptseccxdC";

        // Use openssl_encrypt() function to encrypt the data
        $en_id = openssl_encrypt($user_id, "aes-128-cbc",
            $encryption_key, $options, $encryption_iv);

        return view('admin.answer.qrcode', compact('en_id', 'username'));
    }


    public function allQrCode()
    {

        $users = Employee::get();

        foreach ($users as $key => $user) {
            $username = Crypt::decrypt($user->name) . " " . Crypt::decrypt($user->last_name);

            // Use OpenSSl Encryption method
            $iv_length = openssl_cipher_iv_length("aes-128-cbc");
            $options = 0;

            // Non-NULL Initialization Vector for encryption
            $encryption_iv = 'WHG7HsS84kIGvzzI';

            // Store the encryption key
            $encryption_key = "X9vIyNiptseccxdC";

            // Use openssl_encrypt() function to encrypt the data
            $en_id = openssl_encrypt($user->id, "aes-128-cbc",
                $encryption_key, $options, $encryption_iv);

            $users[$key]->en_id = $en_id;
        }

        return view('admin.answer.allqrcode', compact('users'));

    }

    public function show($id)
    {

        $user_id = $id;

        //get answer data
        $employee = Employee::find($user_id);
        $user = new \stdClass();
        $user->id = $employee->id;
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
            if ($lend) {
                if ($lend)
                    $products[$counter]->is_loaned = ($lend->is_returned == 0) ? 1 : 0;
            } else {
                $products[$counter]->is_loaned = 0;
            }

            for ($i = 0; $i < sizeof($fpp); $i++) {

                $fpp[$i]->value = Crypt::decrypt($fpp[$i]->value);

                $fpp[$i]->good_property->name = Crypt::decrypt($fpp[$i]->good_property->name);

            }

            $products[$counter]->products = $fpp;

            $counter += 1;

        }

        for ($i = 0; $i < sizeof($products); $i++) {
            $products[$i]->good->name = Crypt::decrypt($products[$i]->good->name);
        }

        return view('admin.answer.show', compact('user', 'products'));
    }

    public function invoicePrint(Request $request)
    {

        $date_helper = new GorGianToJalai();

        $shamsi_date = $date_helper->gregorian_to_jalali(date('Y'), date('m'), date('d'), "");
        $shamsi_date = $shamsi_date[0] . "/" . $shamsi_date[1] . "/" . $shamsi_date[2];


        $user_id = $request->input('id');

        //get answer data
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
            if ($lend) {
                if ($lend)
                    $products[$counter]->is_loaned = ($lend->is_returned == 0) ? 1 : 0;
            } else {
                $products[$counter]->is_loaned = 0;
            }

            for ($i = 0; $i < sizeof($fpp); $i++) {

                $fpp[$i]->value = Crypt::decrypt($fpp[$i]->value);

                $fpp[$i]->good_property->name = Crypt::decrypt($fpp[$i]->good_property->name);

            }

            $products[$counter]->products = $fpp;

            $counter += 1;

        }

        for ($i = 0; $i < sizeof($products); $i++) {
            $products[$i]->good->name = Crypt::decrypt($products[$i]->good->name);
        }


        date_default_timezone_set('Asia/Tehran');
        $current_time = date('h:i:s');

        return view('admin.answer.invoice-print', compact('shamsi_date', 'user', 'products', 'current_time'));
    }

    public function allInvoice(Request $request)
    {
        $date_helper = new GorGianToJalai();

        $shamsi_date = $date_helper->gregorian_to_jalali(date('Y'), date('m'), date('d'), "");
        $shamsi_date = $shamsi_date[0] . "/" . $shamsi_date[1] . "/" . $shamsi_date[2];


        //get answer data
        $employees = Employee::get();

        $profiles = array();
        $profiles_products = array();

        foreach ($employees as $employee) {
            $user = new \stdClass();
            $user->name = Crypt::decrypt($employee->name);
            $user->last_name = Crypt::decrypt($employee->last_name);
            $user->part = Crypt::decrypt($employee->part->name);
            $user->store = Crypt::decrypt(Store::where('id', $employee->part->store_id)->first()->name);

            array_push($profiles, $user);

            //get products
            $products_model = json_encode(Product::
            select('id', 'good_id', 'property_number',)
                ->where('employee_id', $employee->id)
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
                if ($lend) {
                    if ($lend)
                        $products[$counter]->is_loaned = ($lend->is_returned == 0) ? 1 : 0;
                } else {
                    $products[$counter]->is_loaned = 0;
                }

                for ($i = 0; $i < sizeof($fpp); $i++) {

                    $fpp[$i]->value = Crypt::decrypt($fpp[$i]->value);

                    $fpp[$i]->good_property->name = Crypt::decrypt($fpp[$i]->good_property->name);

                }

                $products[$counter]->products = $fpp;

                $counter += 1;

            }

            for ($i = 0; $i < sizeof($products); $i++) {
                $products[$i]->good->name = Crypt::decrypt($products[$i]->good->name);
            }

            array_push($profiles_products, $products);
        }

        date_default_timezone_set('Asia/Tehran');
        $current_time = date('h:i:s');


        return view('admin.answer.all-invoice-print', compact('shamsi_date',  'current_time','profiles_products','profiles'));
    }

}

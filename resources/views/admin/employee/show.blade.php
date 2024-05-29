@php use Illuminate\Support\Facades\Crypt; @endphp
@extends('admin.layouts.master')

<script src="{{ asset('js/jq.js') }} "></script>

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-primary">

        <!-- card-header -->
        <div class="card-header d-flex justify-content-between" style="background-color: #486551">
            <h3 class="card-title">اطلاعات جنس</h3>

        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body" id="card">

                <div class="row d-flex justify-content-between">
                    <label for="good_id" style="color: gray; margin-right: 20px">نام شخص :</label>

{{--                    <form role="form" method="get" action="{{ route('invoice-print') }}"--}}
{{--                          enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        @method('GET')--}}
{{--                        <button type="submit" class="btn btn-primary pull-left"--}}
{{--                                style="alignment: left; background-color: #0077ff !important; border-color: #0077ff; width: 150px; border-radius: 10px">--}}
{{--                            چاپ--}}
{{--                        </button>--}}
{{--                    </form>--}}

                    <a href="{{ route('invoice-print', ['id' => $user->id]) }}" class="btn btn-primary pull-left" >چاپ</a>

                </div>
                <div class="row">
                    <label for="good_id"
                           style="color: #001A41; font-size: 40px;  margin-right: 20px">{{ $user->name . " " . $user->last_name }}</label>
                </div>


                <div class="row">
                    <label for="good_id" style="color: gray; margin-right: 20px; margin-top: 30px">کالاهای این شخص
                        :</label>
                </div>

                @if(sizeof($products) != 0)
                    <div class="row">
                        @foreach ($products as $product)

                            <div class="col-md-4">

                                <div class="card card-success">

                                    <div class="card-header d-flex justify-content-between">
                                        <h3 class="card-title">{{ $product->good->name }}</h3>
                                        <h3 class="card-title">شماره اموال : {{ $product->property_number }}</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        @foreach ($product->products as $feature)
                                            <div class="row">
                                                <p>{{ $feature->good_property->name . " : " . $feature->value . "\n" }}</p>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="card-footer">
                                        <form action="{{ route('products.sendToNotAssign',['product' => $product->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" value="ارسال به انبار کل" class="btn btn-info">ارسال به انبار کل</button>
                                        </form>
                                        <form action="{{ route('products.sendToScraps',['product' => $product->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" value="ارسال به انبار اسقاطی"  class="btn btn-danger">ارسال به انبار اسقاطی</button>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <!-- /.card -->

                            </div>

                        @endforeach
                    </div>
                @endif


            </div>
            <!-- /.card-body -->

        </form>
    </div>
@endsection






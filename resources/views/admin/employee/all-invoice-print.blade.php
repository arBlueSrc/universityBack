@php use Illuminate\Support\Facades\Crypt; @endphp
@extends('admin.layouts.master')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- <body onload="window.print();">--}}


    @foreach($profiles as $key=>$user)

        @php
            $size = round(sizeof($profiles_products[$key])/15);
            if ($size == 0){
                $size = 1;
            }
        @endphp

        <div class="A4" style="height: {{$size*36}}cm;">
            <!-- Main content -->
            <!-- Main content -->
            <div class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-10">
                        <img class="qr-back" src="<?php echo e(asset('assets/images/logo.png')); ?>"/>
                    </div>
                    <div class="col-2">


                        <h7 class="text-left">تاریخ چاپ: {{ $shamsi_date }}</h7>
                        <br>
                        <h7 class="text-left">ساعت چاپ: {{ $current_time }}</h7>
                        <br>
                        <h7 class="text-left">صفحه : {{ $size }}</h7>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <h3>{{ $user->name . " " . $user->last_name }}</h3>
                            <h4> بخش {{ $user->part }}</h4>
                            <h4> انبار {{ $user->store }}</h4>
                            <br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col" hidden>
                        به
                        <address>
                            <strong>محمدحسن قلی</strong><br>
                            آدرس خریدار<br>
                            خیابان فلان<br>
                            تلفن : (555) 539-1037<br>
                            ایمیل : john.doe@example.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col" hidden>
                        <b>سفارش #007612</b><br>
                        <br>
                        <b>کد سفارش :</b> 4F3S8J<br>
                        <b>تاریخ پرداخت :</b> 12 آبان 1397<br>
                        <b>اکانت :</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">محصول</th>
                                <th class="text-center">شماره اموال</th>
                                <th class="text-center">جزئیات اموال</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles_products[$key] as  $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->good->name }}</td>
                                    <td>{{ $product->property_number }}</td>
                                    <td>
                                        @foreach ($product->products as $feature)
                                            {{ $feature->good_property->name . " : " . $feature->value . "\n" }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row" style="margin-top: 30px">
                    <!-- accepted payments column -->

                    <div class="col-5">
                        <p class="lead">امضای {{ $user->name . " " . $user->last_name . " : " }} </p>
                    </div>

                    <div class="col-4">
                        <p class="lead">امضای تحویل دهنده : </p>
                    </div>

                    <div class="col-3">
                        <p class="lead">امضای مدیر عامل : </p>
                    </div>

                    <div class="col-6" hidden>
                        <p class="lead">روش های پرداخت :</p>
                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            پرداخت از طریق کلیه کارت های بانکی عضو شتاب امکان پذیر می باشد.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6" hidden>
                        <p class="lead">مهلت پرداخت : 10 دی 1397</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">مبلغ کل :</th>
                                    <td>1,300,000 تومان</td>
                                </tr>
                                <tr>
                                    <th>مالیات (9.3%)</th>
                                    <td>300,000 تومان</td>
                                </tr>
                                <tr>
                                    <th>تخفیف :</th>
                                    <td>20,000 تومان</td>
                                </tr>
                                <tr>
                                    <th>مبلغ قابل پرداخت:</th>
                                    <td>900,000 تومان</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.content -->
        </div>

    @endforeach

    <!-- ./wrapper -->
    </body>

    <style>
        @media print {
            * {
                color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background: #FFFFFF;
        }

        .table-striped tbody tr:nth-of-type(odd) td {
            background-color: rgba(100, 100, 100, .25) !important;
        }

        th, td {
            border-color: black !important;
            border: 2px solid black;
        }

        .A4 {
            width: 26cm;
            /*height: 36cm;*/
            margin-bottom: 4rem;
            background: #FFFFFF;
        }
    </style>

@endsection

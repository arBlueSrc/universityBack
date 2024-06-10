@php use Illuminate\Support\Facades\Crypt; @endphp
@extends('admin.layouts.master')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">لیست پرسشنامه ها</h3>

{{--                        <div class="row">--}}

{{--                            <a href="{{ route('allInvoice') }}" class="btn btn-sm btn-success ml-1">چاپ لیست--}}
{{--                                اموال همه ی پرسنل</a>--}}

{{--                        </div>--}}

                    </div>

                </div>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-bordered table-responsive p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>شغل</th>
                        <th>شماره تماس</th>
                        <th>۱</th>
                        <th>۲</th>
                        <th>۳</th>
                        <th>۴</th>
                        <th>۵</th>
                        <th>۶</th>
                        <th>۷</th>
                        <th>۸</th>
                        <th>۹</th>
                        <th>۱۰</th>
                        <th>۱۱</th>
                        <th>۱۲</th>
                        <th>۱۳</th>
                        <th>۱۴</th>
                        <th>۱۵</th>
                        <th>۱۶</th>
                        <th>۱۷</th>
                        <th>۱۸</th>
                        <th>۱۹</th>
                        <th>۲۰</th>
                        <th>۲۱</th>
                        <th>۲۲</th>
                        <th>۲۳</th>
                        <th>۲۴</th>
                        <th>۲۵</th>
                        <th>۲۶</th>
                        <th>۲۷</th>
                        <th>۲۸</th>
                        <th>۲۹</th>
                        <th>۳۰</th>
                        <th>۳۱</th>
                        <th>۳۲</th>
                    </tr>
                    @foreach ($userAnswer as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->job }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->answer["1"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["2"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["3"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["4"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["5"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["6"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["7"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["8"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["9"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["10"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["11"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["12"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["13"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["14"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["15"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["16"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["17"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["18"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["19"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["20"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["21"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["22"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["23"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["24"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["25"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["26"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["27"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["28"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["29"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["30"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["31"]->rate  ?? "" }}</td>
                            <td>{{ $item->answer["32"]->rate ?? ""  }}</td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $userAnswer->appends(['search' => request('search')])->render() }}
            </div>
        </div>
        <!-- /.card -->

    </div>
    </div>
@endsection

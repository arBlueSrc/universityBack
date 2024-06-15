@php use Illuminate\Support\Facades\Crypt; @endphp
@extends('admin.layouts.master')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <script type="text/javascript" src="{{ asset('dist/js/tableToExcel.js') }}"></script>

    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">لیست پرسشنامه ها</h3>

                        <div class="row">

                            <a onclick="clicked()" class="btn btn-sm btn-success ml-1">خروجی اکسل</a>

                            <script>
                                function clicked(){
                                    TableToExcel.convert(document.getElementById("table1"));
                                }
                            </script>


                        </div>

                    </div>

                </div>

            </div>


            <!-- /.card-header -->
            <div class="card-body table-bordered table-responsive p-0">
                <table class="table table-hover" id="table1">
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
                            <td>{{ \App\Models\Answer::where('question', 1)->where('user_id',$item->id)->first()->rate ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 2)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 3)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 4)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 5)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 6)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 7)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 8)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 9)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 10)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 11)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 12)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 13)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 14)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 15)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 16)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 17)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 18)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 19)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 20)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 21)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 22)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 23)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 24)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 25)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 26)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 27)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 28)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 29)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 30)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 31)->where('user_id',$item->id)->first()->rate  ?? "" }}</td>
                            <td>{{ \App\Models\Answer::where('question', 32)->where('user_id',$item->id)->first()->rate ?? ""  }}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
            <!-- /.card-body -->
{{--            <div class="card-footer">--}}
{{--                {{ $userAnswer->appends(['search' => request('search')])->render() }}--}}
{{--            </div>--}}
        </div>
        <!-- /.card -->

    </div>
    </div>
@endsection

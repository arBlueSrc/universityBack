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
                        <h3 class="card-title">لیست پرسنل</h3>

                        <div class="row">
                            <a href="{{ route('allQrCode') }}" class="btn btn-sm btn-success ml-1">چاپ همه ی کد ها</a>

                            <a href="{{ route('allInvoice') }}" class="btn btn-sm btn-success ml-1">چاپ لیست
                                اموال همه ی پرسنل</a>

                        </div>

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
                        <th>نام خانوادگی</th>
                        <th>انبار</th>
                        <th>بخش</th>
                        <th>چاپ QR CODE</th>
                        <th>نمایش</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ Crypt::decrypt($employee->name) }}</td>
                            <td>{{ Crypt::decrypt($employee->last_name) }}</td>
                            <td>{{ Crypt::decrypt($employee->part->store->name) }}</td>
                            <td>{{ Crypt::decrypt($employee->part->name) }}</td>

                            <td>
                                <a href="{{ route('qrcode', ['user_id' => $employee->id]) }}">
                                    <ion-icon name="qr-code"></ion-icon>
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('employee.show', ['employee' => $employee->id]) }}">
                                    <ion-icon name="eye"></ion-icon>
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('employee.edit', ['employee' => $employee->id]) }}">
                                    <ion-icon name="create"></ion-icon>
                                </a>
                            </td>

                            <td class="d-flex">
                                <form action="{{ route('employee.destroy', ['employee' => $employee->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="completed-task" style="background: none;
                                                                                              padding: 0px;
                                                                                              border: none;">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $employees->appends(['search' => request('search')])->render() }}
            </div>
        </div>
        <!-- /.card -->

    </div>
    </div>
@endsection

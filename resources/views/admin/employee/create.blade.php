@extends('admin.layouts.master')
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
        <div class="card-header" style="background-color: #486551">
            <h3 class="card-title">افزودن پرسنل</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body" id="card">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="نام را وارد کنید">
                    </div>

                    <div class="form-group col-6">
                        <label for="last_name">نام خانوادگی</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               placeholder="نام خانوادگی را وارد کنید">
                    </div>
                </div>

                <div class="row col-6" style="margin-top: 10px">
                    <label for="part">بخش مربوطه را انتخاب کنید</label>
                    <select name="part" id="part" class="form-control">
                        @foreach ($parts as $part)
                            <option value="{{ $part->id }}" {{ $loop->first ? 'selected="selected"' : '' }}>
                                {{ \Illuminate\Support\Facades\Crypt::decrypt($part->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-left"
                        style="alignment: left; background-color: #006D3F !important; border-color: #006D3F; width: 150px; border-radius: 10px">
                    ذخیره
                </button>
            </div>

        </form>
    </div>
@endsection



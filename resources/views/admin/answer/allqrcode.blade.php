@php use Illuminate\Support\Facades\Crypt; @endphp
    <!DOCTYPE html>
<html dir="rtl">
<head>
    <title>QR code Generator</title>
</head>
<body>

@foreach($users as $user)

<div class="row">
        <div class="col-4">
            <div class="parent">
                <img class="qr-back" src="{{ asset('assets/images/qr-back.png') }}"/>

                <img class="image1"
                     src="{{ "https://chart.googleapis.com/chart?cht=qr&chl=".$user->en_id."&chs=120x120&chld=L|0" }}"
                     src=""
                     class="qr-code img-thumbnail img-responsive"/>

                <p class="name" media="print" rel="stylesheet">{{ Crypt::decrypt($user->name) . " " . Crypt::decrypt($user->last_name) }}</p>
            </div>
        </div>
</div>

@endforeach

</body>
</html>

<style>

    @font-face {
        font-family: Vazir;
        src: url('/dist/fonts/Vazir.ttf');
        font-weight: bold;
    }

    .qr-back {
        position: relative;
        width: 5cm;
        margin: 10px;
    }

    .parent {
        width: 10cm;
        position: relative;
        top: 0;
        right: 0;
    }

    .image1 {
        position: absolute;
        top: 10mm;
        right: 11.5mm;
    }

    .name {
        position: absolute;
        max-width: 40mm;
        top: 46mm;
        right: 10mm;
        fill: white;
        font-family: 'Vazir', serif;
    }

    @media print and (-webkit-min-device-pixel-ratio: 0) {
        p {
            color: black;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

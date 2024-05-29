<!DOCTYPE html>
<html dir="rtl">
    <head>
        <title>QR code Generator</title>
    </head>
<body>

<div class="parent">

    <img class="qr-back" src="{{ asset('assets/images/qr-back.png') }}"/>

    <img class="image1"
        src="{{ "https://quickchart.io/qr?text=".$en_id."&size=120" }}"
         src=""
        class="qr-code img-thumbnail img-responsive"/>

    <p class="name" media="print" rel="stylesheet">{{ $username }}</p>

</div>

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

    @media print and (-webkit-min-device-pixel-ratio:0) {
        p {
            color: black;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

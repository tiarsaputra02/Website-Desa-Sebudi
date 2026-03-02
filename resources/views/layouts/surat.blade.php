<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Surat</title>

    <style>
        /* SETTING KERTAS */
        @page {
            size: A4;
            margin: 25mm 30mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
        }

        .page {
            width: 100%;
        }

        .kop {
            text-align: center;
        }

        .kop h4 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .kop p {
            margin: 4px 0;
        }

        .line {
            border-top: 3px solid #000;
            margin-top: 6px;
        }

        .line-thin {
            border-top: 1px solid #000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="page">

    <div class="kop">
        <h4>PEMERINTAH DESA SEBUDI</h4>
        <p>Kecamatan Selat, Kabupaten Karangasem</p>
        <div class="line"></div>
        <div class="line-thin"></div>
    </div>

    {{-- ISI SURAT --}}
    @yield('content')

</div>

</body>
</html>


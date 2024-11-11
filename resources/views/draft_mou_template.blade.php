<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MoU Draft</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.5;
        }

        /* Styling header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 70px;
            width: auto;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            margin-top: 5px;
        }

        /* Paragraph styling */
        p {
            margin: 5px 0;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .list-item {
            margin-left: 20px;
            line-height: 1.5;
        }

        .numbered-list {
            margin: 10px 0;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <img src="{{ asset('path/to/logo.png') }}" alt="Logo Perusahaan">
        <div class="title">PT. INDONESIA LESTARI GROUP</div>
        <div class="subtitle">JASA TRANSPORTASI LIMBAH MEDIS B3<br>NIB 2401220067743</div>
    </div>

    <!-- Document Title -->
    <h2 style="text-align: center; text-decoration: underline;">PERJANJIAN KERJASAMA JASA TRANSPORTIR
        (PENGANGKUTAN)<br>LIMBAH MEDIS B3</h2>
    <p style="text-align: center;">............................ (KOTA) DENGAN PT. INDONESIA LESTARI GROUP</p>
    <p style="text-align: center;">No: .............. /ILG/KKS- /I/2024</p>

    <!-- Content Section -->
    <p>Perjanjian kerja sama jasa transportasi (Pengangkutan) limbah medis antara “..........................” dengan
        “PT. INDONESIA LESTARI GROUP” dibuat di Kota ............ dan ditanda tangani pada hari … tanggal … bulan …
        tahun … antara:</p>

    <ol class="numbered-list">
        <li>
            <p>..................... di Kota ........ sebagai "PIHAK PERTAMA"</p>


            <p>Nama :{{ $mou->customer->name }}</p>
            <p>NIK : {{ $mou->customer->nik }}</p>
            <p>SIP/STR : {{ $mou->customer->str_sip }}</p>
            <p>NPWP : {{ $mou->customer->npwp }}</p>
            <p>Alamat Praktek : {{ $mou->customer->address }}.</p>
            </div>

        </li>
        <li>
            <p><strong>PT. INDONESIA LESTARI GROUP</strong> sebagai "PIHAK KEDUA" Pengangkut limbah medis B3 dalam hal
                ini diwakili oleh <strong>BUDI NURAF PERDANA</strong>, SE selaku Manager...</p>
        </li>
    </ol>

    <p><strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> secara masing-masing disebut "PIHAK"...</p>

    <!-- Section Title -->
    <div class="section-title">PASAL 1</div>
    <p class="section-title">POKOK PERJANJIAN</p>

    <p class="list-item">"PIHAK PERTAMA" sebagai penghasil limbah B3 dengan ini menunjuk "PIHAK KEDUA"...</p>

    <!-- Footer -->
    <div class="footer">
        <p>PT. INDONESIA LESTARI GROUP - MoU Draft</p>
    </div>
</body>

</html>

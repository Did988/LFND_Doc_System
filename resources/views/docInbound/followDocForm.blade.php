<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ໃບຕິດຕາມເອກະສານ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.cdnfonts.com/css/phetsarath?styles=19638,19637" rel="stylesheet">

    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@400;700&display=swap" rel="stylesheet"> --}}
    <style>
        /* @font-face {
            font-family: 'LaoNoto';
            src: url("{{ asset('storage/fonts/NotoSansLao-Bold.ttf') }}") format('truetype');
        } */
        /* @font-face {
            font-family: 'LaoNotos';
            src: url("{{ storage_path('fonts/NotoSansLao-Bold.ttf') }}") format('truetype');
        } */
        @font-face {
            font-family: 'PhetsarathOT';
            src: url("{{ public_path('fonts/Phetsarath_OT.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'TimesnewRoman';
            font-weight: normal;
            font-style: normal;
            src: url("{{ public_path('fonts/times.ttf') }}") format('truetype');
        }

        /* @font-face {
            font-family: 'Phetsarath';
            src: url({{ storage_path('fonts/Phetsarath_OT.ttf') }}) format("truetype");
            font-weight: 400; // use the matching font-weight here ( 100, 200, 300, 400, etc).
            font-style: normal; // use the matching font-style here
        } */

        @page {
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-right: 2cm;
            margin-left: 3cm
        }



        .laoFont {
            /* font-family: 'Phetsarath'; */
            font-family: 'PhetsarathOT';
                                                
            /* font-family: 'Noto Sans Lao', sans-serif; */
            font-weight: 700;
            font-size: 12pt;
        }

        .engFont {
            font-family: 'TimesnewRoman';
            font-size: 12pt;
        }

        /* .page {
            width: 21cm;
            height: 29.7cm;
            margin: 2cm 2cm 2cm 3cm;
            /* change the margins as you want them to be. */
        /* border-style: solid;
        border-color: black; */
        }

        .normal-text {
            text-align: center
        }

        .Logo {
            width: 2cm;
            display: block;
            margin-left: auto;
            margin-right: auto;

        }

        .space {
            height: 0.2cm;
        }

        .title {
            font-size: 14pt;
            text-align: center;
        }

        .space-1 {
            height: 12pt;
        }

        .tab-2 {
            margin-left: 1.25cm
        }

        .center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
        }


        table {
            border-collapse: collapse;
            width: 100%;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .signature {
            font-weight: bold;
            margin-right: 1.27cm;
        }

        .grid_container {
            display: grid;
            grid-template-columns: auto auto;

        }

        .no_border {
            border: none;
        }

        .SigRight {
            text-align: right;
            padding-right: 1cm;
        }

        table,
        tr,
        .tb_head {
            height: 50px;

        }

        table,
        .tb_detail {
            height: 180px;
        }
    </style>


</head>



<body class="laoFont">
    <div class="page">
        <div class="center">
            <img class="Logo"src="<?php echo $pic; ?>" alt="">
        </div>

        <div class="space"></div>
        <div class="normal-text center laoFont">
            <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
            <p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</p>
        </div>
        <div class="space-1"></div>
        <div class="normal-text center laoFont">
            <p class="title" style="font-weight: bold;">ໃບຕິດຕາມເອກະສານ</p>

            @foreach ($info ?? '' as $item)
                <p>ເອກະສານເຂົ້າເລກທີ: {{ $item->doc_Id }} ລົງວັນທີ
                    {{ date('ວັນທີ d ເດືອນ m  ປີ Y', strtotime($item->date)) }}</p>
                <p class="left tab-2">ຮຽນ: {{ $item->dear }}</p>
                <p class="left tab-2">ເລື່ອງ: {{ $item->title }}</p>
            @endforeach
            <p class="space-1"></p>
            <table>
                <tr>
                    <th class="tb_head" style="border-bottom-style:none">ຄຳເຫັນຫົວໜ້າການຈັດຕັ້ງ</th>
                    <th class="tb_head" style="weight:60%">ຄຳເຫັນຜູ້ພິຈາລະນາ</th>
                </tr>
                <tr>
                    <td class="tb_detail"></td>
                    <td class="tb_detail"></td>
                </tr>
            </table>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

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

        /* @font-face {
            font-family: 'TimesnewRoman';
            font-weight: normal;
            font-style: normal;
            src: url("{{ public_path('fonts/times.ttf') }}") format('truetype');
        }

        @font-face {
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
            font-family: 'PhetsarathOT';
            font-size: 12pt;
        }

        .engFont {
            font-family: 'TimesnewRoman' !important;
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
            font-weight: bold;
            text-align: center;
        }

        .space-1 {
            height: 12pt;
        }

        .tab-2 {
            margin-left: 2.54cm
        }

        .center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid black;
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
        table,.tb_head{
            height: 50px;
        }
        table,.tb_detail{
            height: 25px;
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
        <table class="no_border">

            <tr class="no_border">
                <th scope="col" class="left no_border">
                    @foreach ($depart as $item)
                        {{ $item->department_Name }}
                    @endforeach
                </th>
                <th scope="col" class="right no_border">
                    @foreach ($outDocDetail ?? '' as $item)
                        ເລກທີ {{ $item->outbound_Detail_Id }} / {{ $sortDepart }}
                    @endforeach
                </th>
            </tr>
            <tr class="no_border">
                <th scope="col" class="left no_border">
                    ສູນກາງແນວລາວສ້າງຊາດ
                </th>
                <th scope="col" class="right no_border">
                    @foreach ($outDocDetail ?? '' as $item)
                        {{ date('ວັນທີ d ເດືອນ m  ປີ Y', strtotime($item->date)) }}
                    @endforeach
                </th>
            </tr>

        </table>

        <div class="space-1"></div>
        <div class="title">ສະໂໜດນຳສົ່ງ</div>
        <div class="space-1"></div>
        <div class="tab-2">
            @foreach ($outDocDetail ?? '' as $item)
                <p>ຮຽນ : {{ $item->send_to }}</p>
                <p>ເລື່ອງ: {{ $item->title }}</p>
            @endforeach
        </div>
        <div class="space-1"></div>
        <div class="title">ເອກະສານທີ່ສົ່ງມາປະກອບມີ:</div>
        <div class="space-1"></div>
        <div class="">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="tb_head">ລຳດັບ</th>
                        <th scope="col" class="tb_head">ຊື່ ແລະ ເນື້ອໃນຫຍໍ້ເອກະສານ</th>
                        <th scope="col" class="tb_head">ຈຳນວນ</th>
                        <th scope="col" class="tb_head">ຈຸດປະສົງ</th>
                        <th scope="col" class="tb_head">ໝາຍເຫດ</th>
                    </tr>
                </thead>
                @foreach ($docOut ?? '' as $item)
                    <tr>

                        <td scope="col" class="tb_detail">{{ $loop->iteration }}</td>
                        <td scope="col" class="tb_detail" style="text-align: left">{{ $item->title }}</td>
                        <td scope="col" class="tb_detail">{{ $item->doc_quantity }}</td>
                        <td scope="col" class="tb_detail">{{ $item->doc_purpose }}</td>
                        <td scope="col" class="tb_detail"></td>

                    </tr>
                @endforeach
            </table>
        </div>
        <div class="space-1"></div>
        <div class="space-1"></div>
        <table class="no_border">

            <tr class="no_border">
                <th scope="col" class="no_border SigRight">
                    ຫົວໜ້າຫ້ອງການ
                </th>

            </tr>
            


        </table>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

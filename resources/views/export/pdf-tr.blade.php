<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Cabin', sans-serif;
        }
        .title{
            padding: 20px;
        }
        .divider{
            background: linear-gradient(to right, #000000 0%, #003c8b 50%, #000000 100%);
            height: 3px;
        }
        .info tr th{
            padding: 0 20px 0 20px;
        }
        .box-info{
            padding: 20px;
            border: 1px dashed grey;
        }
        
    </style>
</head>
<body>
    <center>
        <img src="{{ asset('simulasi/Logobisma.png') }}" width="200">
    </center>
    
    <div class="row d-flex justify-content-center box-info">
        <div class="row col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
            <table class="info">
                <tr>
                    <th>OTR</th>
                    <th id="otr"></th>
                </tr>
                <tr>
                    <th>Down Payment</th>
                    <th id="dp"></th>
                </tr>
                <tr>
                    <th>Bunga</th>
                    <th id="bunga"></th>
                </tr>
                <tr>
                    <th>Admin</th>
                    <th id="admin"></th>
                </tr>
                <div class="tbangsuran d-sm-none d-md-block">
                    <tr>
                        <th colspan="2">Angsuran ke-1 All Tenor</th>
                    </tr>
                    <tr>
                        <th>12 Bulan</th>
                        <th id="angsuran12"></th>
                    </tr>
                    <tr>
                        <th>24 Bulan</th>
                        <th id="angsuran24"></th>
                    </tr>
                    <tr>
                        <th>36 Bulan</th>
                        <th id="angsuran36"></th>
                    </tr>
                    <tr>
                        <th>48 Bulan</th>
                        <th id="angsuran48"></th>
                    </tr>
                </div>
            </table>
        </div>
        
        <div class="row col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
            <table class="info">
                <tr>
                    <th colspan="2">Angsuran ke-1 All Tenor</th>
                </tr>
                <tr>
                    <th>12 Bulan</th>
                    <th id="angsuran12"></th>
                </tr>
                <tr>
                    <th>24 Bulan</th>
                    <th id="angsuran24"></th>
                </tr>
                <tr>
                    <th>36 Bulan</th>
                    <th id="angsuran36"></th>
                </tr>
                <tr>
                    <th>48 Bulan</th>
                    <th id="angsuran48"></th>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        })

        let ot = localStorage.getItem("otrTr");
        let d = localStorage.getItem("dpTr");
        let ad = localStorage.getItem("adminTr");
        let bunga = localStorage.getItem("bungaTr")*100;
        let admin = formatter.format(ad);
        let otr = formatter.format(ot);
        let dp = formatter.format(d);
        let angsuran12 = localStorage.getItem("rupiahTr12");
        let angsuran24 = localStorage.getItem("rupiahTr24");
        let angsuran36 = localStorage.getItem("rupiahTr36");
        let angsuran48 = localStorage.getItem("rupiahTr48");

        document.getElementById("otr").innerHTML = otr;
        document.getElementById("dp").innerHTML = dp;
        document.getElementById("bunga").innerHTML = `${bunga}%`;
        document.getElementById("admin").innerHTML = admin;
        document.getElementById("angsuran12").innerHTML = angsuran12;
        document.getElementById("angsuran24").innerHTML = angsuran24;
        document.getElementById("angsuran36").innerHTML = angsuran36;
        document.getElementById("angsuran48").innerHTML = angsuran48;
    </script>
</body>
</html>
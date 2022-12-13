<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            font-family: 'Signika Negative', sans-serif;
        }
        .title{
            padding: 20px;
        }
        .divider{
            background: linear-gradient(to right, #000000 0%, #003c8b 50%, #000000 100%);
            height: 2px;
        }
        .info tr th{
            padding: 0 20px 0 20px;
        }
        .info-text{
            text-align: center;
        }

        table{
            width: 500px;
        }
        
        table tr th,
        table tr td{
            border: 1px solid grey;
            padding-left: 5px;
        }

        table tr th{
            background-color: #1b9ae3;
            color: #ffffff;
        }

        #myBtn {
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #1b9ae3;
            color: white;
            cursor: pointer;
            padding: 12px 15px 15px 15px;
            border-radius: 50px;
            width: 150px;
            height: 50px;
        }

        #myBtn:hover {
            background-color: #555;
        }

        label{
            padding: 5px 10px;
            border-radius: 10px;
            border: 1px solid #1b9ae3;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" id="myBtn" title="Go to top"><i class="fa fa-print"></i> Print</button>

    <center>
        <img src="{{ asset('simulasi/Logobisma.png') }}" width="200">
    </center>
    
    <br>
    <div class="divider"></div>
    <br>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 info-text">
            <label for="">OTR</label>
            <p id="otr"></p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 info-text">
            <label for="">Down Payment</label>
            <p id="dp"></p>
        </div>
    </div>
    
    <div class="divider"></div>
    <br>

    <div class="row d-flex justify-content-center">
        <h2 id="unit"></h2>
    </div>

    <br>
    <div class="divider"></div>
    <br>

    <div class="row d-flex justify-content-center">
        <table>
            <tbody>
                <tr>
                    <td>12 Bulan</td>
                    <td><span id="angsuran12"></span></td>
                </tr>
                <tr>
                    <td>24 Bulan</td>
                    <td><span id="angsuran24"></span></td>
                </tr>
                <tr>
                    <td>36 Bulan</td>
                    <td><span id="angsuran36"></span></td>
                </tr>
                <tr>
                    <td>48 Bulan</td>
                    <td><span id="angsuran48"></span></td>
                </tr>
                <tr>
                    <td>60 Bulan</td>
                    <td><span id="angsuran60"></span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        })

        let angsuran12 = localStorage.getItem("rupiahTp12");
        let angsuran24 = localStorage.getItem("rupiahTp24");
        let angsuran36 = localStorage.getItem("rupiahTp36");
        let angsuran48 = localStorage.getItem("rupiahTp48");
        let angsuran60 = localStorage.getItem("rupiahTp60");
        let otr = localStorage.getItem("otrTp");
        let dp = localStorage.getItem("dpTp");
        let unit = localStorage.getItem("unitTp");

        document.getElementById("angsuran12").innerHTML = angsuran12;
        document.getElementById("angsuran24").innerHTML = angsuran24;
        document.getElementById("angsuran36").innerHTML = angsuran36;
        document.getElementById("angsuran48").innerHTML = angsuran48;
        document.getElementById("angsuran60").innerHTML = angsuran60;
        document.getElementById("otr").innerHTML = otr;
        document.getElementById("dp").innerHTML = dp;
        document.getElementById("unit").innerHTML = unit;
    </script>
</body>
</html>
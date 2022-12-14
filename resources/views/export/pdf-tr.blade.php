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
            width: 100%;
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
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">OTR</label>
            <p id="otr"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">Down Payment</label>
            <p id="dp"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">Bunga</label>
            <p id="bunga"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">Admin</label>
            <p id="admin"></p>
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
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">12 Bulan</label>
            <p id="angsuran12" hidden></p>
            <p>Angsuran Pertama</p>
            <p id="pokok12"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">24 Bulan</label>
            <p id="angsuran24" hidden></p>
            <p>Angsuran Pertama</p>
            <p id="pokok24"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">36 Bulan</label>
            <p id="angsuran36" hidden></p>
            <p>Angsuran Pertama</p>
            <p id="pokok36"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">48 Bulan</label>
            <p id="angsuran48" hidden></p>
            <p>Angsuran Pertama</p>
            <p id="pokok48"></p>
        </div>
    </div>

    <br>
    <div class="divider"></div>
    <br>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">12 Bulan</label>
            <p id="angsuran12" hidden></p>
            <p>Asuransi</p>
            <p id="asuransi12"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">24 Bulan</label>
            <p id="angsuran24" hidden></p>
            <p>Asuransi</p>
            <p id="asuransi24"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">36 Bulan</label>
            <p id="angsuran36" hidden></p>
            <p>Asuransi</p>
            <p id="asuransi36"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">48 Bulan</label>
            <p id="angsuran48" hidden></p>
            <p>Asuransi</p>
            <p id="asuransi48"></p>
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
        let bunga = localStorage.getItem("bungaTr");
        let bungap = bunga*100;
        let bungapersen = bungap.toFixed(2);
        let admin = formatter.format(ad);
        let otr = formatter.format(ot);
        let dp = formatter.format(d);
        let angsuran12 = localStorage.getItem("rupiahTr12");
        let angsuran24 = localStorage.getItem("rupiahTr24");
        let angsuran36 = localStorage.getItem("rupiahTr36");
        let angsuran48 = localStorage.getItem("rupiahTr48");
        let ass12 = localStorage.getItem("rateAssTr12")*ot;
        let ass24 = localStorage.getItem("rateAssTr24")*ot;
        let ass36 = localStorage.getItem("rateAssTr36")*ot;
        let ass48 = localStorage.getItem("rateAssTr48")*ot;
        let unit = localStorage.getItem("unitTr");

        let asuransi12 = formatter.format(ass12);
        let asuransi24 = formatter.format(ass24);
        let asuransi36 = formatter.format(ass36);
        let asuransi48 = formatter.format(ass48);

        let countsph12 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass12);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass12}`)
        let countpokok12 = countsph12/12;
        let pokok12 = countpokok12.toFixed(0);
        let pokok12_rp = formatter.format(pokok12);

        let countsph24 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass24);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass24}`)
        let countpokok24 = countsph24/24;
        let pokok24 = countpokok24.toFixed(0);
        let pokok24_rp = formatter.format(pokok24);

        let countsph36 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass36);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass36}`)
        let countpokok36 = countsph36/36;
        let pokok36 = countpokok36.toFixed(0);
        let pokok36_rp = formatter.format(pokok36);

        let countsph48 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass48);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass48}`)
        let countpokok48 = countsph48/48;
        let pokok48 = countpokok48.toFixed(0);
        let pokok48_rp = formatter.format(pokok48);

        sessionStorage.setItem("p12_1", pokok12_rp);
        sessionStorage.setItem("p24_1", pokok24_rp);
        sessionStorage.setItem("p36_1", pokok36_rp);
        sessionStorage.setItem("p48_1", pokok48_rp);
        document.getElementById("pokok12").innerHTML = sessionStorage.getItem("p12_1");
        document.getElementById("pokok24").innerHTML = sessionStorage.getItem("p24_1");
        document.getElementById("pokok36").innerHTML = sessionStorage.getItem("p36_1");
        document.getElementById("pokok48").innerHTML = sessionStorage.getItem("p48_1");

        document.getElementById("otr").innerHTML = otr;
        document.getElementById("dp").innerHTML = dp;
        document.getElementById("bunga").innerHTML = `${bungapersen}%`;
        document.getElementById("admin").innerHTML = admin;
        document.getElementById("angsuran12").innerHTML = angsuran12;
        document.getElementById("angsuran24").innerHTML = angsuran24;
        document.getElementById("angsuran36").innerHTML = angsuran36;
        document.getElementById("angsuran48").innerHTML = angsuran48;
        document.getElementById("unit").innerHTML = unit;

        document.getElementById("asuransi12").innerHTML = asuransi12;
        document.getElementById("asuransi24").innerHTML = asuransi24;
        document.getElementById("asuransi36").innerHTML = asuransi36;
        document.getElementById("asuransi48").innerHTML = asuransi48;
    </script>
</body>
</html>
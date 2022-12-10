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
        .info-text{
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
        <img src="{{ asset('simulasi/Logobisma.png') }}" width="200">
    </center>
    
    <div class="row d-flex justify-content-center box-info">
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

    <div class="row d-flex justify-content-center box-info">
        <h2>Angsuran ke-1 All Tenor</h2>
    </div>

    <div class="row d-flex justify-content-center box-info">
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">12 Bulan</label>
            <p id="angsuran12"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">24 Bulan</label>
            <p id="angsuran24"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">36 Bulan</label>
            <p id="angsuran36"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">48 Bulan</label>
            <p id="angsuran48"></p>
        </div>
    </div>

    <div class="row d-flex justify-content-center box-info">
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <table>
                <thead>
                    <tr>
                        <th>Tenor</th>
                        <th>SPH</th>
                        <th>Bunga</th>
                        <th>Pokok</th>
                        <th>Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">24 Bulan</label>
            <p id="angsuran24"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">36 Bulan</label>
            <p id="angsuran36"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">48 Bulan</label>
            <p id="angsuran48"></p>
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
        let ass12 = localStorage.getItem("rateAssTr12");
        let ass24 = localStorage.getItem("rateAssTr24");
        let ass36 = localStorage.getItem("rateAssTr36");
        let ass48 = localStorage.getItem("rateAssTr48");

        document.getElementById("otr").innerHTML = otr;
        document.getElementById("dp").innerHTML = dp;
        document.getElementById("bunga").innerHTML = `${bunga}%`;
        document.getElementById("admin").innerHTML = admin;
        document.getElementById("angsuran12").innerHTML = angsuran12;
        document.getElementById("angsuran24").innerHTML = angsuran24;
        document.getElementById("angsuran36").innerHTML = angsuran36;
        document.getElementById("angsuran48").innerHTML = angsuran48;

        // Hitung list bunga menurun
        // inisiasi 1
        let sph12 = ot-d+ad+ass12;

        for (let i = 1; i <= 5; i++) {
            if ([i] == 1) {
                let bunga12 = sph12*bunga;
                let pokok12 = sph12/12;
                let angsuran12 = bunga12+pokok12;
            } else {
                let sph12 = sph12 - pokok12;
                let bunga12 = sph12*bunga;
                let pokok12 = sph12/12;
                let angsuran12 = bunga12+pokok12;
            }
            
            sessionStorage.setItem("t12_"[i], [i]);
            sessionStorage.setItem("s12_"[i], sph12);
            sessionStorage.setItem("b12_"[i], bunga12);
            sessionStorage.setItem("p12_"[i], pokok12);
            sessionStorage.setItem("pa2_"[i], angsuran12);
        }

        // bunga12 is not defined
    </script>
</body>
</html>
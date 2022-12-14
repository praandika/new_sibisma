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
            <label for="">12 Bulan</label>
            <p id="angsuran12" hidden></p>
            <p>Pokok Angsuran</p>
            <p id="pokok12"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">24 Bulan</label>
            <p id="angsuran24" hidden></p>
            <p>Pokok Angsuran</p>
            <p id="pokok24"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">36 Bulan</label>
            <p id="angsuran36" hidden></p>
            <p>Pokok Angsuran</p>
            <p id="pokok36"></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <label for="">48 Bulan</label>
            <p id="angsuran48" hidden></p>
            <p>Pokok Angsuran</p>
            <p id="pokok48"></p>
        </div>
    </div>

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
        <!-- Tenor 12 -->
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <table>
                <thead>
                    <tr>
                        <th>Tenor</th>
                        <th>SPH</th>
                        <th>Bunga</th>
                        <th>Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 12; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td style="text-align: left;"><span id="sph12_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="bunga12_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="tenor12_{{ $i }}"></span></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Tenor 24 -->
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <table>
                <thead>
                    <tr>
                        <th>Tenor</th>
                        <th>SPH</th>
                        <th>Bunga</th>
                        <th>Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 24; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td style="text-align: left;"><span id="sph24_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="bunga24_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="tenor24_{{ $i }}"></span></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Tenor 36 -->
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <table>
                <thead>
                    <tr>
                        <th>Tenor</th>
                        <th>SPH</th>
                        <th>Bunga</th>
                        <th>Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 36; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td style="text-align: left;"><span id="sph36_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="bunga36_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="tenor36_{{ $i }}"></span></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Tenor 48 -->
        <div class="col-lg-3 col-md-6 col-sm-12 info-text">
            <table>
                <thead>
                    <tr>
                        <th>Tenor</th>
                        <th>SPH</th>
                        <th>Bunga</th>
                        <th>Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 48; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td style="text-align: left;"><span id="sph48_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="bunga48_{{ $i }}"></span></td>
                        <td style="text-align: left;"><span id="tenor48_{{ $i }}"></span></td>
                    </tr>
                    @endfor
                </tbody>
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

        document.getElementById("otr").innerHTML = otr;
        document.getElementById("dp").innerHTML = dp;
        document.getElementById("bunga").innerHTML = `${bungapersen}%`;
        document.getElementById("admin").innerHTML = admin;
        document.getElementById("angsuran12").innerHTML = angsuran12;
        document.getElementById("angsuran24").innerHTML = angsuran24;
        document.getElementById("angsuran36").innerHTML = angsuran36;
        document.getElementById("angsuran48").innerHTML = angsuran48;
        document.getElementById("unit").innerHTML = unit;

        // Hitung list bunga menurun

        // Tenor 12
            // inisiasi tenor 12
            let countsph12 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass12);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass12}`)
            let countpokok12 = countsph12/12;
            let countbunga12 = countsph12*bunga;
            let countangsuran12 = countbunga12+countpokok12;

            let sph12 = countsph12.toFixed(0);
            let pokok12 = countpokok12.toFixed(0);
            let bunga12 = countbunga12.toFixed(0);
            let tenor12 = countangsuran12.toFixed(0);

            let sph12_rp = formatter.format(sph12);
            let bunga12_rp = formatter.format(bunga12);
            let pokok12_rp = formatter.format(pokok12);
            let angsuran12_rp =formatter.format(tenor12);

            sessionStorage.setItem("t12_1", 1);
            sessionStorage.setItem("s12_1", sph12_rp);
            sessionStorage.setItem("b12_1", bunga12_rp);
            sessionStorage.setItem("p12_1", pokok12_rp);
            sessionStorage.setItem("a12_1", angsuran12_rp);

            document.getElementById("pokok12").innerHTML = sessionStorage.getItem("p12_1");

            document.getElementById("sph12_1").innerHTML = sessionStorage.getItem("s12_1");
            document.getElementById("bunga12_1").innerHTML = sessionStorage.getItem("b12_1");
            document.getElementById("tenor12_1").innerHTML = sessionStorage.getItem("a12_1");

            let sph12_f = countsph12;
            let pokok12_f = countpokok12;
            let bunga12_f = 0;
            let angsuran12_f = 0;

            let sph12_frp = 0;
            let bunga12_frp = 0;
            let angsuran12_frp = 0;

            for (let i = 2; i <= 12; i++) {
                // Looping Count SPH
                sph12_f = sph12_f - pokok12_f;
                bunga12_f = sph12_f * bunga;
                angsuran12_f = bunga12_f + pokok12_f;

                sph12_fix = sph12_f.toFixed(0);
                bunga12_fix = bunga12_f.toFixed(0);
                angsuran12_fix = angsuran12_f.toFixed(0);

                sph12_frp = formatter.format(sph12_fix);
                bunga12_frp = formatter.format(bunga12_fix);
                angsuran12_frp = formatter.format(angsuran12_fix);
                
                sessionStorage.setItem("t12_"+i, i);
                sessionStorage.setItem("s12_"+i, sph12_frp);
                sessionStorage.setItem("b12_"+i, bunga12_frp);
                sessionStorage.setItem("p12_"+i, pokok12_rp);
                sessionStorage.setItem("a12_"+i, angsuran12_frp);

                document.getElementById("sph12_"+i).innerHTML = sessionStorage.getItem("s12_"+i);
                document.getElementById("bunga12_"+i).innerHTML = sessionStorage.getItem("b12_"+i);
                document.getElementById("tenor12_"+i).innerHTML = sessionStorage.getItem("a12_"+i);
            }
        // END Tenor 12

        // Tenor 24
            // inisiasi tenor 24
            let countsph24 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass24);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass24}`)
            let countpokok24 = countsph24/24;
            let countbunga24 = countsph24*bunga;
            let countangsuran24 = countbunga24+countpokok24;

            let sph24 = countsph24.toFixed(0);
            let pokok24 = countpokok24.toFixed(0);
            let bunga24 = countbunga24.toFixed(0);
            let tenor24 = countangsuran24.toFixed(0);

            let sph24_rp = formatter.format(sph24);
            let bunga24_rp = formatter.format(bunga24);
            let pokok24_rp = formatter.format(pokok24);
            let angsuran24_rp =formatter.format(tenor24);

            sessionStorage.setItem("t24_1", 1);
            sessionStorage.setItem("s24_1", sph24_rp);
            sessionStorage.setItem("b24_1", bunga24_rp);
            sessionStorage.setItem("p24_1", pokok24_rp);
            sessionStorage.setItem("a24_1", angsuran24_rp);

            document.getElementById("pokok24").innerHTML = sessionStorage.getItem("p24_1");

            document.getElementById("sph24_1").innerHTML = sessionStorage.getItem("s24_1");
            document.getElementById("bunga24_1").innerHTML = sessionStorage.getItem("b24_1");
            document.getElementById("tenor24_1").innerHTML = sessionStorage.getItem("a24_1");

            let sph24_f = countsph24;
            let pokok24_f = countpokok24;
            let bunga24_f = 0;
            let angsuran24_f = 0;

            let sph24_frp = 0;
            let bunga24_frp = 0;
            let angsuran24_frp = 0;

            for (let i = 2; i <= 24; i++) {
                // Looping Count SPH
                sph24_f = sph24_f - pokok24_f;
                bunga24_f = sph24_f * bunga;
                angsuran24_f = bunga24_f + pokok24_f;

                sph24_fix = sph24_f.toFixed(0);
                bunga24_fix = bunga24_f.toFixed(0);
                angsuran24_fix = angsuran24_f.toFixed(0);

                sph24_frp = formatter.format(sph24_fix);
                bunga24_frp = formatter.format(bunga24_fix);
                angsuran24_frp = formatter.format(angsuran24_fix);
                
                sessionStorage.setItem("t24_"+i, i);
                sessionStorage.setItem("s24_"+i, sph24_frp);
                sessionStorage.setItem("b24_"+i, bunga24_frp);
                sessionStorage.setItem("p24_"+i, pokok24_rp);
                sessionStorage.setItem("a24_"+i, angsuran24_frp);

                document.getElementById("sph24_"+i).innerHTML = sessionStorage.getItem("s24_"+i);
                document.getElementById("bunga24_"+i).innerHTML = sessionStorage.getItem("b24_"+i);
                document.getElementById("tenor24_"+i).innerHTML = sessionStorage.getItem("a24_"+i);
            }
        // END Tenor 24

        // Tenor 36
            // inisiasi tenor 36
            let countsph36 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass36);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass36}`)
            let countpokok36 = countsph36/36;
            let countbunga36 = countsph36*bunga;
            let countangsuran36 = countbunga36+countpokok36;

            let sph36 = countsph36.toFixed(0);
            let pokok36 = countpokok36.toFixed(0);
            let bunga36 = countbunga36.toFixed(0);
            let tenor36 = countangsuran36.toFixed(0);

            let sph36_rp = formatter.format(sph36);
            let bunga36_rp = formatter.format(bunga36);
            let pokok36_rp = formatter.format(pokok36);
            let angsuran36_rp =formatter.format(tenor36);

            sessionStorage.setItem("t36_1", 1);
            sessionStorage.setItem("s36_1", sph36_rp);
            sessionStorage.setItem("b36_1", bunga36_rp);
            sessionStorage.setItem("p36_1", pokok36_rp);
            sessionStorage.setItem("a36_1", angsuran36_rp);

            document.getElementById("pokok36").innerHTML = sessionStorage.getItem("p36_1");

            document.getElementById("sph36_1").innerHTML = sessionStorage.getItem("s36_1");
            document.getElementById("bunga36_1").innerHTML = sessionStorage.getItem("b36_1");
            document.getElementById("tenor36_1").innerHTML = sessionStorage.getItem("a36_1");

            let sph36_f = countsph36;
            let pokok36_f = countpokok36;
            let bunga36_f = 0;
            let angsuran36_f = 0;

            let sph36_frp = 0;
            let bunga36_frp = 0;
            let angsuran36_frp = 0;

            for (let i = 2; i <= 36; i++) {
                // Looping Count SPH
                sph36_f = sph36_f - pokok36_f;
                bunga36_f = sph36_f * bunga;
                angsuran36_f = bunga36_f + pokok36_f;

                sph36_fix = sph36_f.toFixed(0);
                bunga36_fix = bunga36_f.toFixed(0);
                angsuran36_fix = angsuran36_f.toFixed(0);

                sph36_frp = formatter.format(sph36_fix);
                bunga36_frp = formatter.format(bunga36_fix);
                angsuran36_frp = formatter.format(angsuran36_fix);
                
                sessionStorage.setItem("t36_"+i, i);
                sessionStorage.setItem("s36_"+i, sph36_frp);
                sessionStorage.setItem("b36_"+i, bunga36_frp);
                sessionStorage.setItem("p36_"+i, pokok36_rp);
                sessionStorage.setItem("a36_"+i, angsuran36_frp);

                document.getElementById("sph36_"+i).innerHTML = sessionStorage.getItem("s36_"+i);
                document.getElementById("bunga36_"+i).innerHTML = sessionStorage.getItem("b36_"+i);
                document.getElementById("tenor36_"+i).innerHTML = sessionStorage.getItem("a36_"+i);
            }
        // END Tenor 36

        // Tenor 48
            // inisiasi tenor 48
            let countsph48 = parseFloat(ot)-parseFloat(d)+parseFloat(ad)+parseFloat(ass48);
            console.log(`otr = ${ot} dp = ${d} admin = ${ad} asuransi = ${ass48}`)
            let countpokok48 = countsph48/48;
            let countbunga48 = countsph48*bunga;
            let countangsuran48 = countbunga48+countpokok48;

            let sph48 = countsph48.toFixed(0);
            let pokok48 = countpokok48.toFixed(0);
            let bunga48 = countbunga48.toFixed(0);
            let tenor48 = countangsuran48.toFixed(0);

            let sph48_rp = formatter.format(sph48);
            let bunga48_rp = formatter.format(bunga48);
            let pokok48_rp = formatter.format(pokok48);
            let angsuran48_rp =formatter.format(tenor48);

            sessionStorage.setItem("t48_1", 1);
            sessionStorage.setItem("s48_1", sph48_rp);
            sessionStorage.setItem("b48_1", bunga48_rp);
            sessionStorage.setItem("p48_1", pokok48_rp);
            sessionStorage.setItem("a48_1", angsuran48_rp);

            document.getElementById("pokok48").innerHTML = sessionStorage.getItem("p48_1");

            document.getElementById("sph48_1").innerHTML = sessionStorage.getItem("s48_1");
            document.getElementById("bunga48_1").innerHTML = sessionStorage.getItem("b48_1");
            document.getElementById("tenor48_1").innerHTML = sessionStorage.getItem("a48_1");

            let sph48_f = countsph48;
            let pokok48_f = countpokok48;
            let bunga48_f = 0;
            let angsuran48_f = 0;

            let sph48_frp = 0;
            let bunga48_frp = 0;
            let angsuran48_frp = 0;

            for (let i = 2; i <= 48; i++) {
                // Looping Count SPH
                sph48_f = sph48_f - pokok48_f;
                bunga48_f = sph48_f * bunga;
                angsuran48_f = bunga48_f + pokok48_f;

                sph48_fix = sph48_f.toFixed(0);
                bunga48_fix = bunga48_f.toFixed(0);
                angsuran48_fix = angsuran48_f.toFixed(0);

                sph48_frp = formatter.format(sph48_fix);
                bunga48_frp = formatter.format(bunga48_fix);
                angsuran48_frp = formatter.format(angsuran48_fix);
                
                sessionStorage.setItem("t48_"+i, i);
                sessionStorage.setItem("s48_"+i, sph48_frp);
                sessionStorage.setItem("b48_"+i, bunga48_frp);
                sessionStorage.setItem("p48_"+i, pokok48_rp);
                sessionStorage.setItem("a48_"+i, angsuran48_frp);

                document.getElementById("sph48_"+i).innerHTML = sessionStorage.getItem("s48_"+i);
                document.getElementById("bunga48_"+i).innerHTML = sessionStorage.getItem("b48_"+i);
                document.getElementById("tenor48_"+i).innerHTML = sessionStorage.getItem("a48_"+i);
            }
        // END Tenor 48
    </script>
</body>
</html>
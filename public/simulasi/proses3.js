const formatter = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 0
})

function pmt(rate_per_period, number_of_payments, present_value, future_value, type){
  future_value = typeof future_value !== 'undefined' ? future_value : 0;
  type = typeof type !== 'undefined' ? type : 0;

  if(rate_per_period != 0.0){
    // Interest rate exists
    var q = Math.pow(1 + rate_per_period, number_of_payments);
    return -(rate_per_period * (future_value + (q * present_value))) / ((-1 + q) * (1 + rate_per_period * (type)));

  } else if(number_of_payments != 0.0){
    // No interest rate, but number of payments exists
    return -(future_value + present_value) / number_of_payments;
  }

  return 0;
}

function roundUp(num, precision) {
  precision = Math.pow(10, precision)
  return Math.ceil(num * precision) / precision
}

function hitung_dp_menurun(){
  let dp = document.getElementById("dp_menurun").value;
  let harga = document.getElementById("angka_motor_menurun").value;
  let uangmuka = (dp/harga)*100;

  let persen = uangmuka.toFixed(0);

  if(!isNaN(uangmuka)){
    document.getElementById("angka_dp_menurun").innerHTML = uangmuka;
    document.getElementById("dp_motor_menurun").innerHTML = persen;
  }
}

function hitung_dp(){
  let dp = document.getElementById("dp").value;
  let harga = document.getElementById("angka_motor").value;
  let uangmuka = (dp/harga)*100;

  let persen = uangmuka.toFixed(0);

  if(!isNaN(uangmuka)){
    document.getElementById("angka_dp").innerHTML = uangmuka;
    document.getElementById("dp_motor").innerHTML = persen;
  }
}

// function hitung_kredit_menurun(){
//   let otr = document.getElementById("angka_motor_menurun").value;

//   let dp = document.getElementById("pass_dp").value;

//   let bunga = document.getElementById("bunga_menurun").value;
//   if (bunga == 0.0240) {
//     admin = 1400000;
//   } else {
//     admin = 1800000;
//   }
//   let tenor = document.getElementById("tenor_menurun").value;
//   if (tenor == 12) {
//     rateAss = 0.0080;
//   } else if(tenor == 24) {
//     rateAss = 0.0144;
//   } else if(tenor == 36) {
//     rateAss = 0.0200;
//   } else if(tenor == 48) {
//     rateAss = 0.0248;
//   } else {
//     rateAss = 0;
//   }
//   let asuransi = parseFloat(otr)*parseFloat(rateAss);
//   let sph = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi);
//   let hasil = (parseFloat(sph)/parseFloat(tenor))+parseFloat(sph)*parseFloat(bunga);
//   let angsuran = hasil.toFixed(0);
//   let rupiah = formatter.format(angsuran);

//   if (!isNaN(angsuran)) {
//     document.getElementById("angsuran_menurun").innerHTML = "<p>Angsuran</p><h2>"+rupiah+"</h2>";
//   }else{
//     document.getElementById("angsuran_menurun").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//   }

//   console.log(`DP ${dp}`);
// }

// function hitung_kredit(){
//   let effectiveRate = 34;
//   let adminFee = 1000000;
//   let otr = document.getElementById("angka_motor").value;

//   let dp = document.getElementById("pass_dp_menetap").value;

//   let tenor = document.getElementById("tenor").value;
//   if (tenor == 12) {
//     rateAss = 0.0093;
//   } else if(tenor == 24) {
//     rateAss = 0.0169;
//   } else if(tenor == 36) {
//     rateAss = 0.0237;
//   } else if(tenor == 48) {
//     rateAss = 0.0290;
//   }else if(tenor == 60) {
//     rateAss = 0.0432;
//   } else {
//     rateAss = 0;
//   }
//   let rounding = 2;

//   let rate = parseFloat(effectiveRate/1200);
//   let jumlahPinjaman = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss)*parseFloat(otr)));
  
//   let hasil = roundUp(pmt(rate,tenor,jumlahPinjaman,0,0),rounding);
//   let angsuran = hasil.toFixed(0);
//   let rupiah = formatter.format(angsuran);

//   if (!isNaN(angsuran)) {
//     document.getElementById("angsuran").innerHTML = "<p>Angsuran</p><h2>"+rupiah+"</h2>";
//   }else{
//     document.getElementById("angsuran").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//   }

//   console.log(`DP Menetap ${dp}`);
// }

// function kredit_menurun_old(){
//   let otr = document.getElementById("angka_motor_menurun").value;

//   let dp = document.getElementById("pass_dp").value;

//   let bunga = document.getElementById("bunga_menurun").value;
//   if (bunga == 0.0240) {
//     admin = 1518000;
//   } else {
//     admin = 1818000;
//   }
//   let tenor12 = 12;
//   let tenor24 = 24;
//   let tenor36 = 36;
//   let tenor48 = 48;

//   let rateAss12 = 0.0080;
//   let rateAss24 = 0.0144;
//   let rateAss36 = 0.0200;
//   let rateAss48 = 0.0248;

//   // Tenor 12 Bulan
//   let asuransi_12 = parseFloat(otr)*parseFloat(rateAss12);
//   let sph_12 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_12);
//   let hasil_12 = (parseFloat(sph_12)/parseFloat(tenor12))+parseFloat(sph_12)*parseFloat(bunga);
//   let angsuran_12 = hasil_12.toFixed(0);
//   let rupiah_12 = formatter.format(angsuran_12);

//   // Tenor 24 Bulan
//   let asuransi_24 = parseFloat(otr)*parseFloat(rateAss24);
//   let sph_24 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_24);
//   let hasil_24 = (parseFloat(sph_24)/parseFloat(tenor24))+parseFloat(sph_24)*parseFloat(bunga);
//   let angsuran_24 = hasil_24.toFixed(0);
//   let rupiah_24 = formatter.format(angsuran_24);

//   // Tenor 36 Bulan
//   let asuransi_36 = parseFloat(otr)*parseFloat(rateAss36);
//   let sph_36 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_36);
//   let hasil_36 = (parseFloat(sph_36)/parseFloat(tenor36))+parseFloat(sph_36)*parseFloat(bunga);
//   let angsuran_36 = hasil_36.toFixed(0);
//   let rupiah_36 = formatter.format(angsuran_36);

//   // Tenor 48 Bulan
//   let asuransi_48 = parseFloat(otr)*parseFloat(rateAss48);
//   let sph_48 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_48);
//   let hasil_48 = (parseFloat(sph_48)/parseFloat(tenor48))+parseFloat(sph_48)*parseFloat(bunga);
//   let angsuran_48 = hasil_48.toFixed(0);
//   let rupiah_48 = formatter.format(angsuran_48);

//   if ((!isNaN(angsuran_12)) || (!isNaN(angsuran_24)) || (!isNaN(angsuran_36)) || (!isNaN(angsuran_48))) {
//     document.getElementById("angsuran_menurun_12").innerHTML = "<h2 class='font_angsuran'>"+rupiah_12+"</h2>";
//     document.getElementById("angsuran_menurun_24").innerHTML = "<h2 class='font_angsuran'>"+rupiah_24+"</h2>";
//     document.getElementById("angsuran_menurun_36").innerHTML = "<h2 class='font_angsuran'>"+rupiah_36+"</h2>";
//     document.getElementById("angsuran_menurun_48").innerHTML = "<h2 class='font_angsuran'>"+rupiah_48+"</h2>";
//   }else{
//     document.getElementById("angsuran_menurun_12").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//     document.getElementById("angsuran_menurun_24").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//     document.getElementById("angsuran_menurun_36").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//     document.getElementById("angsuran_menurun_48").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
//   }

//   // Save Temp Data
//   localStorage.setItem("unitTr",document.getElementById("motor_menurun").value);

//   localStorage.setItem("otrTr",otr);
//   localStorage.setItem("dpTr",dp);
//   localStorage.setItem("bungaTr",bunga);
//   localStorage.setItem("adminTr",admin);

//   localStorage.setItem("asuransiTr12",asuransi_12);
//   localStorage.setItem("asuransiTr24",asuransi_24);
//   localStorage.setItem("asuransiTr36",asuransi_36);
//   localStorage.setItem("asuransiTr48",asuransi_48);

//   localStorage.setItem("sphTr12",sph_12);
//   localStorage.setItem("sphTr24",sph_24);
//   localStorage.setItem("sphTr36",sph_36);
//   localStorage.setItem("sphTr48",sph_48);

//   localStorage.setItem("angsuranTr12",angsuran_12);
//   localStorage.setItem("angsuranTr24",angsuran_24);
//   localStorage.setItem("angsuranTr36",angsuran_36);
//   localStorage.setItem("angsuranTr48",angsuran_48);

//   localStorage.setItem("rupiahTr12",rupiah_12);
//   localStorage.setItem("rupiahTr24",rupiah_24);
//   localStorage.setItem("rupiahTr36",rupiah_36);
//   localStorage.setItem("rupiahTr48",rupiah_48);

//   localStorage.setItem("rateAssTr12",rateAss12);
//   localStorage.setItem("rateAssTr24",rateAss24);
//   localStorage.setItem("rateAssTr36",rateAss36);
//   localStorage.setItem("rateAssTr48",rateAss48);

//   // Show Button Print
//   document.getElementById("printButtonMenurun").removeAttribute("hidden");

//   // Show Button WA
//   document.getElementById("inputWhatsappTr").removeAttribute("hidden");

//   console.log(`admin ${admin}`, `asuransi ${asuransi_12}`);
// }

// Now Use this function
function kredit_menurun(){
  let otr = document.getElementById("angka_motor_menurun").value;

  let dp = document.getElementById("pass_dp").value;

  let bunga = document.getElementById("bunga_menurun").value;
  if (bunga == 0.0240) {
    admin = 1518000;
    bungaPerTahun = 0.288;
  } else {
    admin = 1818000;
    bungaPerTahun = 0.21;
  }
  
  let tenor12 = 12;
  let tenor24 = 24;
  let tenor36 = 36;
  let tenor48 = 48;

  let rateAss12 = 0.0080;
  let rateAss24 = 0.0144;
  let rateAss36 = 0.0200;
  let rateAss48 = 0.0248;

  // Tenor 12 Bulan
  let asuransi_12 = parseFloat(otr)*parseFloat(rateAss12);
  let uangMukaMurni_12 = dp - (admin + asuransi_12);
  let pokokHutang_12 = otr - uangMukaMurni_12;
  let angsuranPokok_12 = pokokHutang_12 / tenor12;
  let bungaPertama_12 = pokokHutang_12 * (bungaPerTahun / 12);
  angsuranPokok_12 = Math.round(angsuranPokok_12);
  bungaPertama_12 = Math.round(bungaPertama_12);
  let sum_12 = angsuranPokok_12 + bungaPertama_12;
  let angsuran_12 = roundUp(sum_12, -2);
  let rupiah_12 = formatter.format(angsuran_12);

  // Tenor 24 Bulan
  let asuransi_24 = parseFloat(otr)*parseFloat(rateAss24);
  let uangMukaMurni_24 = dp - (admin + asuransi_24);
  let pokokHutang_24 = otr - uangMukaMurni_24;
  let angsuranPokok_24 = pokokHutang_24 / tenor24;
  let bungaPertama_24 = pokokHutang_24 * (bungaPerTahun / 12);
  angsuranPokok_24 = Math.round(angsuranPokok_24);
  bungaPertama_24 = Math.round(bungaPertama_24);
  let sum_24 = angsuranPokok_24 + bungaPertama_24;
  let angsuran_24 = roundUp(sum_24, -2);
  let rupiah_24 = formatter.format(angsuran_24);

  // Tenor 36 Bulan
  let asuransi_36 = parseFloat(otr)*parseFloat(rateAss36);
  let uangMukaMurni_36 = dp - (admin + asuransi_36);
  let pokokHutang_36 = otr - uangMukaMurni_36;
  let angsuranPokok_36 = pokokHutang_36 / tenor36;
  let bungaPertama_36 = pokokHutang_36 * (bungaPerTahun / 12);
  angsuranPokok_36 = Math.round(angsuranPokok_36);
  bungaPertama_36 = Math.round(bungaPertama_36);
  let sum_36 = angsuranPokok_36 + bungaPertama_36;
  let angsuran_36 = roundUp(sum_36, -2);
  let rupiah_36 = formatter.format(angsuran_36);

  // Tenor 48 Bulan
  let asuransi_48 = parseFloat(otr)*parseFloat(rateAss48);
  let uangMukaMurni_48 = dp - (admin + asuransi_48);
  let pokokHutang_48 = otr - uangMukaMurni_48;
  let angsuranPokok_48 = pokokHutang_48 / tenor48;
  let bungaPertama_48 = pokokHutang_48 * (bungaPerTahun / 12);
  angsuranPokok_48 = Math.round(angsuranPokok_48);
  bungaPertama_48 = Math.round(bungaPertama_48);
  let sum_48 = angsuranPokok_48 + bungaPertama_48;
  let angsuran_48 = roundUp(sum_48, -2);
  let rupiah_48 = formatter.format(angsuran_48);

  if ((!isNaN(angsuran_12)) || (!isNaN(angsuran_24)) || (!isNaN(angsuran_36)) || (!isNaN(angsuran_48))) {
    document.getElementById("angsuran_menurun_12").innerHTML = "<h2 class='font_angsuran'>"+rupiah_12+"</h2>";
    document.getElementById("angsuran_menurun_24").innerHTML = "<h2 class='font_angsuran'>"+rupiah_24+"</h2>";
    document.getElementById("angsuran_menurun_36").innerHTML = "<h2 class='font_angsuran'>"+rupiah_36+"</h2>";
    document.getElementById("angsuran_menurun_48").innerHTML = "<h2 class='font_angsuran'>"+rupiah_48+"</h2>";
  }else{
    document.getElementById("angsuran_menurun_12").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menurun_24").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menurun_36").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menurun_48").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
  }

  // Save Temp Data
  localStorage.setItem("unitTr",document.getElementById("motor_menurun").value);

  localStorage.setItem("otrTr",otr);
  localStorage.setItem("dpTr",dp);
  localStorage.setItem("bungaTr",bunga);
  localStorage.setItem("adminTr",admin);

  localStorage.setItem("asuransiTr12",asuransi_12);
  localStorage.setItem("asuransiTr24",asuransi_24);
  localStorage.setItem("asuransiTr36",asuransi_36);
  localStorage.setItem("asuransiTr48",asuransi_48);

  localStorage.setItem("angsuranTr12",angsuran_12);
  localStorage.setItem("angsuranTr24",angsuran_24);
  localStorage.setItem("angsuranTr36",angsuran_36);
  localStorage.setItem("angsuranTr48",angsuran_48);

  localStorage.setItem("rupiahTr12",rupiah_12);
  localStorage.setItem("rupiahTr24",rupiah_24);
  localStorage.setItem("rupiahTr36",rupiah_36);
  localStorage.setItem("rupiahTr48",rupiah_48);

  localStorage.setItem("rateAssTr12",rateAss12);
  localStorage.setItem("rateAssTr24",rateAss24);
  localStorage.setItem("rateAssTr36",rateAss36);
  localStorage.setItem("rateAssTr48",rateAss48);

  // Show Button Print
  document.getElementById("printButtonMenurun").removeAttribute("hidden");

  // Show Button WA
  document.getElementById("inputWhatsappTr").removeAttribute("hidden");
}

// Use this function
function kredit_menetap(){
  let effectiveRate = 34;
  let adminFee = 1000000;
  let otr = document.getElementById("angka_motor").value;

  let dp = document.getElementById("pass_dp_menetap").value;

  let tenor12 = 12;
  let tenor24 = 24;
  let tenor36 = 36;
  let tenor48 = 48;
  let tenor60 = 60;

  let rateAss12 = 0.0093;
  let rateAss24 = 0.0169;
  let rateAss36 = 0.0237;
  let rateAss48 = 0.0290;
  let rateAss60 = 0.0432;

  let rounding = 2;

  // Tenor 12
  let rate_12 = parseFloat(effectiveRate/1200);
  let jumlahPinjaman_12 = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss12)*parseFloat(otr)));
  
  let hasil_12 = roundUp(pmt(rate_12,tenor12,jumlahPinjaman_12,0,0),rounding);
  let angsuran_12 = hasil_12.toFixed(0);
  let rupiah_12 = formatter.format(angsuran_12);

  // Tenor 24
  let rate_24 = parseFloat(effectiveRate/1200);
  let jumlahPinjaman_24 = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss24)*parseFloat(otr)));
  
  let hasil_24 = roundUp(pmt(rate_24,tenor24,jumlahPinjaman_24,0,0),rounding);
  let angsuran_24 = hasil_24.toFixed(0);
  let rupiah_24 = formatter.format(angsuran_24);

  // Tenor 36
  let rate_36 = parseFloat(effectiveRate/1200);
  let jumlahPinjaman_36 = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss36)*parseFloat(otr)));
  
  let hasil_36 = roundUp(pmt(rate_36,tenor36,jumlahPinjaman_36,0,0),rounding);
  let angsuran_36 = hasil_36.toFixed(0);
  let rupiah_36 = formatter.format(angsuran_36);

  // Tenor 48
  let rate_48 = parseFloat(effectiveRate/1200);
  let jumlahPinjaman_48 = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss48)*parseFloat(otr)));
  
  let hasil_48 = roundUp(pmt(rate_48,tenor48,jumlahPinjaman_48,0,0),rounding);
  let angsuran_48 = hasil_48.toFixed(0);
  let rupiah_48 = formatter.format(angsuran_48);

  // Tenor 60
  let rate_60 = parseFloat(effectiveRate/1200);
  let jumlahPinjaman_60 = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss60)*parseFloat(otr)));
  
  let hasil_60 = roundUp(pmt(rate_60,tenor60,jumlahPinjaman_60,0,0),rounding);
  let angsuran_60 = hasil_60.toFixed(0);
  let rupiah_60 = formatter.format(angsuran_60);

  if ((!isNaN(angsuran_12)) || (!isNaN(angsuran_24)) || (!isNaN(angsuran_36)) || (!isNaN(angsuran_48)) || (!isNaN(angsuran_60))) {
    document.getElementById("angsuran_menetap_12").innerHTML = "<h2 class='font_angsuran' id='storage12'>"+rupiah_12+"</h2>";
    document.getElementById("angsuran_menetap_24").innerHTML = "<h2 class='font_angsuran'>"+rupiah_24+"</h2>";
    document.getElementById("angsuran_menetap_36").innerHTML = "<h2 class='font_angsuran'>"+rupiah_36+"</h2>";
    document.getElementById("angsuran_menetap_48").innerHTML = "<h2 class='font_angsuran'>"+rupiah_48+"</h2>";
    document.getElementById("angsuran_menetap_60").innerHTML = "<h2 class='font_angsuran'>"+rupiah_60+"</h2>";
  }else{
    document.getElementById("angsuran_menetap_12").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menetap_24").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menetap_36").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menetap_48").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
    document.getElementById("angsuran_menetap_60").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
  }
  
  // Save Temp Data
  let rupiah_otr = formatter.format(otr);
  let rupiah_dp = formatter.format(dp);

  localStorage.setItem("unitTp",document.getElementById("motorMenetap").value);

  localStorage.setItem("otrTp",rupiah_otr);
  localStorage.setItem("dpTp",rupiah_dp);

  localStorage.setItem("rupiahTp12",rupiah_12);
  localStorage.setItem("rupiahTp24",rupiah_24);
  localStorage.setItem("rupiahTp36",rupiah_36);
  localStorage.setItem("rupiahTp48",rupiah_48);
  localStorage.setItem("rupiahTp60",rupiah_60);

  // Show Button Print
  document.getElementById("printButtonMenetap").removeAttribute("hidden");

  // Show Button WA
  document.getElementById("inputWhatsappTp").removeAttribute("hidden");
}

function send_wa_tr(){
  let number = document.getElementById("whatsappNumberTr").value;
  let unit = localStorage.getItem("unitTr");
  let getOtr = localStorage.getItem("otrTr")
  let getDp = localStorage.getItem("dpTr");
  let otr = formatter.format(getOtr);
  let dp = formatter.format(getDp);
  let angsuran12 = localStorage.getItem("rupiahTr12");
  let angsuran24 = localStorage.getItem("rupiahTr24");
  let angsuran36 = localStorage.getItem("rupiahTr36");
  let angsuran48 = localStorage.getItem("rupiahTr48");
  let bunga = localStorage.getItem("bungaTr");
  let hitungbunga = bunga*100;
  let bungap = hitungbunga.toFixed(2);

  if (String(number)[0] == '0') {
    let string = number.toString();
    let rep = string.replace(string[0],'62');
    let correctNumber = Number(rep);
    window.open(`https://api.whatsapp.com/send/?phone=${correctNumber}&text=Salam%20Semakin%20Didepan%0D%0A%0D%0A*Simulasi%20Kredit%20Bunga%20Menurun*%0D%0A%0D%0ABunga%20${bungap}%%0D%0A*${unit}*%0D%0AHarga%20OTR%20*_${otr}_*%0D%0ADP%20*_${dp}_*%0D%0AAngsuran%2012%20bln%20*_${angsuran12}_*%0D%0AAngsuran%2024%20bln%20*_${angsuran24}_*%0D%0AAngsuran%2036%20bln%20*_${angsuran36}_*%0D%0AAngsuran%2048%20bln%20*_${angsuran48}_*%0D%0A%0D%0ATerimakasih%0D%0A%0D%0A*Yamaha%20Belinya%20Pasti%20di%20Bisma*`)
  }else{
    window.open(`https://api.whatsapp.com/send/?phone=${number}&text=Salam%20Semakin%20Didepan%0D%0A%0D%0A*Simulasi%20Kredit%20Bunga%20Menurun*%0D%0A%0D%0ABunga%20${bungap}%%0D%0A*${unit}*%0D%0AHarga%20OTR%20*_${otr}_*%0D%0ADP%20*_${dp}_*%0D%0AAngsuran%2012%20bln%20*_${angsuran12}_*%0D%0AAngsuran%2024%20bln%20*_${angsuran24}_*%0D%0AAngsuran%2036%20bln%20*_${angsuran36}_*%0D%0AAngsuran%2048%20bln%20*_${angsuran48}_*%0D%0A%0D%0ATerimakasih%0D%0A%0D%0A*Yamaha%20Belinya%20Pasti%20di%20Bisma*`)
  }
}

function send_wa_tp(){
  let number = document.getElementById("whatsappNumberTp").value;
  let unit = localStorage.getItem("unitTp");
  let otr = localStorage.getItem("otrTp");
  let dp = localStorage.getItem("dpTp");
  let angsuran12 = localStorage.getItem("rupiahTp12");
  let angsuran24 = localStorage.getItem("rupiahTp24");
  let angsuran36 = localStorage.getItem("rupiahTp36");
  let angsuran48 = localStorage.getItem("rupiahTp48");
  let angsuran60 = localStorage.getItem("rupiahTp60");

  if ((String(number)[0] == '0')) {
    let string = number.toString();
    let rep = string.replace(string[0],'62');
    let correctNumber = Number(rep);
    window.open(`https://api.whatsapp.com/send/?phone=${correctNumber}&text=Salam%20Semakin%20Didepan%0D%0A%0D%0A*Simulasi%20Kredit%20Bunga%20Menetap*%0D%0A%0D%0A*${unit}*%0D%0AHarga%20OTR%20*_${otr}_*%0D%0ADP%20*_${dp}_*%0D%0AAngsuran%2012%20bln%20*_${angsuran12}_*%0D%0AAngsuran%2024%20bln%20*_${angsuran24}_*%0D%0AAngsuran%2036%20bln%20*_${angsuran36}_*%0D%0AAngsuran%2048%20bln%20*_${angsuran48}_*%0D%0AAngsuran%2060%20bln%20*_${angsuran60}_*%0D%0A%0D%0ATerimakasih%0D%0A%0D%0A*Yamaha%20Belinya%20Pasti%20di%20Bisma*`)
  }else{
    window.open(`https://api.whatsapp.com/send/?phone=${number}&text=Salam%20Semakin%20Didepan%0D%0A%0D%0A*Simulasi%20Kredit%20Bunga%20Menetap*%0D%0A%0D%0A*${unit}*%0D%0AHarga%20OTR%20*_${otr}_*%0D%0ADP%20*_${dp}_*%0D%0AAngsuran%2012%20bln%20*_${angsuran12}_*%0D%0AAngsuran%2024%20bln%20*_${angsuran24}_*%0D%0AAngsuran%2036%20bln%20*_${angsuran36}_*%0D%0AAngsuran%2048%20bln%20*_${angsuran48}_*%0D%0AAngsuran%2060%20bln%20*_${angsuran60}_*%0D%0A%0D%0ATerimakasih%0D%0A%0D%0A*Yamaha%20Belinya%20Pasti%20di%20Bisma*`)
  }
}
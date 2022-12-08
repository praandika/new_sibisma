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

function hitung_kredit_menurun(){
  let otr = document.getElementById("angka_motor_menurun").value;

  let dp = document.getElementById("pass_dp").value;

  let bunga = document.getElementById("bunga_menurun").value;
  if (bunga == 0.0240) {
    admin = 1400000;
  } else {
    admin = 1800000;
  }
  let tenor = document.getElementById("tenor_menurun").value;
  if (tenor == 12) {
    rateAss = 0.0080;
  } else if(tenor == 24) {
    rateAss = 0.0144;
  } else if(tenor == 36) {
    rateAss = 0.0200;
  } else if(tenor == 48) {
    rateAss = 0.0248;
  } else {
    rateAss = 0;
  }
  let asuransi = parseFloat(otr)*parseFloat(rateAss);
  let sph = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi);
  let hasil = (parseFloat(sph)/parseFloat(tenor))+parseFloat(sph)*parseFloat(bunga);
  let angsuran = hasil.toFixed(0);
  let rupiah = formatter.format(angsuran);

  if (!isNaN(angsuran)) {
    document.getElementById("angsuran_menurun").innerHTML = "<p>Angsuran</p><h2>"+rupiah+"</h2>";
  }else{
    document.getElementById("angsuran_menurun").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
  }

  console.log(`DP ${dp}`);
}

function hitung_kredit(){
  let effectiveRate = 34;
  let adminFee = 1000000;
  let otr = document.getElementById("angka_motor").value;

  let dp = document.getElementById("pass_dp_menetap").value;

  let tenor = document.getElementById("tenor").value;
  if (tenor == 12) {
    rateAss = 0.0093;
  } else if(tenor == 24) {
    rateAss = 0.0169;
  } else if(tenor == 36) {
    rateAss = 0.0237;
  } else if(tenor == 48) {
    rateAss = 0.0290;
  }else if(tenor == 60) {
    rateAss = 0.0432;
  } else {
    rateAss = 0;
  }
  let rounding = 2;

  let rate = parseFloat(effectiveRate/1200);
  let jumlahPinjaman = -(parseFloat(otr)-(parseFloat(dp)-parseFloat(adminFee)-parseFloat(rateAss)*parseFloat(otr)));
  
  let hasil = roundUp(pmt(rate,tenor,jumlahPinjaman,0,0),rounding);
  let angsuran = hasil.toFixed(0);
  let rupiah = formatter.format(angsuran);

  if (!isNaN(angsuran)) {
    document.getElementById("angsuran").innerHTML = "<p>Angsuran</p><h2>"+rupiah+"</h2>";
  }else{
    document.getElementById("angsuran").innerHTML = "<h2 style='color: #f490c3;'>Informasi Tidak Lengkap</h2>";
  }

  console.log(`DP Menetap ${dp}`);
}

function kredit_menurun(){
  let otr = document.getElementById("angka_motor_menurun").value;

  let dp = document.getElementById("pass_dp").value;

  let bunga = document.getElementById("bunga_menurun").value;
  if (bunga == 0.0240) {
    admin = 1400000;
  } else {
    admin = 1800000;
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
  let sph_12 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_12);
  let hasil_12 = (parseFloat(sph_12)/parseFloat(tenor12))+parseFloat(sph_12)*parseFloat(bunga);
  let angsuran_12 = hasil_12.toFixed(0);
  let rupiah_12 = formatter.format(angsuran_12);

  // Tenor 24 Bulan
  let asuransi_24 = parseFloat(otr)*parseFloat(rateAss24);
  let sph_24 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_24);
  let hasil_24 = (parseFloat(sph_24)/parseFloat(tenor24))+parseFloat(sph_24)*parseFloat(bunga);
  let angsuran_24 = hasil_24.toFixed(0);
  let rupiah_24 = formatter.format(angsuran_24);

  // Tenor 36 Bulan
  let asuransi_36 = parseFloat(otr)*parseFloat(rateAss36);
  let sph_36 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_36);
  let hasil_36 = (parseFloat(sph_36)/parseFloat(tenor36))+parseFloat(sph_36)*parseFloat(bunga);
  let angsuran_36 = hasil_36.toFixed(0);
  let rupiah_36 = formatter.format(angsuran_36);

  // Tenor 48 Bulan
  let asuransi_48 = parseFloat(otr)*parseFloat(rateAss48);
  let sph_48 = parseFloat(otr)-parseFloat(dp)+parseFloat(admin)+parseFloat(asuransi_48);
  let hasil_48 = (parseFloat(sph_48)/parseFloat(tenor48))+parseFloat(sph_48)*parseFloat(bunga);
  let angsuran_48 = hasil_48.toFixed(0);
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

  console.log(`DP ${dp}`);
}

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
    document.getElementById("angsuran_menetap_12").innerHTML = "<h2 class='font_angsuran'>"+rupiah_12+"</h2>";
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

  console.log(`DP Menetap ${dp}`);
}
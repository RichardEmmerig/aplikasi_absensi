$(".information_alert").css("display", "none");

function timeoutMessage() {
  setTimeout(function () {
    $(".information_alert").fadeOut();
  }, 5000);
}

function messageColorWarning() {
  $(".information_alert").css("background-color", "#FFFF00");
  $(".information_alert").css("color", "#000000");
}

$(document).ready(function () {
  $("#btn_tambah_aktifitas").on("click", function () {
    $(".information_alert").css("background-color", "#FFFF00");
    $(".information_alert").css("color", "#000000");
    $(".information_alert").fadeIn();
    let teks_informasi = "Fitur Aktifitas masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });

  $("#btn_buat_tugas").on("click", function () {
    messageColorWarning();
    $(".information_alert").fadeIn();
    let teks_informasi = "Fitur Buat Tugas masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });

  $("#btn_buat_acara").on("click", function () {
    messageColorWarning();
    $(".information_alert").fadeIn();
    let teks_informasi = "Fitur Buat Acara masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });

  $(".information_alert_close").on("click", function () {
    $(".information_alert").fadeOut();
    $("#information_alert_span").html("[pesan]");
  });
});

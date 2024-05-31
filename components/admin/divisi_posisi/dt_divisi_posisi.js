$(document).ready(function () {
  $("#sect-divisi").show();
  $("#sect-posisi").hide();

  $("#btn_conf_divisi").addClass("btn-primary");
  $("#btn_conf_divisi").removeClass("btn-outline-primary");
  $("#btn_conf_posisi").addClass("btn-outline-primary");
  $("#btn_conf_posisi").removeClass("btn-primary");

  $("#btn_conf_divisi").on("click", function () {
    $("#sect-divisi").show();
    $("#btn_conf_divisi").addClass("btn-primary");
    $("#btn_conf_divisi").removeClass("btn-outline-primary");
    $("#sect-posisi").hide();
    $("#btn_conf_posisi").addClass("btn-outline-primary");
    $("#btn_conf_posisi").removeClass("btn-primary");
  });

  $("#btn_conf_posisi").on("click", function () {
    $("#sect-divisi").hide();
    $("#btn_conf_posisi").addClass("btn-primary");
    $("#btn_conf_posisi").removeClass("btn-outline-primary");
    $("#sect-posisi").show();
    $("#btn_conf_divisi").addClass("btn-outline-primary");
    $("#btn_conf_divisi").removeClass("btn-primary");
  });
});

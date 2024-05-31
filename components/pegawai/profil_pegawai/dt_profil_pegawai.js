$(document).ready(function () {
  $("#overlay_informasi").fadeIn("fast").delay(2000).fadeOut("slow");

  $(".select2_jabatan_profil").select2({
    dropdownParent: $("#form_profil"),
  });

  //   $(".select2_divisi_profil").hide();

  $(".select2_divisi_profil").select2({
    dropdownParent: $("#form_profil"),
  });

  $("#i-divisi-jabatan").hide();

  $(".select2_jabatan_profil").change(function () {
    let id_jabatan = $(".select2_jabatan_profil").select2("data");
    $(".select2_divisi_profil").show();
    // $("#i-divisi-jabatan").hide();
    $.ajax({
      type: "POST",
      url: "components/pegawai/profil_pegawai/ajax_profil_pegawai.php",
      data: {
        fun: "select2_divisi_profil",
        id_jabatan: id_jabatan[0]["id"],
      },
      dataType: "JSON",
      success: function (response) {
        let len = response.length;
        for (var i = 0; i < len; i++) {
          let id_divisi = response[i]["id_divisi"];
          let divisi = response[i]["divisi"];
          $(".select2_divisi_profil").append(
            '<option value="' + id_divisi + '">' + divisi + "</option>"
          );
        }
      },
    });
  });

  $("#btn_edit_profil").click(function () {
    let jenis_kelamin;
    if ($("#jenis_kelamin1:checked").val()) {
      jenis_kelamin = "Laki laki";
    } else if ($("#jenis_kelamin2:chekced").val()) {
      jenis_kelamin = "Perempuan";
    }
    $.ajax({
      type: "POST",
      url: "components/pegawai/profil_pegawai/ajax_profil_pegawai.php",
      data: {
        fun: "edit_profil",
        id_pegawai: $("#id_pegawai").val(),
        // username : username - disabled
        nama_lengkap: $("#nama_lengkap").val(),
        // no_wa: no_wa - disabled
        // status_akun: status_akun - disabled
        alamat: $("#alamat").val(),
        alamat_domisili: $("#alamat_domisili").val(),
        tgl_lahir: $("#tgl_lahir").val(),
        jenis_kelamin: jenis_kelamin,
        jabatan: $("#select_jabatan").val(),
        divisi: $("#select_divisi").val(),
        status_pekerja: $("#status_pekerjaan").val(),
      },
      dataType: "JSON",
      success: function (response) {
        if (response == "1") {
          // code
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        console.log("Error: " + errorThrown);
      },
    });
  });
});

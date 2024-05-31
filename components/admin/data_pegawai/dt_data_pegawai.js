var usernamenya = document.getElementById("daUsername");
function changeValueUsername(val) {
  usernamenya.value = val;
}

$(document).ready(function () {
  // START // GETING THE DATATABLE DATA DATA PEGAWAI
  var table_data_pegawai = $("#table_data_pegawai").DataTable({
    dom: "Bfrtip",
    order: [[0, "desc"]],
    pageLength: 10,
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    processing: true,
    serverSide: true,
    searching: true,
    scrollY: "600px",
    scrollX: true,
    scrollCollapse: true,
    paging: true,
    fixedColumns: true,
    buttons: [
      {
        extend: "pdfHtml5",
        title: "Data Pegawai Absensi SMI",
        exportOptions: {
          columns: [0, 1, 3, 4, 5, 6, 7],
        },
      },
    ],
    columns: [
      { data: "no" },
      { data: "username" },
      { data: "password" },
      { data: "status" },
      { data: "nama_lengkap" },
      { data: "jenis_kelamin" },
      { data: "no_wa" },
      { data: "divisi" },
      { data: "aksi" },
    ],
    ajax: {
      url: "components/admin/data_pegawai/ajax_ql_data_pegawai.php",
      dataType: "json",
      type: "POST",
      data: {
        fun: "fetch_users",
      },
      dataSrc: "records",
    },
    success: function (data) {
      console.log("Berhasil");
      console.log(data);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });
  // END // GETING THE DATATABLE DATA DATA PEGAWAI

  // END // GETING THE DATATABLE DATA PILIHAN PEGAWAI
  var placehoder_nama_pegawai = $("#placehoder_nama_pegawai").text();
  var id_pegawai = $("#id_pegawai").val();
  var table_data_absensi_perorang = $("#table_data_absensi_perorang").DataTable(
    {
      dom: "Bfrtip",
      order: [[0, "desc"]],
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      processing: true,
      serverSide: true,
      searching: false,
      // scrollY: "600px",
      // scrollX: true,
      // scrollCollapse: true,
      paging: true,
      fixedColumns: true,
      buttons: [
        {
          extend: "pdfHtml5",
          text: "Download file PDF",
          title: "Data Kehadiran " + placehoder_nama_pegawai,
          // exportOptions: {
          //   columns: [0, 1, 3, 4, 5, 6, 7],
          // },
        },
        {
          extend: "excel",
          text: "Download file EXCEL",
          title: "Data Kehadiran " + placehoder_nama_pegawai,
        },
      ],
      columns: [
        { data: "no" },
        { data: "hari" },
        { data: "tgl_absen" },
        { data: "masuk" },
        { data: "pulang" },
        { data: "keterangan" },
        { data: "lokasi_masuk" },
        { data: "lokasi_pulang" },
      ],
      ajax: {
        url: "components/admin/data_pegawai/ajax_ql_data_pegawai.php",
        dataType: "json",
        type: "POST",
        data: {
          fun: "fetch_selected_user",
          id_pegawai: id_pegawai,
        },
        dataSrc: "records",
      },
      success: function (data) {
        console.log("Berhasil");
        console.log(data);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
      rowCallback: function (row, data, index) {
        if (data["pulang"] == "00:00:00") {
          $(row).find("td").css("background-color", "lightyellow");
        }
        if (data["masuk"] != "00:00:00" && data["pulang"] != "00:00:00") {
          $(row).find("td").css("background-color", "lightblue");
        }
      },
    }
  );
  // END // GETING THE DATATABLE DATA PILIHAN PEGAWAI

  $("#table_data_absensi_perorang").css("width", "100%");

  $("#btn_user_baru").click(function () {
    $("#select2_posisi_pegawai").select2();
  });

  $("#btn_user_baru").click(function () {
    $("#select2_posisi_pegawai").select2({
      dropdownParent: $("#modal_pegawai"),
    });
  });

  set_btn_save();
  set_btn_edit();

  $(".btn_delete_pegawai").click(function () {
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "ajax_ql_data_pegawai.php",
      data: {
        fun: "proses_hapus",
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          console.log(data);
          alert("berhasil hapus data");
        } else {
          console.log(data);
          alert("Terjadi Error");
        }
      },
    });
  });
});

function set_btn_save() {
  $("#btn_save_pegawai").click(function () {
    if ($("#daJK1:checked").val()) {
      var jenis_kel = "Laki laki";
    } else {
      var jenis_kel = "Perempuan";
    }
    var fun = $("#daFormdirect").val();
    let id_divisi = $("#select2_posisi_pegawai").select2("data");
    $.ajax({
      type: "POST",
      url: "components/admin/data_pegawai/ajax_ql_data_pegawai.php",
      data: {
        fun: fun,
        id: $("#daId").val(),
        username: $("#daUsername").val(),
        password: $("#daPassword").val(),
        nama_lengkap: $("#daNama_lengkap").val(),
        alamat_ktp: $("#daAlamat_ktp").val(),
        alamat_domisili: $("#daAlamat_domisili").val(),
        no_wa: $("#daNo_wa").val(),
        tgl_lahir: $("#daTgl_lahir").val(),
        jenis_kelamin: jenis_kel,
        status_pekerja: $("#daStatus_pekerja").val(),
        id_divisi: id_divisi[0]["id"],
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          console.log(data);
          alert("berhasil nambah");
          $("#modal_pegawai").modal("hide");
          $(".modal-backdrop").remove();
        } else if (data == 2) {
          alert("berhasil edit data");
          $("#modal_pegawai").modal("hide");
          $(".modal-backdrop").remove();
        } else {
          console.log(data);
          alert("Terjadi Error");
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });
}

function set_btn_edit() {
  $(".btn_edit_pegawai").click(function () {
    $("#modal_pegawai").modal("show");
    $("#daFormdirect").attr("value", "proses_edit");
    $("#select2_posisi_pegawai").select2({
      dropdownParent: $(this).parent().parent(),
    });
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "components/admin/data_pegawai/ajax_ql_data_pegawai.php",
      data: {
        fun: "proses_get_edit",
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        $("#daId").val(data[0].id_pegawai);
        $("#daUsername").val(data[0].username);
        $("#daPassword").val(data[0].password);
        $("#daNama_lengkap").val(data[0].nama_lengkap);
        $("#daAlamat_ktp").val(data[0].alamat_ktp);
        $("#daAlamat_domisili").val(data[0].alamat_domisili);
        $("#daNo_wa").val(data[0].no_wa);
        $("#daTgl_lahir").val(data[0].tgl_lahir);
        if (data[0].jenis_kelamin == "Laki laki") {
          $("#daJK1").prop("checked", true);
        } else {
          $("#daJK2").prop("checked", true);
        }
        $("#daStatus_pekerja").val(data[0].status_pekerja);
        $("#daDivisi").val(data[0].divisi);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });
}

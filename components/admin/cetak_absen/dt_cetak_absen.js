$(document).ready(function () {
  var table_pilih_pegawai = $("#table_pilih_pegawai").DataTable({
    dom: "Bfrtip",
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50, 100, "All"],
    processing: true,
    serverSide: true,
    serverMethod: "POST",
    searching: true,
    select: {
      info: true,
    },
    buttons: [
      {
        text: "Custom Button",
        action: function (e, dt, node, config) {
          alert("Button activated");
        },
      },
    ],
    columns: [
      { data: "id" },
      { data: "nama_lengkap" },
      { data: "no_wa" },
      { data: "divisi" },
    ],
    ajax: {
      url: "components/admin/cetak_absen/ajax_select2.php",
    },
  });

  $("#select2_divisi_absensi").select2();

  $("#select2_divisi_absensi").on("change", function () {
    let getDivisiCetak = $("#select2_divisi_absensi").select2("data");
    table_pilih_pegawai.search(getDivisiCetak[0]["text"]).draw();
  });

  table_pilih_pegawai.column(0).visible(false);

  var ajax_url = "components/admin/cetak_absen/ajax_ql_cetak_absen.php";

  load_data("", "", "");

  function load_data(initial_date, final_date, no_wa) {
    var initial_date = $("#initial_date").val();
    var final_date = $("#final_date").val();
    var no_wa = $("#no_wa").val();
    $("#fetch_users").DataTable({
      dom: "Blfrtip",
      order: [[0, "desc"]],
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      buttons: [
        {
          extend: "pdfHtml5",
          text: "Download file PDF",
        },
        {
          extend: "excel",
          text: "Download file EXCEL",
        },
      ],
      processing: true,
      serverSide: true,
      stateSave: true,
      ajax: {
        url: ajax_url,
        dataType: "json",
        type: "POST",
        data: {
          action: "fetch_users",
          initial_date: initial_date,
          final_date: final_date,
          no_wa: no_wa,
        },
        dataSrc: "records",
      },
      columns: [
        { data: "no" },
        { data: "nama_lengkap" },
        { data: "hari" },
        { data: "tgl_absen" },
        { data: "masuk" },
        { data: "pulang" },
        { data: "keterangan" },
        { data: "lokasi_masuk" },
        { data: "lokasi_pulang" },
      ],
    });
  }

  $("#initial_date, #final_date").datepicker();

  $("#filter").click(function () {
    if (initial_date == "" && final_date == "" && no_wa == "") {
      $("#fetch_users").DataTable().destroy();
      load_data("", "", ""); // filter immortalize only
    } else if (initial_date == "" && final_date == "") {
      $("#fetch_users").DataTable().destroy();
      load_data("", "", no_wa); // filter immortalize only
    } else {
      var date1 = new Date(initial_date);
      var date2 = new Date(final_date);
      var diffTime = Math.abs(date2 - date1);

      var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      if (initial_date == "" || final_date == "") {
        $("#error_log").html(
          "Warning: You must select both (start and end) date.</span>"
        );
      } else {
        if (date1 > date2) {
          $("#error_log").html(
            "Warning: End date should be greater then start date."
          );
        } else {
          $("#error_log").html("");
          $("#fetch_users").DataTable().destroy();
          load_data(initial_date, final_date, no_wa);
        }
      }
    }
  });

  $("#btn_cetak_pilihan_pegawai").click(function () {
    // console.log(table_pilih_pegawai.row({ selected: true }).data().no_wa);
    var no_wa = table_pilih_pegawai.row({ selected: true }).data().no_wa;
    // table_data_absensi_cetak
    //   .search(table_pilih_pegawai.row({ selected: true }).data().no_wa)
    //   .draw();
    // console.log(no_wa);
    $("#fetch_users").DataTable().destroy();
    $("#no_wa").val(table_pilih_pegawai.row({ selected: true }).data().no_wa);
    load_data(null, null, no_wa);
  });
});

$(document).ready(function () {
  var data_login_terbaru = $("#data_login_terbaru").DataTable({
    order: [[0, "desc"]],
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    processing: true,
    serverSide: true,
    searching: false,
    paging: true,
    columns: [
      { data: "tanggal" },
      { data: "nama_lengkap" },
      { data: "jam_masuk" },
    ],
    ajax: {
      url: "components/admin/login_terbaru/ajax_login_terbaru.php",
      dataType: "json",
      type: "POST",
      dataSrc: "records",
    },
    success: function (data) {
      console.log(data);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });
});

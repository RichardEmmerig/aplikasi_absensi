$(document).ready(function () {
  var table_status_akun = $("#table_status_akun").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: {
      url: "components/admin/status_akun/ajax_status_akun.php",
      type: "POST",
      dataType: "json",
    },
    columns: [{ data: "no" }, { data: "jabatan" }, { data: "aksi" }],
  });
});

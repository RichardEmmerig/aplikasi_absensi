$(document).ready(function () {
  var table_data_divisi = $("#table_data_divisi").DataTable({
    lengthMenu: [5, 10, 25, 50, 75, 100],
    pageLength: 5,
  });

  btn_divisi_baru();
  changeModalTitle();
  set_btn_save_divisi();
  set_btn_edit_divisi();

  $(".btn_delete_divisi").click(function () {
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "ajax_ql_divisi.php",
      data: {
        fun: "proses_hapus",
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        if (data == 1) {
          alert("berhasil hapus data");
          // table_data_divisi.ajax.reload();
        } else {
          alert("Terjadi Error");
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });

  function btn_divisi_baru() {
    // table_data_divisi.ajax.reload();
    $(".select2_jabatan_divisi").select2({
      dropdownParent: $("#modal_divisi"),
    });
    $("#btn_divisi_baru").click(function () {
      changeModalTitle("Tambah Divisi");
    });
  }

  function changeModalTitle(value) {
    $("#modal-title").html(value);
  }

  function set_btn_save_divisi() {
    $("#btn_save_divisi").click(function () {
      var fun = $("#daFormdirect").val();
      $.ajax({
        type: "POST",
        url: "components/admin/divisi/ajax_ql_divisi.php",
        data: {
          fun: fun,
          id: $("#daId").val(),
          nama_divisi: $("#daNama_divisi").val(),
        },
        dataType: "JSON",
        success: function (data) {
          if (data == 1) {
            alert("berhasil nambah");
            location.reload();
          } else if (data == 2) {
            alert("berhasil edit data");
            $("#modal_jabatan").modal("hide");
            $(".modal-backdrop").remove();
            table_data_divisi.data.reload();
          } else {
            alert("Terjadi Error");
          }
        },
      });
    });
  }

  function set_btn_edit_divisi() {
    $(".btn_edit_divisi").click(function () {
      $("#modal_divisi").modal("show");
      $("#daFormdirect").attr("value", "proses_edit");
      changeModalTitle("Edit Divisi");
      const id = $(this).data("id");
      $.ajax({
        type: "POST",
        url: "ajax_ql_divisi.php",
        data: {
          fun: "proses_get_edit",
          id: id,
        },
        dataType: "JSON",
        success: function (data) {
          $("#daId").val(data[0].id_divisi);
          $("#daNama_divisi").val(data[0].divisi);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert("Status: " + textStatus);
          alert("Error: " + errorThrown);
        },
      });
    });
  }
});

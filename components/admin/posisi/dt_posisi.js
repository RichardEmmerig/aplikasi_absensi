$(document).ready(function () {
  $("#table_data_posisi").DataTable({
    lengthMenu: [5, 10, 25, 50, 75, 100],
    pageLength: 5,
  });

  btn_posisi_baru();
  changeModalTitle();
  set_btn_save_posisi();
  set_btn_edit_posisi();

  $(".btn_delete_posisi").click(function () {
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "components/admin/posisi/ajax_ql_posisi.php",
      data: {
        fun: "proses_hapus",
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          alert("berhasil hapus data");
        } else {
          console.log(data);
          alert("Terjadi Error");
        }
      },
    });
  });
});

$("#daNama_posisi").attr("disabled", "disabled");

$("#select2_posisi").change(function () {
  if ($(this).val() != "") $("#daNama_posisi").removeAttr("disabled");
});

function btn_posisi_baru() {
  $("#select2_posisi").select2({
    dropdownParent: $("#modal_posisi"),
  });
}

function changeModalTitle(value) {
  $("#modal-title").html(value);
}

function set_btn_save_posisi() {
  $("#btn_save_posisi").click(function () {
    let fun = $("#daFormdirect").val();
    let id_divisi = $("#select2_posisi").select2("data");
    $.ajax({
      type: "POST",
      url: "components/admin/posisi/ajax_ql_posisi.php",
      data: {
        fun: fun,
        id: $("#daId").val(),
        id_divisi: id_divisi[0]["id"],
        nama_posisi: $("#daNama_posisi").val(),
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          console.log(data);
          alert("berhasil nambah");
          $("#modal_posisi").modal("hide");
          $(".modal-backdrop").remove();
        } else if (data == 2) {
          alert("berhasil edit data");
          $("#modal_posisi").modal("hide");
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

function set_btn_edit_posisi() {
  $(".btn_edit_posisi").click(function () {
    $("#modal_posisi").modal("show");
    $("#daFormdirect").attr("value", "proses_edit");
    changeModalTitle("Edit Posisi");
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "components/admin/posisi/ajax_ql_posisi.php",
      data: {
        fun: "proses_get_edit",
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        $("#daId").val(data[0].id_posisi);
        $("#daNama_posisi").val(data[0].posisi);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });
}

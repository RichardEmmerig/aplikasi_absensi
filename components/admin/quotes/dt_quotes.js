$(document).ready(function () {
  $("#btn_edit_save_quotes").hide();
  $("#btn_save_quotes").show();

  var table_data_quotes = $("#table_data_quotes").DataTable({});

  $("#btn_save_quotes").click(function () {
    console.log("CLICK");
    $.ajax({
      type: "POST",
      url: "components/admin/quotes/ajax_quotes.php",
      data: {
        fun: "simpan",
        daIsiQuotes: $("#daIsiQuotes").val(),
      },
      dataType: "JSON",
      success: function (data) {
        if (data == 1) {
          alert("Quotes Berhasil Disimpan");
          location.reload();
        } else {
          alert("GAGAL : " + data);
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });

  $(".btn_edit_quotes").click(function () {
    $("#btn_edit_save_quotes").show();
    $("#btn_save_quotes").hide();
    $("#daId").val($(this).data("id"));
    $("#daIsiQuotes").val($(this).data("isi_quotes"));
  });

  $("#btn_edit_save_quotes").click(function () {
    console.log("START");
    $.ajax({
      type: "POST",
      url: "components/admin/quotes/ajax_quotes.php",
      data: {
        fun: "proses_edit",
        id: $("#daId").val(),
        daIsiQuotes: $("#daIsiQuotes").val(),
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          console.log(data);
          alert("berhasil edit data");
          location.reload();
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

  $(".btn_del_quotes").click(function () {
    const id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "components/admin/quotes/ajax_quotes.php",
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
          location.reload();
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

  // =======
});


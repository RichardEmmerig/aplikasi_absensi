$(document).ready(function () {
  if ($("#isi_pengumuman").length) {
    var quill = new Quill(document.querySelector("#isi_pengumuman"), {
      theme: "snow",
    });
  }

  let currentDate = new Date();
  let year = currentDate.getFullYear();
  let month = currentDate.getMonth() + 1; // add 1 because getMonth() returns 0-based index
  let day = currentDate.getDate();
  let hours = currentDate.getHours();
  let minutes = currentDate.getMinutes();
  let seconds = currentDate.getSeconds();

  let formattedDate = `${year}-${month}-${day}`;
  let formattedTime = `${hours}:${minutes}:${seconds}`;

  $("#txtTgl_pengumuman").val(`${formattedDate} ${formattedTime}`);

  var data_pengumuman = $("#data_pengumuman").DataTable({
    order: [[0, "desc"]],
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    processing: true,
    serverSide: true,
    searching: true,
    paging: true,
    columns: [
      { data: "no" },
      { data: "nama_pengumuman" },
      { data: "waktu_tgl_pengumuman" },
      { data: "isi_pengumuman" },
      { data: "id_pegawai" },
      { data: "aksi" },
    ],
    ajax: {
      url: "components/admin/pengumuman/ajax_pengumuman.php",
      dataType: "json",
      type: "POST",
      data: {
        fun: "fetch_pengumuman",
      },
      dataSrc: "records",
    },
    drawCallback: function (settings) {
      // success handler
      btn_edit_pengumuman();
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    },
  });

  function getQuillHtml() {
    return quill.root.innerHTML;
  }

  $("#tbh_pengumuman").on("click", function () {
    let nama_pengumuman = $("#nama_pengumuman").val();
    let waktu_tgl_pengumuman = $("#waktu_tgl_pengumuman").val();
    let isi_pengumuman = getQuillHtml();
    console.log(isi_pengumuman);
    let id_pegawai = $("#id_pegawai").val();
    $.ajax({
      type: "POST",
      url: "components/admin/pengumuman/ajax_pengumuman.php",
      data: {
        fun: "tbh_pengumuman",
        nama_pengumuman: nama_pengumuman,
        waktu_tgl_pengumuman: waktu_tgl_pengumuman,
        isi_pengumuman: isi_pengumuman,
        id_pegawai: id_pegawai,
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        if (data == 1) {
          console.log(data);
          alert("berhasil nambah");
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

  function btn_edit_pengumuman() {
    console.log("YES");
    $(".btn_edit_pengumuman").on("click", function () {
      console.log("CLICK");
      const id_pengumuman = $(this).data("id");
      window.location.href =
        "index.php?menu=form_pengumuman&id_pengumuman=" + id_pengumuman;
    });
  }

  $("#pd_perorang").on("click", function () {
    messageColorWarning();
    $(".information_alert").fadeIn();
    let teks_informasi =
      "Fitur pengumuman untuk perorang masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });

  $("#pd_perorang").on("click", function () {
    messageColorWarning();
    $(".information_alert").fadeIn();
    let teks_informasi =
      "Fitur pengumuman untuk perdivisi masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });
});

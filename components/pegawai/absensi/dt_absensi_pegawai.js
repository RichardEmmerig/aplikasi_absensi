$(document).ready(function () {
  setLeafLeaf();

  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0");
  var yyyy = today.getFullYear();
  today = dd + "-" + mm + "-" + yyyy;

  var table_data_absensi_karyawan = $("#table_data_absensi_karyawan").DataTable(
    {
      dom: "Bfrtip",
      select: true,
      scrollX: true,
      buttons: [
        {
          extend: "pdfHtml5",
          // orientation: "landscape",
          className: "buttons-pdf-datatable",
          text: "Download PDF",
          title: "Cetak Absensi " + $("#nama_akun_header").text() + " " + today,
        },
      ],
      style:
        ".buttons-pdf-datatable {background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}",
    }
  );

  var table_data_absensi_alt = $("#table_data_absensi_alt").DataTable({
    searching: false,
    ordering: false,
    scrollX: true,
  });

  $("#btn_asben").click(function () {
    if ($("#setLat").html() == "x") {
      $("#btn_asben").prop("disabled", true);
      alert(
        "Tidak Bisa Absen | Geo Latitude dan Longtitude anda belum terdeteksi"
      );
      alert("Refreash Halaman / Aplikasi");
    } else {
      $.ajax({
        type: "POST",
        url: "components/pegawai/absensi/ajax_absensi.php",
        data: {
          fun: "absenMasuk",
          daId: $("#daId").val(),
          daDate: $("#daDate").val(),
          daTime: $("#daTime").val(),
          daLat: $("#daLat").val(),
          daLong: $("#daLong").val(),
        },
        dataType: "JSON",
        success: function (data) {
          if (data == 1) {
            $.ajax({
              type: "POST",
              url: "components/pegawai/notifikasi/ajax_add_notifikasi.php",
              data: {
                target: "absenMasuk",
                nama_notifikasi: "Notifikasi Absen",
                waktu_tgl_notifikasi: daDate.value + " " + daTime.value,
                isi_notifikasi: "Absen Masuk",
              },
              dataType: "JSON",
              success: function (data) {
                if (data == 1) {
                  console.log("Notifikasi Tersimpan");
                } else {
                  alert("GAGAL : " + data);
                  console.log(data);
                }
              },
            });
            messageColorWarning();
            $("#btn_asben").attr("disabled", "disabled");
            $(".information_alert").fadeIn();
            let teks_informasi = "Anda Sudah Absen Masuk - Semangat Bekerja";
            $("#information_alert_span").html(teks_informasi);
            timeoutMessage();
          } else {
            alert("GAGAL : " + data);
            console.log(data);
          }
        },
      });
    }
  });

  $("#btn_asben2").click(function () {
    console.log($("#daLat").val());
    $.ajax({
      type: "POST",
      url: "components/pegawai/absensi/ajax_absensi.php",
      data: {
        fun: "absenPulang",
        daKegiatan: $("#daKegiatan").val(),
        daId: $("#daId2").val(),
        daDate: $("#daDate2").val(),
        daTime: $("#daTime2").val(),
        daLat: $("#daLat").val(),
        daLong: $("#daLong").val(),
      },
      dataType: "JSON",
      success: function (data) {
        if (data == 1) {
          $("#btn_asben2").attr("disabled", "disabled");
          $("#daKegiatan").attr("disabled", "disabled");
          $(".information_alert").fadeIn();
          let teks_informasi =
            "Anda Sudah Absen Pulang - Terimakasih Kerja Kerasnya";
          $("#information_alert_span").html(teks_informasi);
          timeoutMessage();
        } else {
          alert("GAGAL : " + data);
          console.log(data);
        }
      },
    });
  });

  $("#btn_buat_tugas").on("click", function () {
    messageColorWarning();
    $(".information_alert").fadeIn();
    let teks_informasi = "Fitur Buat Tugas masih dalam <b>perbaikan</b>";
    $("#information_alert_span").html(teks_informasi);
    timeoutMessage();
  });
});

// Leaflet's JS Map
function setLeafLeaf() {
  if ($("#map").length) {
    let lat, lng, accuracy, marker, cicrle, zoomed;

    const map = L.map("map");
    map.setView([51.505, -0.09], 13);

    const myAPIKey = "b916b9b6eb6b439abbd652564a0b580e";

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      apiKey: myAPIKey,
      attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    navigator.geolocation.watchPosition(success, error);

    function success(pos) {
      lat = pos.coords.latitude;
      lng = pos.coords.longitude;
      accuracy = pos.coords.accuracy;

      const reverseGeocodingUrl = `https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${lng}&apiKey=${myAPIKey}`;

      $("#setLat").html(lat);
      $("#setLong").html(lng);
      $("#daLat").val(lat);
      $("#daLong").val(lng);

      if (marker) {
        map.removeLayer(marker);
        map.removeLayer(circle);
      }

      // marker = L.marker([lat, lng]).addTo(map);
      circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

      if (!zoomed) {
        zoomed = map.fitBounds(circle.getBounds());
      }

      fetch(reverseGeocodingUrl)
        .then((result) => result.json())
        .then((featureCollection) => {
          if (featureCollection.features.length === 0) {
            document.getElementById("status").textContent =
              "The address is not found";
            return;
          }

          const foundAddress = featureCollection.features[0];
          // document.getElementById("name").value =
          //   foundAddress.properties.name || "";
          // document.getElementById("house-number").value =
          //   foundAddress.properties.housenumber || "";
          // document.getElementById("street").value =
          //   foundAddress.properties.street || "";
          // document.getElementById("postcode").value =
          //   foundAddress.properties.postcode || "";
          // document.getElementById("city").value =
          //   foundAddress.properties.city || "";
          // document.getElementById("state").value =
          //   foundAddress.properties.state || "";
          // document.getElementById("country").value =
          //   foundAddress.properties.country || "";

          $("#setKota").html(foundAddress.properties.city);
          $("#setKelurahan").html(foundAddress.properties.village);
          console.log(featureCollection.features[0]);

          if (foundAddress.properties.city != "Semarang") {
            $("#setKota").addClass("text-danger");
          } else {
            $("#setKota").addClass("text-success");
          }

          // document.getElementById(
          //   "status"
          // ).textContent = `Found address: ${foundAddress.properties.formatted}`;

          marker = L.marker(
            new L.LatLng(
              foundAddress.properties.lat,
              foundAddress.properties.lon
            )
          ).addTo(map);
        });

      map.setView([lat, lng]);
    }

    function error(err) {
      if (err.code === 1) {
        alert("Please allow Geolocation access");
      } else {
        alert("Cannot get current location");
      }
    }
  }
}

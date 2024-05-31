$(document).ready(function () {
  $(".button_absen").click(function () {
    $(".button_absen").addClass("activeLoading");
    setTimeout(function () {
      window.location.href = "index.php?menu=absensi";
    }, 2000);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const calendar = new VanillaCalendar("#calendar", {
    settings: {
      lang: "define",
      selection: {
        day: false,
      },
      // selected: {
      //   dates: ["2023-01-02", "2023-01-03", "2023-01-05"],
      // },
    },
    locale: {
      months: [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "July",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ],
      weekday: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    },
    popups: {
      "2023-01-02": {
        modifier: "bg-danger",
      },
      "2023-01-03": {
        modifier: "bg-warning",
      },
      "2023-01-05": {
        modifier: "bg-primary",
      },
    },
  });
  calendar.init();
});

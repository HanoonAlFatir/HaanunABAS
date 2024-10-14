new Chartist.Line('.chart-container', {
    labels: dates, // Data dates untuk sumbu X (label)
    series: [
      {
        name: "Terlambat",
        data: statusTerlambat, // Data untuk status Terlambat
        className: 'ct-series-a' // Opsi untuk menambahkan class
      },
      {
        name: "Alfa",
        data: statusAlfa, // Data untuk status Alfa
        className: 'ct-series-b'
      },
      {
        name: "Hadir",
        data: statusHadir, // Data untuk status Hadir
        className: 'ct-series-c'
      }
    ]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    },
    plugins: [
      Chartist.plugins.tooltip() // Plugin untuk menampilkan tooltip
    ]
  });

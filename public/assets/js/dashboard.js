$(function () {


  // =====================================
  // Profit
  // =====================================
  axios.get('/getDelegationStats')
    .then(function (response) {
      // console.log(response)
      let delegationData = response.data;
      var chart = {
        series: [
          { name: "Invitaion:", data: dataArray(delegationData, 'invitation') },
          { name: "Accepted:", data: dataArray(delegationData, 'accepted') },
        ],

        chart: {
          type: "bar",
          height: 345,
          offsetX: -15,
          toolbar: { show: true },
          foreColor: "#adb0bb",
          fontFamily: 'inherit',
          sparkline: { enabled: false },
        },


        colors: ["#5D87FF", "#49BEFF"],


        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "15%",
            borderRadius: [5],
            borderRadiusApplication: 'end',
            borderRadiusWhenStacked: 'all'
          },
        },
        markers: { size: 0 },

        dataLabels: {
          enabled: false,
        },


        legend: {
          show: true,
        },


        grid: {
          borderColor: "rgba(0,0,0,0.1)",
          strokeDashArray: 3,
          xaxis: {
            lines: {
              show: true,
            },
          },
        },

        xaxis: {
          type: "category",
          categories: dataArray(delegationData, 'country'),
          labels: {
            style: { cssClass: "grey--text lighten-2--text fill-color" },
          },
        },


        yaxis: {
          show: true,
          min: 0,
          max: 10,
          tickAmount: 4,
          labels: {
            style: {
              cssClass: "grey--text lighten-2--text fill-color",
            },
          },
        },
        stroke: {
          show: true,
          width: 3,
          lineCap: "butt",
          colors: ["transparent"],
        },


        tooltip: { theme: "light" },

        responsive: [
          {
            breakpoint: 600,
            options: {
              plotOptions: {
                bar: {
                  borderRadius: 3,
                }
              },
            }
          }
        ]


      };

      var chart = new ApexCharts(document.querySelector("#chart"), chart);
      chart.render();
    })


  // =====================================
  // Breakup
  // =====================================
  // let data;
  axios.get('/getDelegatesStats')
    .then(function (response) {
      let data = response.data;
      var breakup = {
        color: "#adb5bd",
        series: data.values,
        labels: data.names,
        chart: {
          width: 180,
          type: "donut",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        plotOptions: {
          pie: {
            startAngle: 0,
            endAngle: 360,
            donut: {
              size: '75%',
            },
          },
        },
        stroke: {
          show: false,
        },

        dataLabels: {
          enabled: false,
        },

        legend: {
          show: false,
        },
        colors: ["#5D87FF", "#ffae1f", "#E32027"],

        responsive: [
          {
            breakpoint: 991,
            options: {
              chart: {
                width: 150,
              },
            },
          },
        ],
        tooltip: {
          theme: "dark",
          fillSeriesColor: false,
        },
      };

      var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
      chart.render();
    })
    .catch(function (error) {
      console.log(error);
    })

    axios.get('/getIntlDelegatesStats')
    .then(function (response) {
      let data = response.data;
      var intlDelegation = {
        color: "#adb5bd",
        series: data.values,
        labels: data.names,
        chart: {
          width: 180,
          type: "donut",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        plotOptions: {
          pie: {
            startAngle: 0,
            endAngle: 360,
            donut: {
              size: '75%',
            },
          },
        },
        stroke: {
          show: false,
        },

        dataLabels: {
          enabled: false,
        },

        legend: {
          show: false,
        },
        colors: ["#5D87FF", "#ffae1f", "#E32027"],

        responsive: [
          {
            breakpoint: 991,
            options: {
              chart: {
                width: 150,
              },
            },
          },
        ],
        tooltip: {
          theme: "dark",
          fillSeriesColor: false,
        },
      };

      var chart = new ApexCharts(document.querySelector("#intlDelegation"), intlDelegation);
      chart.render();
    })
    .catch(function (error) {
      console.log(error);
    })



  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "#49BEFF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();
})

let deferredPrompt;

window.addEventListener('beforeinstallprompt', (event) => {
  event.preventDefault();
  deferredPrompt = event;
  showInstallButton();
});

function showInstallButton() {
  const installButton = document.getElementById('installButton'); // Replace with your button ID
  installButton.style.display = 'block';
  installButton.addEventListener('click', () => {
    installButton.style.display = 'none';
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the install prompt');
      } else {
        console.log('User dismissed the install prompt');
      }
      deferredPrompt = null;
    });
  });
}

// Custom Function for returning array with values of count
let dataArray = (data, param) => {
  let arrayToReturn = [];
  data.map((value) => {
    arrayToReturn.push(value[param])
  })
  return arrayToReturn;
}

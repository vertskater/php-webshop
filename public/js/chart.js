'use strict'

const ctx = document.querySelector('#stored-products');

(async function() {
  new Chart(ctx, {
  type: 'bar',
  data: {
    labels: data.map(row => row.name),
    datasets: [{
      label: '# stored products',
      data: data.map(row => row.in_store),
      borderWidth: 1,
      backgroundColor: '#FA8072'
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
})})();

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('components.header')



    <main>
        <canvas id="myChart"></canvas>



    </main>



    @include('components.footer')


    <script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
   type: 'bar',
   data: {
       labels: ['Enero', 'Febrero', 'Marzo'],
       datasets: [{
               label: 'Ventas',
               data: [10, 20, 30],
               backgroundColor: 'rgba(75, 192, 192, 0.2)',
               borderColor: 'rgba(75, 192, 192, 1)',
               borderWidth: 1
           }]
   }
});
    </script>


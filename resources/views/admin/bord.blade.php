@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <br>
    
 

    <!-- /.card-header -->
    <div class="content-header">
      
          
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                   <th>nombre total etudiant</th>
                   <th> admis au licences </th>
                   <th> non  admis </th>
                    
                </tr>
            </thead>
            <tbody>
              
                <tr>
                    <td>{{ $count }}</td>  
                    <td>
                       {{ $admis }}</td>
                                          
                    <td>{{ $non_admis }}</td>                  
             
            </tr>
            </tbody>
        </table>
        <div style="width: 300px; text-align: center; margin: 0 auto;">
            <canvas id="myChart" width="200px" height="100px"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie', // Type de graphique (pie, bar, line, etc.)
                    data: {
                        labels: ['Admis', 'Non Admis'], // Noms des catégories
                        datasets: [{
                            label: '# d\'étudiants',
                            data: [{{ $admis }}, {{ $non_admis }}], // Données des statistiques
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)', // Couleur pour "Admis"
                                'rgba(255, 99, 132, 0.2)'  // Couleur pour "Non Admis"
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',  // Bordure pour "Admis"
                                'rgba(255, 99, 132, 1)'   // Bordure pour "Non Admis"
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top', // Position de la légende
                            },
                            title: {
                                display: true,
                                text: 'Répartition des étudiants admis et non admis'
                            }
                        }
                    }
                });
            </script>
    </div>
</div>
         
 
    <!-- /.card-body -->
    
    <div class="card-footer clearfix">
    </div>
  
@endsection

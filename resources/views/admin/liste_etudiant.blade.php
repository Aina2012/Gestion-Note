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
                   <th>numero</th>
                   <th>nom</th>
                   <th>prenom</th>
                   <th>moyenne</th>
                   
                   
                    
                </tr>
            </thead>
            <tbody>
               @foreach ($admis as $ad )
                <tr>
                    <td>{{ $ad->id_etudiant }}</td>
                    <td>{{ $ad->nom }}</td>
                    <td>{{ $ad->prenom }}</td>
               @endforeach
            </tr>
            </tbody>
        </table>
        

    </div>
         
 
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>



@endsection
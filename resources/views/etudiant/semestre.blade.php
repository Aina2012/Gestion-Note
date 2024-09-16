@extends('layouts.menu')
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
                   <th>Semestre_id</th>
                   <th>Semestre</th>
                   <th>Moyenne</th>
                   <th>Status</th>

                    
                </tr>
            </thead>
            <tbody>
               @foreach ($semestre as $semest )
                <tr>
                    <td>{{ $semest->id_semestre }}</td>  
                    <td>
                        <a href="{{ route('semestre.notes', ['id_etudiant' => $id_etudiant, 'id_semestre' => $semest->id_semestre]) }}">{{ $semest->semestre }}</a>
                    </td>  
                    <td>{{ $semest->moyenne }}</td>                
                    <td>{{ $semest->resultat_status }}</td>                
               @endforeach
            </tr>
            </tbody>
        </table>
      
    </div>
         
 
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>

@endsection
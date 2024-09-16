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
                </tr>
            </thead>

            <tbody>
            <tr>
                <td><a href="{{ route('annee.semestre', ['id_etudiant' => $id_etudiant , 'anne' => 'L1']) }}">L1</a></td>
                <td><a href="{{ route('annee.semestre', ['id_etudiant' => $id_etudiant , 'anne' => 'L2']) }}">L2</a></td>
                <td><a href="{{ route('annee.semestre', ['id_etudiant' => $id_etudiant , 'anne' => 'L3']) }}">L3</a></td>
            </tr>
            </tbody>
        </table>
        

    </div>
         
 
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>

@endsection

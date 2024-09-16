@extends('layouts.menu')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <a href="#" style="display: block; float: right;width: 100px" class="btn btn-block bg-gradient-primary btn-sm">Export pdf</a>
    </div>
    <div class="container">
       
            <h1>Notes du Semestre</h1>
            <p>Étudiant: <b>{{ $etudiant }}</b></p>
            <p>nom : <b>{{ $nom }}</b></p>
            <p>Prenom : <b>{{ $prenom }}</b></p>
        
        
    </div>   
    <table class="table table-hover text-nowrap">
        <thead style="background-color: rgb(134, 82, 218)">
            <tr> 
                    <th>intitile</th>
                    <th>Matière</th>
                    <th>Note</th>
                    <th>Crédit</th>
                    <th>Résultat</th>
                    
                
            </tr>
        </thead>
        <tbody>
            @foreach ($resultat as $note)
                    <tr>
                        <td>{{ $note->code_matiere  }}</td>
                        <td>{{ $note->nom_matiere }}</td>
                        <td>{{ $note->note }}</td>
                        <td>{{ $note->credit_obtenu }}</td>
                        <td>{{ $note->resultat }}</td>
                    </tr>
                    
           @endforeach
        </tr>
        </tbody>
        <th >
            <td ><b>  Semestre: {{ $semestre }} </b></td>
            <td ><b>  {{ $moyenne}}  </b></td>
            <td ><b>  {{ $credit }}  </b></td>
            <td ><b>  {{ $resultat_status }}  </b></td>
        </th>
    </table>
   
</div>
     
    <div class="content-header">
@endsection
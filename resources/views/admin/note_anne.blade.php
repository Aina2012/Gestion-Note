@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <a href="#" style="display: block; float: right;width: 100px" class="btn btn-block bg-gradient-primary btn-sm">Export pdf</a>
    </div>
    <div class="container">
       
            <h1>Notes du Semestre</h1>
            <p>Étudiant: <b>{{ $etudiant }}</b></p>
            <p>nom : <b>{{ $nom }} </b></p>
            <p>Prenom : <b>{{ $prenom }}</b></p>
            
        
        
    </div>   
    @foreach ( $notes as $note)
    
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
            @foreach ( $note['note'] as $n)
                        
                    <tr>
                        <td> {{ $n->code_matiere }}</td>
                        <td>{{ $n->nom_matiere }}</td>
                        <td>{{ $n->note }}</td>
                        <td>{{ $n->credit_obtenu }}</td>
                        <td>{{ $n->resultat }}</td>
                    </tr>
                    
           @endforeach
        </tr>
        </tbody>
        <th >
                            
                <td><b>  Semestre : {{ $note['semestre'] }}</b></td>      
                <td><b>  {{ $note['moyenne'] }}     </b></td>
                <td><b>  {{ $note['credit_obtenu'] }} </b>  </td>
                <td ><b> {{ $note['resultat_status'] }}  </b></td>
            
            
        </th>
    </table> 
    
    @endforeach
        @if($moyenne_generale<10)
        <p style="text-align: center  " >moyene generale: <b style="color: red">{{ $moyenne_generale }}</b></p>        
        @else
        <p style="text-align: center " >moyene generale: <b style="color: rgb(71, 221, 91)">{{ $moyenne_generale }}</b></p> 
        @endif
        <p style="text-align: center ">resulat :<b>{{ $status }} </b></p>
        <p style="text-align: center ">credit :<b>{{ $credit_general }} </b></p>
     
   
</div>
     
    <div class="content-header">
@endsection
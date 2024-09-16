@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
       
        <a href="#" style="display: block; float: right;width: 100px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter car</a>

    </div>
    <br>
    
    <!-- /.card-header -->
    <div class="content-header">
        <div class="mb-6"> 
            <h3 style="font-family:Arial, Helvetica, sans-serif">filtre etudiant</h3>       
            <form action="{{ route('etudiant.search') }}" method="get">
                <select name="promotion"  style="width: 200px;">
                    <option value="">Sélectionnez une promotion</option>
                    {{-- @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id_prom }}">{{ $promotion->promotion }}</option>
                    @endforeach --}}
                </select>
                <input type="text" name="rechercher" id="" class="mb-6" placeholder="filtre nom">
                <input type="submit" value="ok">
            </form>
           
           </div>
           @if(isset($etudiants) && count($etudiants) > 0)
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Promotion</th>
                    <th>Numero </th>
                    <th>Nom</th>
                    <th>prenom</th>
                    <th>date_naissance</th>
                   <th></th>
                    
                </tr>
            </thead>
            <tbody>
               @foreach ($etudiants as $etude )
                <tr>
                    <td>{{ $etude->promotion }}</td>  
                    <td> {{ $etude->id_etudiant }}</td>
                    <td>{{ $etude->nom}}</td>
                    <td>{{ $etude->prenom}}</td>
                    <td>{{ $etude->date_naissance}}</td>
                    <td>
                        <a href="{{ route('semestre', ['id_etudiant' => $etude->id_etudiant])}}">
                            <button type="submit" class="btn btn-block bg-gradient-primary btn-sm" style="background-color: grey">voir semestre</button>
                        </a>
                    </td>
                   <td>
                        <a href="{{ route('voir.semestre', ['id_etudiant' => $etude->id_etudiant])}}">
                            <button type="submit" class="btn btn-block bg-gradient-primary btn-sm">voir annee</button>
                        </a>
                   </td>
               @endforeach
            </tr>
            </tbody>
        </table>
        @endif
    </div>
         
 
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>

@endsection
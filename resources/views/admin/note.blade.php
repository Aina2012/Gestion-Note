<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>car</title>
</head>
<body class="hold-transition login-page">
         <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/popup.css') }}">

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>Voiture</b></h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Note d'etudiant</p>

    <form action="{{route('car.stores')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Matiere</label>
            <select id="voiture" name="matiere_id" class="form-control">
                <option value="">matiere</option>
                @foreach($matier as $matier)
                <option value="{{ $matier->id_matiere }}">{{ $matier->nom_matiere }}</option>
                @endforeach
            </select>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
      
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">credit</label>
            <div class="input-group">
                <input type="text" class="form-control" name="credit" value="{{ old('credit') }}" placeholder="credit">
               
            </div>
            @error('credit')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="matricule" class="form-label">Note</label>
            <div class="input-group">
                <input type="number" class="form-control" name="resultat" value="{{ old('resultat') }}" placeholder="resultat">
                
            </div>
            @error('resultat')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="matricule" class="form-label">date de saisie</label>
            <div class="input-group">
                <input type="date" class="form-control" name="date_saisie" value="{{ old('date_saisie') }}" placeholder="date de saisie">
                
            </div>
            @error('date_saisie')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
       

        <div class="text-center mt-2 mb-3">
            <button type="submit" class="btn btn-success btn-block">Ajouter</button>
        </div>
    </form>
        </div>
    </div>
</div>
</html>
</body>
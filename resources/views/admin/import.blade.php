@extends('layouts.admin')
@section('content')
{{-- content --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> IT-University</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Inserer un données csv</h5>
                        </div>
                        {{-- form --}}
                        <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="file">Fichier de configuration</label>
                                    <input type="file" class="form-control" id="file" name="configuration" accept=".csv" placeholder="Bien">
                                </div>
                                
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Importer</button>
                            </div>
                            
                        </form>
                        <form action="{{ route('import.note') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                               
                                <div class="form-group">
                                    <label for="filedevis">Fichier de note</label>
                                    <input type="file" class="form-control" id="filedevis" name="note" accept=".csv" placeholder="Location">
                               
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Importer</button>
                            </div>
                        </form>
                        {{-- --}}
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
{{-- --}}
@endsection

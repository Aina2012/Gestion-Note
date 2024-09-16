<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Matiere</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Krosy</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">ajouter matiere</p>

                <form action="#" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom Point de vente</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nomm" placeholder="Nom">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="emaila" value="{{ old('email') }}" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">mot de Passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>
                      
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Cofirme Mot de Passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passworda" name="password_confirmation" placeholder="Mot de Passe">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>
                    
                    </div>


                    <div class="text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-success btn-block">Valider</button>
                    </div>
                </form>

                <!-- /.social-auth-links -->
               
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.j') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">


                           <a href="#">
                                    <img src="{{asset("images/Eiffage_2400_02_black_RGB.png")}}" class="col-sm-9" alt="PRO-RH">
                                </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <label>Photo</label>
                                <input class="au-input au-input--full {{ $errors->has('photo') ? ' is-invalid' : '' }}" type="file" name="photo" id="photo" placeholder="Photo">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">

                                <label>Nom</label>
                                <input class="au-input au-input--full {{ $errors->has('nom') ? ' is-invalid' : '' }}" type="text" name="nom" placeholder="Nom" required>
                                @if ($errors->has('nom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Prénoms</label>
                                <input class="au-input au-input--full {{ $errors->has('prenoms') ? ' is-invalid' : '' }}" type="text" name="prenoms" placeholder="Prenoms" required>
                                @if ($errors->has('prenoms'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prenoms') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Adresse E-mail</label>
                                <input class="au-input au-input--full {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mot de passe (8 caractères minimum)</label>
                                <input class="au-input au-input--full {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" id="mdp" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Confirmer mot de passe</label>
                                <input class="au-input au-input--full {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" id="confmdp" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Enregistrer</button>

                        </form>
                        <div class="register-link">
                            <p>
                                J'ai déjà un compte
                                <a href="{{route('login')}}">Connectez - vous</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>
<script>
    $('#confmdp').on('change',function (e) {
        var  confmdp=$('#confmdp').val();
        var  mdp=$('#mdp').val();
        if(mdp!=confmdp){
            $('#confmdp').val('');
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log(input.files[0]);
                console.log(input.files[0].type);
                if(input.files[0].type=="image/jpeg" || input.files[0].type=="image/png" ){
                    if(input.files[0].size<=1000024){

                        console.log('cool');
                        $('#rendu_img').attr('src', e.target.result);
                    }else{
                        alert('trop volumineux');

                        input.value='';
                        $('#rendu_img').attr('src','images/user.png');
                    }
                }else{
                    alert('le ficher doit être de type jpeg ou png exclusivement');

                    input.value='';
                    $('#rendu_img').attr('src','images/user.png');
                }


            }

            reader.readAsDataURL(input.files[0]);

        }else{
            $('#rendu_img').attr('src','images/user.png');
        }
    }

    $("#photo").change(function() {
        readURL(this);
    });

</script>
</body>

</html>
<!-- end document-->
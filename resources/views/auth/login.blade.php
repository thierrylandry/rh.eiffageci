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
    <title>SE CONNECTER - PRO-RH</title>

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
                                   <img src="{{asset("images/Eiffage_2400_02_black_RGB.png")}}" alt="CoolAdmin" class="col-sm-9">
                               </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Adresse E-mail</label>
                                <input class="au-input au-input--full" type="email" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input class="au-input au-input--full" type="password" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Entité</label></div>
                                <div class="col-12 col-md-9">

                                    <select data-placeholder="Sélectionner un projet..." class="standardSelect form-control" tabindex="1" name="id_chantier" id="chantier">

                                    </select>
                                </div>
                            </div>
                            <div class="login-checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Se souvenir de moi
                                </label>
                                <label>
                                    <a href="{{ route('password.request') }}">Mot de passe  oublié?</a>
                                </label>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">CONNEXION</button>
                        </form>
                        <div class="register-link">
                            <p>
                                Vous n'avez pas de compte ?
                                <a href="{{ route('register') }}">Créez-en un</a>
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
    jQuery(document).ready(function() {
        var email=jQuery('#email').val();
        jQuery("#chantier").html('');
        jQuery.get("liste_chantier/"+email,function(data) {
            console.log(data);
            //   console.log(data);

            var option="";
            jQuery.each(data,function(index, value){
                option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
            });
            //alert(option);

            jQuery("#chantier").html(option);

        });

        jQuery("#email").change(function (){
            var email=jQuery('#email').val();
            jQuery("#chantier").html('');
            jQuery.get("liste_chantier/"+email,function(data) {
                console.log(data);
                //   console.log(data);

                var option="";
                jQuery.each(data,function(index, value){
                    option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                });
                //alert(option);

                jQuery("#chantier").html(option);

            });
        });
        /*
        jQuery("#password").change(function (){
            var email=jQuery('#email').val();
            jQuery("#chantier").html('');
            jQuery.get("liste_chantier/"+email,function(data) {
                console.log(data);
                //   console.log(data);

                var option="";
                jQuery.each(data,function(index, value){
                    option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                });
                //alert(option);

                jQuery("#chantier").html(option);

            });
        })*/
        jQuery("#chantier").click(function (){

            var email=jQuery('#email').val();
            if(email==''){
                jQuery("#chantier").html('');
                jQuery.get("liste_chantier/"+email,function(data) {
                    console.log(data);
                    //   console.log(data);

                    var option="";
                    jQuery.each(data,function(index, value){
                        option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                    });
                    //alert(option);

                    jQuery("#chantier").html(option);

                });
            }

        })
    });
</script>
</body>

</html>
<!-- end document-->
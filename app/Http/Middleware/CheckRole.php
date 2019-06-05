<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return response("Insufficient permissions", 401);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }
        return redirect()->route('erreur');
      /*  return response("<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | 404 :: w3layouts</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<meta name=\"keywords\" content=\"Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design\" />
<script type=\"application/x-javascript\"> addEventListener(\"load\", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel=\"stylesheet\" href=\"{{ URL::asset('css/bootstrap.min.css') }}\" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href=\"css/style.css\" rel='stylesheet' type='text/css' />
<link href=\"css/style-responsive.css\" rel=\"stylesheet\"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel=\"stylesheet\" href=\"css/font.css\" type=\"text/css\"/>
<link href=\"css/font-awesome.css\" rel=\"stylesheet\"> 
<!-- //font-awesome icons -->
<script src=\"js/jquery2.0.3.min.js\"></script>
</head>
<body>
<!--main content start-->
<div class=\"eror-w3\">
	<div class=\"agile-info\">
		<h3>Désolé</h3>
		<h2>401</h2>
		<p>Permission Inssuffisante</p>
		<a href='#' onClick='javascript:history.back();'>Retour en arrière</a>
	</div>
</div>
<script src=\"js/bootstrap.js\"></script>
<script src=\"js/jquery.dcjqaccordion.2.7.js\"></script>
<script src=\"js/scripts.js\"></script>
<script src=\"js/jquery.slimscroll.js\"></script>
<script src=\"js/jquery.nicescroll.js\"></script>
<!--[if lte IE 8]><script language=\"javascript\" type=\"text/javascript\" src=\"js/flot-chart/excanvas.min.js\"></script><![endif]-->
<script src=\"js/jquery.scrollTo.js\"></script>
</body>
</html>", 401);
      */
    }

}


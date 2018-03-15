<!doctype html>

<html lang="en" ng-app="application">

<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>SIPEC - Sistema de Prestação de Eletrônica de Contas</title>

<link href="css/foundation.css"  rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.min.css" rel="stylesheet" type="text/css" />
<link href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css' rel='stylesheet' type='text/css'>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="container">        
            <form class="log-in-form" action="">
					<h4 class="text-center">Insira suas credenciais</h4>
						<label>Email:
								<input type="email" placeholder="Email">
						</label>
						<label>Senha:
							<input type="password" placeholder="Senha">
						</label>
					<input id="show-password" type="checkbox"><label for="show-password">Relembre-me</label>
					<p><input type="submit" class="button expanded" value="Log in"></input></p>
					<p class="text-center"><a href="#">Perdeu sua senha?</a></p>
					<a href="<?php echo url('prestacao/public/sipec') ?>">acesso direto</a>
			</form> 

</div>

<script src="js/jquery.js"></script>
<script src="js/foundation/foundation.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  $(document).foundation();
  
});

</script>

</body>
</html>
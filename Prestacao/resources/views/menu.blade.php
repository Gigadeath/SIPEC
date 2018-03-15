<!doctype html>
<html>
<head>

<?php
	$actual_link = "$_SERVER[REQUEST_URI]";
	$sub_link=substr($actual_link,18);
	
?>

<meta charset="UTF-8"	>
<title>SIPEC - Sistema de Prestação de Eletronica de Contas <?php  echo $active;?></title>

<link href="<?php echo url('prestacao/public/')?>/css/foundation.css"  rel="stylesheet" type="text/css">
<link href="<?php echo url('prestacao/public/')?>/css/style.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" rel="stylesheet" type="text/css">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="<?php echo url('prestacao/public/')?>/js/select2.js"></script>
<link href="<?php echo url('prestacao/public/')?>/css/select2.css" rel="stylesheet"/>


</head>

<body>

<div class="row expanded">

    <div class="small-12 medium-12 large-2 columns" id="sidebar">
        
        <div id="logo" class="show-for-large text-center"><a href ="index.html"><img src="<?php echo url('prestacao/public/')?>/images/logo.png"></a></div>

        <div data-responsive-toggle="sidebar" data-hide-for="large"><button class="button text-center success expanded" type="button" data-toggle><strong>CLOSE</strong></button></div>

        <ul class="side-nav vertical menu" data-accordion-menu data-multi-open="false">          

          <li><a href="#"><i class="fi-page-multiple"></i> Cadastro</a>
            <ul class="menu vertical <?php 	if($active >=1 && $active<=10){echo "is-active";}?>">
              <li><a href="<?php echo url('prestacao/public/CadFuncionario')?>"<?php  if($active==2){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Funcionario</a></li>
              <li><a href="<?php echo url('prestacao/public/CadMantenedora') ?>"<?php  if($active==3){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Mantenedora</a></li>              
              <li><a href="<?php echo url('prestacao/public/CadDre') ?>" <?php  if($active==4){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> DRE</a></li>
              <li><a href="<?php echo url('prestacao/public/CadUnidade') ?>" <?php  if($active==5){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Unidades</a></li>
              <li><a href="<?php echo url('prestacao/public/CadLancamento') ?>" <?php  if($active==6){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Lançamentos</a></li>
              <li><a href="<?php echo url('prestacao/public/CadFornecedor') ?>" <?php  if($active==7){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Fornecedor</a></li>
              <li><a href="<?php echo url('prestacao/public/CadProduto') ?>" <?php  if($active==8){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Produto</a></li>
              <li><a href="<?php echo url('prestacao/public/CadCotacao') ?>" <?php  if($active==9){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Cotação</a></li>
			  <li><a href="<?php echo url('prestacao/public/CadNota') ?>" <?php  if($active==10){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Nota Fiscal</a></li>
            </ul>
          </li>
		  
		   <li><a href="#"><i class="far fa-address-card"></i> Consulta</a>
            <ul class="menu vertical <?php if($active >=11 && $active<=19){echo "is-active";}?>">
              <li><a href="<?php echo url('prestacao/public/ConFuncionario') ?>" <?php  if($active==11){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Funcionario</a></li>
              <li><a href="<?php echo url('prestacao/public/ConMantenedora') ?>" <?php  if($active==12){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Mantenedora</a></li>              
              <li><a href="<?php echo url('prestacao/public/ConDre') ?>" <?php  if($active==13){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> DRE</a></li>
              <li><a href="<?php echo url('prestacao/public/ConUnidade') ?>" <?php  if($active==14){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Unidades</a></li>
              <li><a href="<?php echo url('prestacao/public/ConLancamento') ?>" <?php  if($active==15){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Lançamentos</a></li>
              <li><a href="<?php echo url('prestacao/public/ConFornecedor') ?>" <?php  if($active==16){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Fornecedor</a></li>
              <li><a href="<?php echo url('prestacao/public/ConProduto') ?>"<?php  if($active==17){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Produto</a></li>
              <li><a href="<?php echo url('prestacao/public/ConCotacao') ?>" <?php  if($active==18){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Cotação</a></li>
			  <li><a href="<?php echo url('prestacao/public/ConNota') ?>" <?php  if($active==19){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Nota Fiscal</a></li>
            </ul>
          </li>
		  
		  <li><a href="#"><i class="fas fa-book"></i> Relatórios</a>
            <ul class="menu vertical <?php 	if($active >=20 && $active<=22){echo "is-active";}?>">
              <li><a href="<?php echo url('prestacao/public/RelatorioAliRe') ?>" <?php  if($active==20){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Relatório de Alimentos Restritos</a></li>
              <li><a href="<?php echo url('prestacao/public/RelatorioJustificativa') ?>" <?php  if($active==21){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i>Relatório de Justificativa</a></li>              
              <li><a href="<?php echo url('prestacao/public/RelatorioLancamento') ?>" <?php  if($active==22){echo "style='background: #695298'";}?>><i class="fa fa-angle-right"></i> Relatório de Lançamentos</a></li>
            </ul>
          </li>

        </ul> 

    </div>
 <?php 
	use App\Http\Controllers\TipoProdutoController;
	use App\Http\Controllers\ProdutoController;
	use App\Http\Controllers\MedidaController;
	
	?>
	
	<div class="medium-12 large-10 columns" id="main">        

        <!-- header -->
        
        <div id="header" class="expanded row bg-grey">

            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>

            

        </div> 

        <!-- Breadcrumb -->

          <div class="expanded row" id="breadcrumb">
            <div class="columns large-12 gray">Home <i class="fa fa-angle-right"></i> Page</div>
          </div>

          <!-- Begin content area --> 
		  <?php
		  
			if(Session::has('success'))
			{
				echo "<div class='callout success' data-closable style='width:100%'><h5> Produto Cadastrado</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
				Session::forget('success');
				echo "</div>";
			}
			if(Session::has('alert'))
			{
				echo "<div class='callout alert' data-closable style='width:100%'><h5>Erro!!!</h5>".Session::get('alert')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
				Session::forget('alert');
				echo "</div>";
			}
			
			if(Session::has('dados'))
			{
				$dados= Session::get('dados');
				Session::forget('dados');
			}
			
			if(Session::has('erro'))
			{
					$erro=Session::get('erro');
					Session::forget('erro');
			}
				
				
			?>
			<div class="expanded row margin-top-20">

            <div class="columns large-12">        
            <h2>Produto</h2></div> 
            </div> 
				<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Consulta</h4><br>
				</div>
			
				<div class="columns large-4">  
				
				</div>
			
				<div class="columns large-4">  
				</div>
			
		</div>
		<div class="columns large-12"> 
			
				<label align="center"><input type="search" id="search" onchange="loadProdutos(1)" name="search" placeholder="Insira o nome do produto" > </label><br>
			
		</div>
		
		<div class="columns large-12">
			<table style="width:100%">
				<thead>
					<th>#</th>
					<th>Nome</th>
					<th>Tipo</th>
					<th>Ações</th>
				</thead>
				<tbody id="produtos">
				
				</tbody>
			</table>
		<div class="row" id="row">
		
		</div>
		</div>	
          <div class="expanded row margin-top-20">

            <div class="columns large-12">        
            <h2>Cadastro de Produto</h2></div> 
            </div> 

          
		   <form action="<?php echo url('prestacao/public/CadProduto/create'); ?>" method ="POST">
		   <?php echo csrf_field()."<br>";?>
				<div class="expanded row margin-top-20">
			<div class="columns large-4">        
				<label>
					Nome:	
					<input type="text" name="nome[]"  placeholder="Insira o nome"<?php if(isset($dados)){echo "value='".$dados['nome']."'";}if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
				</label><br>
				
				
			
			</div>
			
			<div class="columns large-4">
				<div class="large-12 cell">
					<label>Tipo Produto</label>
						<select id="selectTipo" name="codTipoProduto[]"<?php if(isset($dados)){echo "value='".$dados['codTipoProduto']."'";}if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
							<?php
								
								echo TipoProdutoController::show(null,'combo');
							?>
						</select>		
				</div>
				
			</div>
			<div class="columns large-4"> 
				<div class="large-12 cell">
					
						
						<!-- unidades padroes 
								mililitro ml 
								litro l 
								grama g 
								kilo grama kg 
								--> 
						
				</div>
			</div>
				
				
			
			</div>
			<br>
				<button type="submit" class="success button">Cadastrar</button>
				
				<button type="button"  class="alert button">Cancelar</button>
		 </form>
          <!-- End content area -->
    </div>
	<script>
		$(document).ready(function() {
			$(document).foundation();
			$('#selectTipo').select2();
			$(document).foundation();
			$('#selectMed').select2();
		});
	</script>
	<script> 
	
	loadProdutos(1);
	function loadProdutos(page)
	{
		var busca=$('#search').val();
	if(  busca == '')
	{
		busca ='';
	}
	else
	{
		busca=$('#search').val();
		
	}
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/table');  ?>',
			data: { pagination: page,search: busca},
			success: function (response) 	
			{
				$('#produtos').html(response);
			}
		});
		
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/page');  ?>',
			data: {pagination: page,search: busca},
			success: function (response) 	
			{
				$('#row').html(response);
			}
		});
	}
	</script>
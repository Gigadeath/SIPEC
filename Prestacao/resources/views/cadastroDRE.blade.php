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
				echo "<div class='callout success' data-closable style='width:100%'><h5>DRE Cadastrada</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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
            <h1>Cadastro de DRE</h1>
            </div> 

          </div> 
		  <form action="<?php echo url('prestacao/public/CadDre/create'); ?>" method ="POST">
		   <?php echo csrf_field()."<br>";?>
			<div class="expanded row margin-top-20">

			<div class="columns large-4">        
				<label>
					Nome:
					<input type="text" name="nome"  placeholder="insira o nome da DRE" <?php if(isset($dados)){echo "value='".$dados['nome']."'";} if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
				</label><br>
			</div>
			<div class="columns large-4">
				<label>
					Telefone:
						<input type="text" name="telefone" class="Telefone" placeholder="(00) 0000-0000" <?php if(isset($dados)){echo "value='".$dados['telefone']."'";} if(isset($erro)==true && $erro=='4'){echo "style='border:1px solid red'";}?>><br>
					</label><p class="help-text" id="passwordHelpText">Ex: 55 119xxxx-xxxx</p>
				<label>
					</div>
				<div class="columns large-4">        
					<label>
					Email:
						<input type="email" name="email" placeholder="Insira o Email" <?php if(isset($dados)){echo "value='".$dados['email']."'";} if(isset($erro)==true && $erro=='2'){echo "style='border:1px solid red'";}?>>
					</label><br>	
				</div>  
			</div>
			<div class="columns large-12">        
				<h5>Endereço</h5>
            </div>
			<div class="columns large-12">
				<div class="columns large-4">
					<label>
						CEP:
						<input type="text" name="cep" id="cep" class="CEP" placeholder="00000-000" onblur="pesquisacep(this.value);" <?php if(isset($dados)){echo "value='".$dados['cep']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
					
					<label>
						Cidade:
						<input type="text" name="cidade" id="cidade" readonly <?php if(isset($dados)){echo "value='".$dados['cidade']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Rua:
						<input type="text" name="rua" id="rua"  readonly <?php if(isset($dados)){echo "value='".$dados['rua']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br><label>
						Estado:
						<input type="text" name="uf" id="uf"  readonly <?php if(isset($dados)){echo "value='".$dados['uf']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Bairro:
						<input type="text" name="bairro" id="bairro"  readonly <?php if(isset($dados)){echo "value='".$dados['bairro']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br><label>
						IBGE:
						<input type="text" name="ibge" id="ibge"  readonly <?php if(isset($dados)){echo "value='".$dados['ibge']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				</div>
				<div class="columns large-4">
				</div>
					<div class="columns large-4">
						<button type="submit" class="success button">Cadastrar</button>
						<button type="button" class="alert button">Cancelar</button> 
					</div>
						<div class="columns large-4"></div>
				
				
		 </form>
          <!-- End content area -->
    </div>
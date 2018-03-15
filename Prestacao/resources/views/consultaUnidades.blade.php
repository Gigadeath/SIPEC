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

          <div class="expanded row margin-top-20">

            <div class="columns large-12">        
            <h1>Consulta de Unidades</h1>
            </div> 

          </div> 
		  <form>
			<div class="expanded row margin-top-20">

			<div class="columns large-4">        
				<label>
					Nome:	
					<input type="text" name="Nome"  placeholder="Insira o nome" disabled>
				</label><br>
				<label>
				Email:
					<input type="password" name="Senha" placeholder="Insira um Email" disabled>
				</label><br>
				
				<label>Diretor:</label>
						<select disabled>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
				
				
				
			</div>
			
			<div class="columns large-4">        
				<label>
					INEP:
					<input type="text" name="INEP" class="INEP" placeholder="00000000" disabled>
				</label><br>
				
				
				<div class="grid-x grid-padding-x">
				 <div class="large-12 cell">
						<label>Mantenedor</label>
						<select disabled>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
						
				 </div>
				 </div>
				 <div class="grid-x grid-padding-x">
				 <div class="large-12 cell">			
						<br><label>Coordenador:</label>
						<select disabled>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
				 </div>
				 </div>
				
			</div>
			<div class="columns large-4"> 
				<label>
					CNPJ:
					<input type="text" name="CNPJ" class="CNPJ" placeholder="00.000.000/0000-00" disabled>
				</label><br>
				<label>
					Telefone:
						<input type="text" name="Telefone" class="Telefone" placeholder="55 (00) 0000-0000" disabled><br>
				</label>
				<label>DRE:</label>
						<select disabled>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
			</div>
				
				
			
			</div>
			<div class="columns large-12">        
				<h5>Endereço</h5>
            </div>
			<div class="columns large-12">
				<div class="columns large-4">
					<label>
						CEP:
						<input type="text" name="cep" id="cep" readonly>
					</label><br>
					
					<label>
						Cidade:
						<input type="text" name="cidade" id="cidade" readonly>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Rua:
						<input type="text" name="rua" id="rua"  readonly>
					</label><br><label>
						Estado:
						<input type="text" name="uf" id="uf"  readonly>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Bairro:
						<input type="text" name="bairro" id="bairro"  readonly>
					</label><br><label>
						IBGE:
						<input type="text" name="ibge" id="ibge"  readonly>
					</label><br>
				</div>
				</div>
			<br>
				<!--<button type="button" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button> -->
		 </form>
          <!-- End content area -->
    </div>
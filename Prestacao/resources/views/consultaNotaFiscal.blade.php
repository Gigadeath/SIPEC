    <div class="medium-12 large-10 columns" id="content">        

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
            <h1>Consulta da Nota</h1>
			<br>
			
			<label>Metodo de digitação:</label>
                <input type="radio" name="escolha" value="automatico" id="aut"><label for="aut">Automatico</label>
                <input type="radio" name="escolha" value="manual" id="man"><label for="man">Manual</label>
            </div> 

          </div> 
		  
		  <form method="post">
			<div class="expanded row margin-top-20">

			<div class="columns large-3">        
				<label>
					N° da Nota:	
					<input type="text" name="Nota"  placeholder="Insira o numero da nota" disabled>
				</label><br>
			</div>
			
			<div class="columns large-3">        
				<label>
					Data Emissão:
					<input type="date" name="Data" disabled >
				</label><br>
				
			</div>
			<div class="columns large-3"> 
				<label>
					Valor Nota:  
				</label>
				<input type="text" name="Total" value="100,00" disabled><br>
			</div>
				
				
			<div class="columns large-3">
			<label>Fornecedor:</label>
						<select disabled>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
			</div>
			</div>
			<br>
					
		    
			
			<table style="width:100%">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Qtde</th>
					<th>Valor Unitário</th>
					<th>Cotações</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody id="Produtos">
				
			</tbody>
			</table>
			
			<!--<p><a href="#" class="secondary button" name="addVar">+</a></p><br> -->
				

		
				<!--<br><button type="button" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button> -->
		 </form>
		
          <!-- End content area -->
    </div>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;


class Lancamento extends Model
{
    protected $fillable = array('Total','Repasse','Saldo','codUnid');
	protected $table = 'tbllancamento';
	
	public function Unidade() {
        return $this->belongsTo('App\Unidade');
    }
	
	public function NotasFiscais() {
        return $this->hasMany('App\NotaFiscal','codLanca');
    }
	
		public function Cotacoes() {
        return $this->hasMany('App\Cotacao','codLancamento');
    }
	
	public static function ConsultaLancamentos()
	{
		if(Session::has('codUnid'))
		{
			try
			{
				$count=0;
				$unid=\Session::get('codUnid');
				$lancamento=Lancamento::where('codUnid','=',$unid)->get();	
						
				$html="<div class='columns large-12'>";
				
		
				foreach ($lancamento as $lancamento) 
				{
					$count++;
					
					if ($count==4)
					{
						$html.="</div>";
							$html.="<div class='columns large-12' style='margin-top:2%'>";
							$html.="<div class='columns large-4'>";
							$html.="<a href='http://www.gticchamados.tk/prestacao/public/ConLancamento/".$lancamento->id."'>";
							$html.="<table style='width:100%;border:3px solid #2C3E50'>";
							$html.="<tr>";
							$html.="<td>Data de Inicio: ".$lancamento->Inicio."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Data de Fim: ".$lancamento->Fim."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Repasse: ".$lancamento->Repasse."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Saldo utilizado: ".$lancamento->Saldo."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td> Total: ".$lancamento->Total."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td> Status: </td>";
							$html.="</tr>";
							$html.="</table>";
							$html.="</a>";
							$html.="</table>";
							$html.="</div>";
						$count==0;
					}
					else
					{
						$html.="<div class='columns large-4'>";
							$html.="<a href='http://www.gticchamados.tk/prestacao/public/ConLancamento/".$lancamento->id."'>";
							$html.="<table style='width:100%;border:3px solid #2C3E50'>";
							$html.="<tr>";
							$html.="<td>Data de Inicio: ".$lancamento->Inicio."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Data de Fim: ".$lancamento->Fim."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Repasse: ".$lancamento->Repasse."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td>Saldo utilizado: ".$lancamento->Saldo."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td> Total: ".$lancamento->Total."</td>";
							$html.="</tr>";
							$html.="<tr>";
							$html.="<td> Status: </td>";
							$html.="</tr>";
							$html.="</table>";
							$html.="</a>";
							$html.="</div>";
					}
					
				}
				$html.="</div>";
				\Session::forget('codUnid');
				return $html;
			}catch(\Error $e) 
			{ 
				echo $e->getMessage();
			}catch(\Throwable $e) 
			{			
				echo $e->getMessage();
			}
		}
	}
	
	public static function consultaDetalhada($id)
	{
		
		$lancamento=Lancamento::where('id','=',$id)->get();
		$unidade=Unidade::where('id','=',$lancamento[0]->codUnid)->get();
		$lanca = array("id" => $lancamento[0]->id,
							"Inicio" => $lancamento[0]->Inicio,
							"Fim"=> $lancamento[0]->Fim,
							"Total"=> $lancamento[0]->Total,
							"Repasse" => $lancamento[0]->Repasse,
							"Saldo" => $lancamento[0]->Saldo,
							"Unid" => $unidade[0]->nome);
							
		Session::put('lancamento', $lanca);
		$notas=NotaFiscal::where('codLanca','=',$id)->get();

		$html="<tbody>";
		foreach ($notas as $nota)
		{
			$html.="<tr>";
			$html.="<td>".$nota->numero."</td>";
			$html.="<td>".$nota->emissao."</td>";
			$html.="<td>".$nota->valor."</td>";
			$html.="<td>".$nota->Descontos."</td>";
			$html.="<td>".$nota->Total."</td>";
			$fornecedor=Fornecedor::where('id',$nota->codFornecedor)->get();
			$html.="<td>".$fornecedor[0]->nome."</td>";
			$html.="</tr>";
		}

		$html.="</tbody>";
		
		return $html;
	}
	
	
	
	
}
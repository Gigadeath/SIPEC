$(document).ready(function(){
  $("input.RG").mask("99.999.999-9", {reverse: false});
  $("input.CPF").mask("999.999.999-99", {reverse: false});
  $("input.RF").mask("999.999-9", {reverse: false});
  $('input.CNPJ').mask('00.000.000/0000-00', {reverse: true});
  $("input.CEP").mask("00000-000", {reverse: false});
  $('input.Telefone').mask('(00) 90000-0000');
   $(document).foundation();
  
});
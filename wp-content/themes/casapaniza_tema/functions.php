<?php
/*add_filter('single_template', mifuncion);

function mifuncion($t){
	d($t);
	if(get_post_type()=="menu_concertado"){
	return TEMPLATEPATH . "/single-{$cat->term_id}.php";  
}
	return $t;
	
	}*/
/*************************************
 Devuelve una cadena con la fecha que se 
 le manda como parámetro en formato largo.
 *************************************/
function FechaFormateada($FechaStamp){
$ano = date('Y',$FechaStamp); //<-- Año
$mes = date('m',$FechaStamp); //<-- número de mes (01-31)
$dia = date('d',$FechaStamp); //<-- Día del mes (1-31)
$dialetra = date('w',$FechaStamp);  //Día de la semana(0-7)
switch($dialetra){
case 0: $dialetra="Domingo"; break;
case 1: $dialetra="Lunes"; break;
case 2: $dialetra="Martes"; break;
case 3: $dialetra="Miércoles"; break;
case 4: $dialetra="Jueves"; break;
case 5: $dialetra="Viernes"; break;
case 6: $dialetra="Sábado"; break;
}
switch($mes) {
case '01': $mesletra="Enero"; break;
case '02': $mesletra="Febrero"; break;
case '03': $mesletra="Marzo"; break;
case '04': $mesletra="Abril"; break;
case '05': $mesletra="Mayo"; break;
case '06': $mesletra="Junio"; break;
case '07': $mesletra="Julio"; break;
case '08': $mesletra="Agosto"; break;
case '09': $mesletra="Septiembre"; break;
case '10': $mesletra="Octubre"; break;
case '11': $mesletra="Noviembre"; break;
case '12': $mesletra="Diciembre"; break;
}    
return "$dialetra, $dia de $mesletra de $ano";
}
//$fecha = time();
//echo FechaFormateada($fecha);

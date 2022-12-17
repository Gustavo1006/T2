// JavaScript Document
function MostrarFecha()   
   {   
   var nombres_dias = new Array("Domingo", "Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado")
   var nombres_meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre")
   var fecha_actual = new Date()
  
   dia_mes = fecha_actual.getDate()
   dia_semana = fecha_actual.getDay()
   mes = fecha_actual.getMonth() + 1  
   anio = fecha_actual.getFullYear() 
	document.write(nombres_dias[dia_semana] + ", " + dia_mes + " de " + nombres_meses[mes - 1] + " de " + anio)   
   }
function hora(){
	var fecha = new Date()
	var hora = fecha.getHours()
	var minuto = fecha.getMinutes()
	var segundo = fecha.getSeconds()
	if (hora < 10) {hora = "0" + hora}
	if (minuto < 10) {minuto = "0" + minuto}
	if (segundo < 10) {segundo = "0" + segundo}
	var horita = hora + ":" + minuto + ":" + segundo
	document.getElementById('hora').firstChild.nodeValue = horita
	tiempo = setTimeout('hora()',1000)
}
function inicio(){
	document.write('<span id="hora">')
	document.write ('000000</span>')
	hora()
}
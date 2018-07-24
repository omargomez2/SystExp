<?php 
//Configuración general
$config = array(
	"titulo"=>"experiment?",
	"subtitulo"=>"Start",
	"url"=>"http://{$_SERVER['HTTP_HOST']}/celControl/", //Con / al final
	//"url" => "http://localhost/simpleCMS/",
	"charset"=>"utf-8",

	"friendlyurls"=>false,

	//Datos para la configuracion del envio de correo
	"emailadmin"=>"",
	"emailenvios"=>"",
	"nombreenvios"=>"experiment?",
	"servidor"=>"localhost",
	"basedatos"=>"basesystexp",
	"usuario"=>"root",
	"pass"=>"",
	"googleanalytics"=>false,//Codigo UA- usado en las analiticas de Google
	"googlesiteverification"=>false,
	"mssiteverification"=>false
	); ?>
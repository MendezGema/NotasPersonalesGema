<?php
header('Access-Control-Allow-Origin: *');//linea necesaria para poder convertir a "json"
header("Content-Type: application/json");// linea necesaria [lineas necesrias que te ayudan a leer todo esto y convertirlo a una aplicacion json]
 $todo=array();//se crea un arreglo [almacenara la infromacion de mis txt que estan en el servidor de intelibans]
 $i=0; // se crea una variable de tipo entero
$directorio = opendir("../"); //ruta actual  [opendir sirve para abrir todas las carpetas que se encuentre la carpeta]  se crea variable directorio y decimos que todo lo que este en la carpeta lo mande al directorio q es nuestra variable
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes 
    }
    else
    {
        chmod($archivo, 0755);//el servidor le da los permisos para que pueda leer los archivos solo leer
   $pos = strpos($archivo, "AppGema-0");//lee solo los archivos que empiesen con PAP-E y los demas los omite
   $pos2 = strpos($archivo, ",v");//omite los archivos txt con terminacion  "v"  el v es el respaldo de los topicos
   $pos3 = strpos($archivo, ".lease");// es un respaldo del topico q se crea
     if($pos!==false&&$pos2===false&&$pos3===false){ 
   $campos=explode('%META:FORM{name="GemaDalinaNotasPendientesForm"}%',file_get_contents("../".$archivo));// explode divide los arcivos en sub arreglos  despues obtiene lo que contenga el archivo que este caso SON LOS TOPICOS  y omite los punto list 
    $n=count($campos);//count variable definida en php  n= al contador 
   $campo=explode('%META:FIELD{',$campos[$n-1]);// los metafield son todas las variales q estand entro del archivo 

   $Nombre=explode('"',$campo[1]);//  las variables son los metafield nombre fecha descripcion 
   $Fecha=explode('"',$campo[2]);
   $Descripcion=explode('"',$campo[3]);
   
	 	$todo[]=array("Nombre"=>utf8_encode ($Nombre[7]), "Fecha"=>utf8_encode ($Fecha[7]), "Descripcion"=> ($Descripcion[7]));
	
     $i++;
   }
    }
}
echo json_encode($todo);// convierte todo y lo muestra en formato json
?>


 
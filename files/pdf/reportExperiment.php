
<?php


include "../fpdf/fpdf.php";
include"../inc/comun.php";
header("Content-Type: text/html; charset=iso-8859-1 ");

if (isset($_POST['ex'])) {
	
class Mipdf extends FPDF
{
	
	function Header()
	{
		
		
	}
	
	function Footer()
		{
			// Go to 1.5 cm from bottom
			$this->SetY(-15);
			// Select Arial italic 8
			$this->SetFont('Arial','I',8);
			// Print centered page number
		$this->Cell(0,10,'Page '.$this->PageNo().' /{nb}',0,0,'C');
		}
}
	
		$mipdf = new Mipdf();		
		$mipdf -> AliasNbpages();
		$mipdf -> addPage();
		$x1=$_POST['nombreexp'];
		$bd = new GestarBD;		
		
		
		$mipdf -> Setfont('Arial','B',15);
		$mipdf -> Ln (2);
		$mipdf -> Cell(200,10,"General report",0,0,'C');
		$mipdf -> Ln (15);
		
		$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
										$bd->consulta($consult);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
											$mipdf -> Setfont('Arial','B',10);		
											$mipdf -> Cell(40,12,"Experiment Name: ",0,0,'L');											
											$mipdf -> Cell(40,10,$fila['description'],0,0,'L');											
											$mipdf -> Ln (5);									
											$mipdf -> Setfont('Arial','B',10);		
											if($fila['typedesign']==1)
											{
												$mipdf -> Cell(40,12,"Experiment design:",0,0,'L');												
												$mipdf -> Cell(40,10," Factorial",0,0,'L');
											}
											else
											{
												$mipdf -> Cell(40,12,"Experiment design:",0,0,'L');											
												$mipdf -> Cell(40,10,"Reapeated measures",0,0,'L');											
											}								
										}
		$mipdf -> Ln (15);
		
		$mipdf -> Setfont('Arial','B',10);		
			$consulta4="SELECT id,name FROM technique";										 
										$bd->consulta($consulta4);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$techs[$fila[id]]=$fila[name];									
										}
			$consulta5="SELECT id,filename FROM program";										 
										$bd->consulta($consulta5);										
										$program=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$program[$fila[id]]=$fila[filename];									
										}
			
								
     $consulta="SELECT * FROM assigment where idexperiment='$x1' ORDER BY idfile";
     $bd->consulta($consulta);
	 $assigment1=array();
	 $assigns=array();
	 $i=0;
     while ($datos=$bd->mostrarRegistros()) {
		 $assigment1['id']=$datos['id'];
		 $assigment1['idsubject']=$datos['idsubject'];
		 $assigment1['idtech']=$datos['idtech'];
		 $assigment1['idfile']=$datos['idfile'];		
		 $assigns[$i]=$assigment1;
		 $i++;
	 }
	 
	 
	 	$consult="SELECT typedesign FROM experiment where id='$x1'";										 
										$bd->consulta($consult);		
										while ($fila=$bd->mostrarRegistros()) {
											$typeAux=$fila["typedesign"];
										}
	 
	 
	 
	 
	 //IMPRIMIR LOS DATOS
	 
		$aux=0;
		$flat=1;
		
	 foreach($assigns as $datos)
	 {
		 if($typeAux==2)
		{
			if( $aux!= $datos["idfile"])
			{
				$aux=$datos["idfile"]; 	
				$mipdf -> SetFillColor(0, 191, 255);
				$mipdf -> Cell(175,10,"Sesion ".$flat,1,0,'C',true);
				$flat++;
				$mipdf -> Ln(10);
			}
		}
		
	 
		 $id=0;
		 $id=$datos['id'];
		 			$mipdf -> SetFillColor(0, 191, 255);
					$mipdf -> Cell(45,10,"Participant Id: ",1,0,'L',true);
					$mipdf -> Cell(130,10,$datos['idsubject'],1,0,'L');					
					$mipdf -> Ln(10);					
					$mipdf -> Cell(45,10,"Program: ",1,0,'L',true);
					$fil=$program[$datos['idfile']];
					$mipdf -> Cell(130,10,"$fil",1,0,'L');										
					$mipdf -> Ln (10);
					
 switch ($datos['idtech']){
			 
			 case 1:
			 
			 		$mipdf -> Cell(45,10,"Technique:",1,0,'L',true);
					$mipdf -> Cell(130,10,"Code reading",1,0,'L');
					$mipdf -> Ln(10);
					$mipdf -> Cell(175,10,"Task 1 out of 2",1,0,'L',true);
					$mipdf -> Ln(10);						
					$mipdf -> Cell(175,10,"Abstraction",1,0,'C');
					$mipdf -> Ln(10);	
										
					
					
					$consulta2="SELECT * FROM abstraction where idassign='$id'";
					
					$bd->consulta($consulta2);
					
					$mipdf -> Cell(45,10,"Line Number",1,0,'L',true);
					$mipdf -> Cell(130,10,"Description",1,0,'L',true);					
					$mipdf -> Ln(10);
					
					while ($datos2=$bd->mostrarRegistros()) 
					{
					$mipdf -> Cell(45,10,"$datos2[numline]",1,0,'L');
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[description]")),1,'L');					
					$mipdf -> Ln(10);
					}
					
					$consulta2="SELECT * FROM inconsistency where idassign='$id'";
					$bd->consulta($consulta2);										
					$mipdf -> Cell(175,10,"Task 2 out of 2",1,0,'L',true);
					$mipdf -> Ln(10);						
					$mipdf -> Cell(175,10,"Detected Inconsistencies",1,0,'C');					
					$mipdf -> Ln(10);	
					
					
					
					
					
					
					
										
					$mipdf -> Ln(10);	
					
					
					while ($datos2=$bd->mostrarRegistros()) {
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(45,10,"Expected result",1,0,'C',true);
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[expected]")),1,'C');
					$mipdf -> Cell(45,10,"Line Numbers",1,0,'C',true);
					$mipdf -> Cell(130,10,utf8_decode(strip_tags("$datos2[numline]")),1,'C');
					$mipdf -> Cell(45,10,"Description",1,0,'C',true);
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[description]")),1,'C');
					
					$mipdf -> Cell(30,10,"Found",1,0,'C',true);
					if($datos2['found']==0){
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(30,10,"Not",1,0,'C');
					}
					else{
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(30,10,"Yes",1,0,'C');						
					}
					$mipdf -> Cell(45,10,"Level",1,0,'C',true);
					if($datos2['level']==1){
					
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(70,10,"Not sure",1,0,'C');
					}
					else {
						if($datos2['level']==2) {
							$mipdf -> SetFont('ARIAL','B', 9);			
							$mipdf -> Cell(70,10,"Partially sure",1,0,'C');
							} 
							else 
							{ 
								$mipdf -> SetFont('ARIAL','B', 9);			
								$mipdf -> Cell(70,10,"Sure",1,0,'C');								
							} 
						}					
					$mipdf -> Ln (10);
					
						
					}					
							 
			 break;
			 case 2:
					$mipdf -> Cell(45,10,"Technique: ",1,0,'L',true);
					$mipdf -> Cell(130,10,"White Box",1,0,'L');
					$mipdf -> Ln(10);
					$mipdf -> Cell(175,10,"Task 1 out of 2",1,0,'L',true);
					$mipdf -> Ln(10);					
					$mipdf -> Cell(175,10,"STRUCTURAL TEST DATA",1,0,'C');
					$mipdf -> Ln(10);
																
					$mipdf -> SetFillColor(0, 191, 255);
			 						
					$consulta2="SELECT * FROM testcase where idassign='$id'";
					
					$bd->consulta($consulta2);
					
					while ($datos2=$bd->mostrarRegistros()) {
					$mipdf -> Cell(45,10,"Aim of test case",1,0,'C',true);											
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[aim]")),1,'C');					
					$mipdf -> Cell(45,10,"Test data",1,0,'C',true);										
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[testdata]")),1,'C');										
					$mipdf -> Cell(45,10,"Actual Output",1,0,'C',true);
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[output]")),1,'C');					
					$mipdf -> Ln (10);
					}
					
					$consulta2="SELECT testcase.aim,failure.expected,failure.description,failure.found,failure.level 
					FROM failure 
					INNER JOIN testcase ON testcase.id=failure.num
					where testcase.idassign='$id'";
					$bd->consulta($consulta2);
					$mipdf -> Ln (10);	
					$mipdf -> Cell(175,10,"Task 2 out of 2",1,0,'L',true);
					$mipdf -> Ln(10);						
							
					
					while ($datos2=$bd->mostrarRegistros()) 
					{						
					$mipdf -> Cell(45,10,"Test case",1,0,'C',true);					
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[aim]")),1,'C');					
					
					$mipdf -> Cell(45,10,"Expected result",1,0,'C',true);										
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[expected]")),1,'C');
					
					$mipdf -> Cell(45,10,"Short description",1,0,'C',true);										
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[description]")),1,'C');
					
					$mipdf -> Ln (10);	
					
					
					$mipdf -> Cell(30,10,"Found",1,0,'C',true);
					if($datos2['found']==0)
					{
						
						
						$mipdf -> Cell(30,10,"Not",1,0,'C');
					}
					else{
						
						$mipdf -> Cell(30,10,"Yes",1,0,'C');						
					}
					$mipdf -> Cell(45,10,"Level",1,0,'C',true);
					if($datos2['level']==1){
					
					
					$mipdf -> Cell(70,10,"Not sure",1,0,'C');
					}
					else {
						if($datos2['level']==2) {
					
							$mipdf -> Cell(70,10,"Partially sure",1,0,'C');
							} 
							else 
							{ 
					
								$mipdf -> Cell(70,10,"Sure",1,0,'C');								
							} 
						}					
					$mipdf -> Ln (10);
					
					}					
			 
			 break;
			 case 3:
			 		$mipdf -> Cell(45,10,"Technique: ",1,0,'L',true);
					$mipdf -> Cell(130,10,"Black Box",1,0,'L');
					$mipdf -> Ln(10);					
					$mipdf -> Cell(175,10,"Task 1 out of 4",1,0,'L',true);
					$mipdf -> Ln(10);									 		
					$mipdf -> Cell(175,10,"Equivalence class",1,0,'C');										
					$mipdf -> Ln (10);
					$mipdf -> SetFillColor(0, 191, 255);
					
					
					
					
					
					
					$consulta2="SELECT * FROM equivalenceclass where idassign='$id'";
					
					$bd->consulta($consulta2);
					$aa=1;
					while ($datos2=$bd->mostrarRegistros()) {
					$mipdf -> Cell(20,10,"Nr",1,0,'C',true);	
					$mipdf -> Cell(20,10,"$aa",1,0,'C');
					$mipdf -> Cell(35,10,"Class type ",1,0,'C',true);														
					if($datos2['valid']==1){
						$mipdf -> Cell(100,10,"Valid",1,0,'C');					
					}
					else
					{
						$mipdf -> Cell(100,10,"Invalid",1,0,'C');					
					}
						$mipdf -> Ln (10);
						$aa++;
						$mipdf -> Cell(45,10,"Description",1,0,'C',true);					
						$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[description]")),1,'C');		
						$mipdf -> Ln (10);
					}
					
					
					$consulta2="SELECT * FROM testcasebb where idassign='$id'";
					$bd->consulta($consulta2);
					$mipdf -> Ln (10);	
					$mipdf -> Cell(175,10,"Task 2-3 out of 4",1,0,'L',true);
					$mipdf -> Ln(10);						
					$mipdf -> SetFillColor(0, 191, 255);
					$mipdf -> Cell(175,10," Test case ",1,0,'C');					
					$mipdf -> Ln (10);			
					
					
					
					while ($datos2=$bd->mostrarRegistros()) {
					$mipdf -> Cell(45,10," T. C. Nr.",1,0,'C',true);					
					$mipdf -> Cell(130,10,"$datos2[num]",1,0,'C');
					$mipdf -> Ln (10);
					$mipdf -> Cell(45,10,"Test data",1,0,'C',true);					
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[testdata]")),1,'C');
					$mipdf -> Cell(45,10,"Output",1,0,'C',true);					
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[output]")),1,'C');
					$mipdf -> Cell(45,10,"Actual output",1,0,'C',true);										
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[actualoutput]")),1,'C');
					$mipdf -> Ln (10);
					}
					
					
					$consulta2="SELECT * FROM failureblackbox where idassign='$id'";
					$bd->consulta($consulta2);				
					$mipdf -> Ln(10);											
					$mipdf -> Cell(175,10,"Task 4 out of 4",1,0,'L',true);
					$mipdf -> Ln(10);						
					$mipdf -> Cell(175,10," Failures",1,0,'C');					
					$mipdf -> Ln (10);	
					$mipdf -> SetFillColor(0, 191, 255);
					
					
					
															
					
					
					
					while ($datos2=$bd->mostrarRegistros()) 
					{						
					$mipdf -> Cell(20,10,"Nr.",1,0,'C',true);					
					$mipdf -> Cell(155,10,"$datos2[num]",1,0,'C');				
					$mipdf -> Ln (10);	
					$mipdf -> Cell(45,10,"Description",1,0,'C',true);										
					$mipdf -> Multicell(130,10,utf8_decode(strip_tags("$datos2[description]")),1,'C');				
					
					$mipdf -> Cell(30,10,"Found",1,0,'C',true);
					if($datos2['found']==0){
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(30,10,"Not",1,0,'C');
					}
					else{
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(30,10,"Yes",1,0,'C');						
					}
					$mipdf -> Cell(45,10,"Level",1,0,'C',true);
					if($datos2['level']==1){
					
					$mipdf -> SetFont('ARIAL','B', 9);			
					$mipdf -> Cell(70,10,"Not sure",1,0,'C');
					}
					else {
						if($datos2['level']==2) {
							$mipdf -> SetFont('ARIAL','B', 9);			
							$mipdf -> Cell(70,10,"Partially sure",1,0,'C');
							} 
							else 
							{ 
								$mipdf -> SetFont('ARIAL','B', 9);			
								$mipdf -> Cell(70,10,"Sure",1,0,'C');								
							} 
						}					
					
					$mipdf -> Ln (10);
					
					
					}

			 break;
			 
		 }					
		$mipdf -> Ln (10);
		 
		 
	 }
								
	
		$mipdf -> Ln(10);
		$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fecha=$fila['fecha'];
					}					
		
		$mipdf -> cell(178,5,"Report date : $fecha" , 0 , 10, true);
		
		
		$mipdf -> Output();
}
?>

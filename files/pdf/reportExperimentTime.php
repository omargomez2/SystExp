
<?php


include "../fpdf/fpdf.php";
include"../inc/comun.php";

if (isset($_POST['ex'])) {
	
class Mipdf extends FPDF
{
	
	function Header()
	{
		$x1=$_POST['nombreexp']; //Es el codigo 
		$bd = new GestarBD;	
		$this -> Setfont('Arial','B',15);
		$this -> Ln (2);
		$this -> Cell(180,10,"Report of times",0,0,'C');
		$this -> Ln (10);
		
		$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
										$bd->consulta($consult);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
											$this -> Setfont('Arial','B',10);		
											$this -> SetFillColor(0, 191, 255);
											$this -> Cell(35,12,"Experiment name: ",0,0,'L');											
											$this -> Cell(30,10,$fila['description'],0,0,'L');											
											$this -> Ln (10);									
											$this -> Setfont('Arial','B',10);		
											if($fila['typedesign']==1)
											{
												$this -> SetFillColor(0, 191, 255);
												$this -> Cell(35,12,"Type Design:",0,0,'L');												
												$this -> Cell(35,10,"Factorial",0,0,'L');												
											}
											else
											{
												$this -> SetFillColor(0, 191, 255);
												$this -> Cell(35,12,"Type Design:",0,0,'L');											
												$this -> Cell(35,10,"Reapeat measures",0,0,'L');											
											}
											
																				
										}
										$this -> Ln (11);							
											$this -> Setfont('Arial','B',8);		
											$this -> SetFillColor(0, 191, 255);
											$this -> Cell(10,9,"Nr ",1,0,'C',true);											
											$this -> Cell(30,9,"Program ",1,0,'C',true);											
											$this -> Cell(30,9,"Date ",1,0,'C',true);																						
											$this -> Cell(30,9,"Start ",1,0,'C',true);																						
											$this -> Cell(30,9,"End ",1,0,'C',true);																						
											
											
			$consult="SELECT program.filename,exp_prog.dateexp,exp_prog.hourstart,exp_prog.hourend
			FROM exp_prog 
			INNER JOIN program ON program.id=exp_prog.idfile
			where idexp='$x1'";		
			
										$bd->consulta($consult);																				
										$aa=0;
										while ($fila=$bd->mostrarRegistros()) {
											$this -> Ln (9);			
											$aa++;
												$this -> Cell(10,9,"$aa",1,0,'C');												
												$this -> Cell(30,9,$fila['filename'],1,0,'C');												
												$this -> Cell(30,9,$fila['dateexp'],1,0,'C');												
												$this -> Cell(30,9,$fila['hourstart'].":00",1,0,'C');												
												$this -> Cell(30,9,$fila['hourend'].":00",1,0,'C');												
												
										}
											
		
		
		
			$this -> Ln (15);							
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(10,10,"Nr",1,0,'C',true);
						
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(50,10,"Participant",1,0,'C',true);
						
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(10,10,"Tech.",1,0,'C',true);
		
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(35,10,"Program",1,0,'C',true);		

			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(15,10,"Task 1",1,0,'C',true);
			
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(15,10,"Task 2",1,0,'C',true);
			
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(15,10,"Task 3",1,0,'C',true);
			
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(15,10,"Task 4",1,0,'C',true);
			
			$this -> SetFillColor(0, 191, 255);
			$this -> SetFont('ARIAL','B', 8);			
			$this -> Cell(15,10,"Total",1,0,'C',true);
			$this -> Ln (10);
			
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
			$techs[1]="C.R.";		
			$techs[2]="W.B.";		
			$techs[3]="B.B.";		
			$typeAux=0;
			$consult="SELECT typedesign FROM experiment where id='$x1'";										 
										$bd->consulta($consult);		
										while ($fila=$bd->mostrarRegistros()) {
											$typeAux=$fila["typedesign"];
										}
			
							
			$consulta5="SELECT id,filename FROM program";										 
										$bd->consulta($consulta5);										
										$program=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$program[$fila[id]]=$fila[filename];									
										}
			$consulta6="SELECT user.id as id,user.usuario as name FROM assigment Inner Join user On assigment.idsubject=user.id where idexperiment='$x1'";										 
										$bd->consulta($consulta6);										
										$participant=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$participant[$fila[id]]=$fila[name];									
										}
			
												
										
										
			$aux=0;							
			$sql="SELECT session.numtask,session.task1,session.task2,session.task3,assigment.idsubject,assigment.idtech,assigment.idfile
			FROM  session 
			inner join assigment on session.idassign=assigment.id 
			where assigment.idexperiment='$x1' ORDER BY assigment.idfile";
			$sql2=$bd->consulta($sql);
			
		
		
		$aux=0;
		$flat=1;
	while ( $datos = $bd-> mostrarRegistros($sql2))
	{
		if($typeAux==2)
		{
			if( $aux!= $datos["idfile"])
			{
				$aux=$datos["idfile"]; 	
				$mipdf -> SetFillColor(0, 191, 255);
				$mipdf -> Cell(180,10,"Sesion ".$flat,1,0,'C',true);
				$flat++;
				$mipdf -> Ln(10);
			}
		}
		
	
	
		$num;
		$numtask=$datos['numtask'];
		$hora1=$datos['task1'][11].$datos['task1'][12];		
		$hora2=$datos['task2'][11].$datos['task2'][12];
		$hora3=$datos['task3'][11].$datos['task3'][12];
		$minutos1=$datos['task1'][14].$datos['task1'][15];		
		$minutos2=$datos['task2'][14].$datos['task2'][15];
		$minutos3=$datos['task3'][14].$datos['task3'][15];
		$segundos1=$datos['task1'][17].$datos['task1'][18];		
		$segundos2=$datos['task2'][17].$datos['task2'][18];
		$segundos3=$datos['task3'][17].$datos['task3'][18];
		
		$val1=round((((int)($hora2) - (int)($hora1))*60 + ((int)($minutos2) - (int)($minutos1))+ ((int)($segundos2)-(int)($segundos1))/60),2);
		$val2=round((((int)($hora3) - (int)($hora2))*60 + ((int)($minutos3) - (int)($minutos2))+ ((int)($segundos3)-(int)($segundos2))/60),2);
		$val3=$val1+$val2;
		$idsubject=$datos['idsubject'];
		$idtech=$datos['idtech'];		
		$idfile=$datos['idfile'];	
		
		$p=$participant[$idsubject];
		$t=$techs[$idtech];
		$pro=$program[$idfile];
		
		

 
  $num++;  
			if($datos['numtask']==0){
			$mipdf -> Cell(10,5,"$num",1,0,'C');	
			$mipdf -> Cell(50,5,"$p",1,0,'C');
			$mipdf -> Cell(10,5,"$t",1,0,'C');	
			$mipdf -> Cell(35,5,"$pro",1,0,'C');
			$mipdf -> Cell(15,5,"$val1",1,0,'C');
			$mipdf -> Cell(15,5,"$val2",1,0,'C');							
			$aux=$val3;
			
			}
			else
			{
				$mipdf -> Cell(15,5,"$val1",1,0,'C');
				$mipdf -> Cell(15,5,"$val2",1,0,'C');
				$aux=$aux+$val1+$val2;				
				$mipdf -> Cell(15,5,"$aux",1,0,'C');
				$mipdf -> Ln(5);
				$aux=0;
			}
			
			if($idtech==1 || $idtech==2)
			{
				$mipdf -> Cell(15,5,"0",1,0,'C');					
				$mipdf -> Cell(15,5,"0",1,0,'C');					
				$mipdf -> Cell(15,5,"$val3",1,0,'C');					
				$mipdf -> Ln(5);
				
			}
			
		}
		
		$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fecha=$fila['fecha'];
					}					
			
		$mipdf -> Ln(10);
		$mipdf -> cell(178,5,"Report date : $fecha" , 0 , 10, true);		
		$mipdf -> Output();
		

			
	

}
?>

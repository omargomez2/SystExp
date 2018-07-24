
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
		$this -> Cell(180,10,"List of participants report",0,0,'C');
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
		$typeAux=0;
		$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
										$bd->consulta($consult);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
											$mipdf -> Setfont('Arial','B',10);		
											$mipdf -> SetFillColor(0, 191, 255);
											$mipdf -> Cell(35,12,"Experiment name: ",0,0,'L');											
											$mipdf -> Cell(30,10,$fila['description'],0,0,'L');											
											$mipdf -> Ln (10);									
											$mipdf -> Setfont('Arial','B',10);		
											if($fila['typedesign']==1)
											{
												$mipdf -> SetFillColor(0, 191, 255);
												$mipdf -> Cell(35,12,"Experiment design:",0,0,'L');												
												$mipdf -> Cell(35,10,"Factorial",0,0,'L');												
											}
											else
											{
												$mipdf -> SetFillColor(0, 191, 255);
												$mipdf -> Cell(35,12,"Experiment design:",0,0,'L');											
												$mipdf -> Cell(35,110,"Reapeated measures",0,0,'L');											
											}
											
											$typeAux=$fila["typedesign"];
										}
										$mipdf -> Ln (11);							
											$mipdf -> Setfont('Arial','B',8);		
											$mipdf -> SetFillColor(0, 191, 255);
											$mipdf -> Cell(10,9,"Nr ",1,0,'C',true);											
											$mipdf -> Cell(30,9,"Program ",1,0,'C',true);											
											$mipdf -> Cell(30,9,"Date ",1,0,'C',true);																						
											$mipdf -> Cell(30,9,"Start time",1,0,'C',true);																						
											$mipdf -> Cell(30,9,"End time",1,0,'C',true);																						
											
											
			$consult="SELECT program.filename,exp_prog.dateexp,exp_prog.hourstart,exp_prog.hourend
			FROM exp_prog 
			INNER JOIN program ON program.id=exp_prog.idfile
			where idexp='$x1'";		
			
										$bd->consulta($consult);																				
										$aa=0;
										while ($fila=$bd->mostrarRegistros()) {
											$mipdf -> Ln (9);			
											$aa++;
												$mipdf -> Cell(10,9,"$aa",1,0,'C');												
												$mipdf -> Cell(30,9,$fila['filename'],1,0,'C');												
												$mipdf -> Cell(30,9,$fila['dateexp'],1,0,'C');												
												$mipdf -> Cell(30,9,$fila['hourstart'].":00",1,0,'C');												
												$mipdf -> Cell(30,9,$fila['hourend'].":00",1,0,'C');												
												
										}
											
		
		
			$mipdf -> Ln (15);							
			$mipdf -> SetFont('ARIAL','B', 9);			
			$mipdf -> SetFillColor(0, 191, 255);			
			$mipdf -> Cell(10,10,"Id",1,0,'C',true);						
			$mipdf -> Cell(80,10,"Participant",1,0,'C',true);
			$mipdf -> Cell(40,10,"E-mail",1,0,'C',true);
			$mipdf -> Cell(15,10,"Tech.",1,0,'C',true);					
			$mipdf -> Cell(40,10,"Program",1,0,'C',true);					
			$mipdf -> Ln (10);
			
	
		
			
							
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
			$sql="SELECT user.id,user.usuario,user.correo, assigment.idtech,assigment.idfile
			FROM  user
			inner join assigment on user.id=assigment.idsubject 
			where assigment.idexperiment='$x1' ORDER BY assigment.idfile ";
			$sql2=$bd->consulta($sql);
			$mipdf -> Setfont('Arial','B',9);			
		
		$aux=0;
		$flat=1;
	while ( $datos = $bd-> mostrarRegistros($sql2))
	{
		if($typeAux==2)
		{
			if( $aux!= $datos["idfile"])
			{
				$aux=$datos["idfile"]; 	
				$mipdf -> Cell(185,10,"Sesion ".$flat,1,0,'C',true);
				$flat++;
				$mipdf -> Ln(10);
			}
		}
		
		$mipdf -> Cell(10,10,$datos[id],1,0,'C');
		$mipdf -> Cell(80,10,$participant[$datos['id']],1,0,'L');
		$mipdf -> Cell(40,10,$datos['correo'],1,0,'L');
	switch($datos[idtech]){
			case 1:
			$mipdf -> Cell(15,10,"C.R.",1,0,'C');
			break;
			case 2:
			$mipdf -> Cell(15,10,"W.B.",1,0,'C');
			break;
			case 3:
			$mipdf -> Cell(15,10,"B.B",1,0,'C');
			break;			
		}
		$mipdf -> Cell(40,10,$program[$datos['idfile']],1,0,'C');
			
		$mipdf -> Ln(10);
		
	
			
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

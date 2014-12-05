<?php

require_once('configuration.php');
require_once('functions.php');
include('connect.php');

?>
<!doctype html>
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dom'House</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/style.css">

</head> 
<body>

<?php

$idUser = $_GET['u_id'];
$login = $_GET['login'];
$mdp = $_GET['mdp'];
$piece= $_GET['piece'];

?>

<!-- Ici c'est le tableau des objets qui sont branchés au Raspberry et qui sont donc contrôlables, ce n'est donc PAS les objets "allumés/éteints" mais juste les objets pouvant être contrôlés -->
<div class="tab">

<?php 

?>
	<h2>  Les objets contrôlables  </h2>
	
	<table class="materialTab">
		<tr>
			<th>Objet</th>
			<th>PIN</th>
			<th>Etat</th>
		</tr><?php 	
		
		//$rq= mysql_query('select * from user where login ="'.$login.'"') or die('Erreur SQL ! rq<br />'.mysql_error()); 
		//$user= mysql_fetch_array($rq);
		//mysql_free_result ($rq);

//echo $user["idUser"];
		
		$sql = 'SELECT * FROM equipement WHERE piece = "'.$piece.'" and statut = "1" order by label';
		/*$sql = 'select * from equipement  
where idEquip in (select idEquip from eq_grp
where idGrp in (select idGrp from userGrp where idUser = '.$idUser.') ) 
or idEquip in (select idEquip from user_eq where idUser = '.$idUser.')
and piece = "'.$piece.'" and statut = 1
order by label'; */

		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		while ($data = mysql_fetch_array($req)) { 
		
			//$req1 = mysql_query('select * from user_eq where idUser ='.$idUser.'  and idEquip ='.$data["idEquip"].'') or die('Erreur SQL !<br /> req1 <br />'.mysql_error()); 
			//$us_eq= mysql_fetch_array($req1);
			//mysql_free_result ($req1); 
			//echo $us_eq['acces'];
			
	     //If ($us_eq["acces"] == 1){ ?>
			<tr>
				<td><?php echo $data['label']; ?></td>
				<td><?php echo $data['Pins']; ?></td> 
				<td>
					   
					   <?php$pinState = getPinState($data['Pins'],$pins); ?> 
					   <?php //if ($us_eq["acces"] == 1){ ?>
						<div onclick="changeState(<?php echo $data['Pins']; ?>,this)" class="pinState <?php echo $pinState; ?>"></div>
						<?php// }else { echo '<div class "pinState '.$pinState.'"></div>';} ?>
					</td>
			</tr>
<?php
		 // }
		} ?>
	</table> <br/><br/>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>

		
		
<?php //Fermture de la connexion a la BDD
	mysql_free_result ($req);
	mysql_close (); 
?>
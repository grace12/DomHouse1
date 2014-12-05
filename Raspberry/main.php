<?php
require_once('configuration.php');
require_once('functions.php');
include('connect.php');
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dom'House </title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/style.css">

</head> 
<body>
<?php



echo'<div class="tab"> ';
	if (!empty ($_GET['piece']) ){
  $pc= $_GET['piece'];
  echo '<h2>'.$pc.'</h2>'; 
   
$rq= mysqli_query($linkRaspberry,'select * from user where login ="'.$_SESSION['login'].'"'); 
$user= mysqli_fetch_array($rq,  MYSQLI_ASSOC));
mysqli_free_result ($req);
$req = mysqli_query($linkRaspberry,'select * from equipement where piece ="'.$pc.'"  and statut = "1"') or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 

echo '<table class="table">
<tr>
   <th><b><i>nom équipement</i></b></th>
   <th><b><i>Etat</i></b></th>
</tr>';

while ($data = mysqli_fetch_array($req,  MYSQLI_ASSOC)) { 
	$req1 = mysqli_query($linkRaspberry,'select * from user_eq where idUser ='.$user["idUser"].'  and idEquip ='.$data["idEquip"].''); 
	$us_eq= mysqli_fetch_array($req1,  MYSQLI_ASSOC));
	mysqli_free_result ($req1);

	 If ($us_eq["acces"] == 1){
?>
			<tr>
				<td><?php echo $data['label']; ?></td>
				
			<?phpif($data['Pins']==11) {
					$on =1; $off =0;?>
					<td>
						<div onclick="changeState2(<?php echo $on; ?>,this)" class="pinState2"> </div>
											
						<div onclick="changeState2(<?php echo $off; ?>,this)" class="pinState3"> </div>
					</td><?php 
				} 
				else
				{
					$pinState = getPinState($data['Pins'],$pins); ?> 
					<td>
						<div onclick="changeState(<?php echo $data['Pins']; ?>,this)" class="pinState <?php echo $pinState; ?>"></div>
					</td><?php 
				}?>
			</tr><?php 
// Libération des résultats 
 
		}
}		?>
	</table> <br/><br/>
</div>


<?php
mysqli_free_result ($req);

/*
if (!empty ($_GET['piece']) ){
  $pc= $_GET['piece'];
  echo '<h2>'.$pc.'</h2>'; 
   
$rq= mysqli_query($linkRaspberry,'select * from user where login ="'.$_SESSION['login'].'"'); 
$user= mysqli_fetch_array($rq,  MYSQLI_ASSOC));
mysqli_free_result ($req);
$req = mysqli_query($linkRaspberry,'select * from equipement where piece ="'.$pc.'"  and statut = "1"'); 

echo '<table class="table"><tr><td>
    <b><i>nom équipement</i></b>
    </td><td>
    <b><i>Etat</i></b>
    </td></tr>';

while ($data = mysqli_fetch_array($req,  MYSQLI_ASSOC)) {
// on affiche les résultats

 $req1 = mysqli_query($linkRaspberry,'select * from user_eq where idUser ='.$user["idUser"].'  and idEquip ='.$data["idEquip"].''); 
 $us_eq= mysqli_fetch_array($req1,  MYSQLI_ASSOC));
 mysqli_free_result ($req1);

 If ($us_eq["acces"] == 1){
    echo '<tr> <td>';
	echo '<a href="panel_gestion.php">'.$data['label'].'</a>';
	echo'</td><td>';
	$sql = mysqli_query($linkRaspberry,'SELECT Pins,actif FROM equipement WHERE label = "'.$data["label"].'"')or die('Erreur SQL !<br />'.mysql_error());
	$dt = mysqli_fetch_array($sql,  MYSQLI_ASSOC);
	mysqli_free_result ($sql);
	//echo $dt['Pins'];
	$pinState = getPinState($dt['Pins'],$pins); ?> 
	<div onclick="changeState(<?php echo $dt['Pins']; ?>,this)" class="pinState <?php echo $pinState; ?>"></div>
					
	<?php
	//=> fonctionne pas car je ne suis pas sur le raspberry??
	echo'</td></tr>'; 
 }
}
echo'</table> <br>';

	// Libération des résultats 
 mysqli_free_result ($req);
 
 
}
*/

?>
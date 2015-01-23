<?php echo 'lol<br/>';

$db = mysqli_connect("localhost","nadir","","nrohoold") or die("Error " . mysqli_error($db));

/*
$sql_old = "SELECT * FROM Client";
$req_old = mysqli_query($db, $sql_old);
while($data = mysqli_fetch_assoc($req_old)){
	//echo $data['idPaki'];
	
	if($data['sexe']=='Mr') $sexe = 1; else $sexe = 0;
	$pass = '$2y$13$cf2a5jk84dckck0o4gccwuuS0WE8iArTW3T.P9Vdg3khykgOelVHa';
	
	$sql = "INSERT INTO user 
	(enabled,locked,expired,salt,password,credentials_expired,username,username_canonical,email,email_canonical,last_login,deposit,
	gender,born,phone,firstname,secondename,roles,ip,id)
	VALUE 
	(1,0,0,'cf2a5jk84dckck0o4gccw0gcw8o40o0','".$pass."',
	0,'".$data['email']."','".$data['email']."','".$data['email']."','".$data['email']."',now(),now(),$sexe,'".$data['naissance']."',
	'".$data['tel']."','".$data['nom']."','".$data['nom']."','a:0:{}','127.0.0.1','".$data['idPaki']."' )";
	echo $sql."<br/>";
	
	$req = mysqli_query($db, $sql) or die (mysqli_error($db));
}
echo 'fin';
*/

/*

$sql_product = "SELECT * FROM Paki";
$req_product = mysqli_query($db, $sql_product);
while($data = mysqli_fetch_assoc($req_product)){
	
	if($data['fumer']=='non')   $fumer   = 0; else $fumer   = 1;
	if($data['musique']=='non') $musique = 0; else $musique = 1;
	if($data['animal']=='non')  $animal  = 0; else $animal  = 1;
	if($data['blabla']=='non')  $blabla  = 0; else $blabla  = 1;
	if($data['maj']=='')        $maj     = 0; else $maj     = 1;
	if($data['filles']=='')     $filles  = 0; else $filles  = 1;
	if($data['saa']=='')        $saa  = 0;
	
	$sql = "INSERT INTO product
	(`user_id`,`maj`,`type`,`filles`,`date`,`heure`,`depart`,`villea`,`arrivee`,`villeb`,`place`,`vehicule`,`prix`,
	`message`,`fumer`,`musique`,`animal`,`blabla`,`saa`,`vue`,`ip`,`deposit`,`valid`,`updated`)
	VALUE
	('".$data['idPaki']."','$maj','".$data['type']."','$filles','".$data['date']."','".$data['heure']."',
	'".$data['depart']."','".mysqli_real_escape_string($db, $data['villea'])."','".$data['arriver']."','".mysqli_real_escape_string($db, $data['villeb'])."','".$data['place']."',
	'".$data['vehicule']."','".$data['prix']."','".mysqli_real_escape_string($db, $data['message'])."','".$fumer."','".$musique."','".$animal."','".$blabla."',
	'$saa','".$data['vue']."','".$data['ip']."','".$data['depot']."',1,'".$data['depot']."')";
	
	echo $sql."<br/>";
	
	$req = mysqli_query($db, $sql) or die (mysqli_error($db));
	
}

*/
echo '<br/><br/>noublie pas les KEY';

/*
$wilaya = array(
                    "01 - Adrar", "02 - Chlef", "03 - Laghouat", "04 - Oum El Bouaghi", "05 - Batna",
                    "06 - Bejaia", "07 - Biskra", "08 - Bechar", "09 - Blida", "10 - Bouira", "11 - Tamanrasset",
                    "12 - Tebessa", "13 - Tlemcen", "14 - Tiaret", "15 - Tizi Ouzou", "16 - Alger",
                    "17 - Djelfa", "18 - Jijel", "19 - Setif", "20 - Saida", "21 - Skikda",
                    "22 - Sidi Bel Abbes", "23 - Annaba", "24 - Guelma", "25 - Constantine", "26 - Medea",
                    "27 - Mostaganem", "28 - MSila", "29 - Mascara", "30 - Ouargla", "31 - Oran",
                    "32 - Bayadh", "33 - Illizi", "34 - Bordj Bou Arreridj", "35 - Boumerdes",
                    "36 - El Tarf", "37 - Tindouf", "38 - Tissemsilt", "39 - El Oued", "40 - Khenchela",
                    "41 - Souk Ahras", "42 - Tipaza", "43 - Mila", "44 - Ain Defla", "45 - Naama",
                    "46 - Ain Temouchent", "47 - Ghardaia", "48 - Relizane");

foreach ($wilaya as $key => $value) {
    if(substr($value, 0, 2) == '01'){
        echo '<br/>'.$value;  
    }
}
*/
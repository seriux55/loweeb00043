<?php

$db = mysqli_connect("localhost", "nadir", "", "SF_User");

//mysql_select_db("SF_User",$db);

$sql = "SELECT User.secondename, User.gender, Message.depot, Message.user_id
FROM Message 
  LEFT JOIN Product ON Message.product_id = Product.id 
  LEFT JOIN User ON Message.user_id = User.id 
WHERE Product.user_id = 1";


$req = mysqli_query($db, $sql);
$rek = mysqli_query($db, $sql);

$id = array();

while($data = mysqli_fetch_assoc($rek)){
	
	$dd[] = array(
		'user_id'		=> $data['user_id'],
		'gender' 		=> $data['gender'],
		'secondename' 	=> $data['secondename'],
		'depot'			=> $data['depot'],
	);
	
	if(!in_array($data['user_id'], $id)){
		$id[] = $data['user_id'];
	}
	
}

/*
foreach($dd as $k => $v){
	foreach($v as $key => $value){
		echo '<br />'.$key.' => '.$value;
	}
	echo '<br />';
}
*/

foreach($id as $k => $v){
	echo $v.'<br />';
}

echo '<pre>'; print_r($id); echo '</pre>';



$gg = array();

//foreach($id as $k => $v){

$d = array();
while($data = mysqli_fetch_assoc($req)){
	
	if(!in_array($data['user_id'],$d)){	
		$gg[] = array(
			'user_id'		=> $data['user_id'],
			'gender' 		=> $data['gender'],
			'secondename' 	=> $data['secondename'],
			'depot'			=> $data['depot'],
		);
		$d[] = $data['user_id'];
	}
}

//}

echo '-----------------------------';


foreach($gg as $k => $v){
	foreach($v as $key => $value){
		echo '<br />'.$key.' => '.$value;
	}
	echo '<br />';
}


/*
echo '<pre>';
print_r($gg);
echo '</pre>';
*/



















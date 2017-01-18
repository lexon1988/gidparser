<?php
set_time_limit(55);



for($j=0;$j<300; $j++){

$counter=file_get_contents("counter.txt");
$counter2=file_get_contents("counter2.txt");

if($counter<$counter2) $counter=$counter2;
if($counter>325000){exit();}//Крайняя точка


unset($step);
unset($group_ids);

for($i=1;$i<400; $i++){
	
	$step[$i]=$i+$counter*400;
	$group_ids=$group_ids.$step[$i].",";
	
}



$group_ids=substr($group_ids,0,-1);

$arr="";
$api_j="";
$api_rez="";

unset($api_j);
unset($api_rez);
unset($arr);


$api="https://api.vk.com/method/groups.getById?group_ids=".$group_ids."&fields=members_count";
$api_rez= file_get_contents($api);
$gids=json_decode($api_rez);


//print_r($gids);

for($g=0;$g<401; $g++){

	if($gids->response[$g]->members_count>1000){
		
		$arr[]=$gids->response[$g]->gid;
		
	}

}



if($api_rez<>""){


$arr_j=json_encode($arr);


	$fp = fopen("rez.txt", "a"); // Открываем файл в режиме записи 
	$mytext = $arr_j."\r\n"; // Исходная строка
	fwrite($fp, $mytext); // Запись в файл
	fclose($fp); //Закрытие файла



	}else{
		
		sleep(0);
		
	}
		

		
		
	$counter++;
	file_put_contents("counter.txt",$counter);
	
	$rand=rand(0,10);
	if($rand==10){
		file_put_contents("counter2.txt",$counter);
	}



	
sleep(0);	
}



?>
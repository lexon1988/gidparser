<?php

set_time_limit(60);

$counter=file_get_contents("counter.txt");
$counter2=file_get_contents("counter2.txt");

$dir=file_get_contents("dir_count.txt");

$sc_dir=scandir("rez/".$dir."/");
$sc_dir_count=count($sc_dir);
//echo "В папке-".count($sc_dir);

if($sc_dir_count>500){
		
	$dir++;
	file_put_contents("dir_count.txt",$dir);
	mkdir("rez/".$dir);	
	
	
}




if($counter<$counter2) $counter=$counter2;
if($counter>325000){exit();}//Крайняя точка



for($j=0;$j<400; $j++){

unset($step);
unset($group_ids);

for($i=1;$i<400; $i++){
	
	$step[$i]=$i+$counter*400;
	
	$group_ids=$group_ids.$step[$i].",";
	
}


$group_ids=substr($group_ids,0,-1);


unset($api_rez);

$api="https://api.vk.com/method/groups.getById?group_ids=".$group_ids."&fields=city,country,place,description,wiki_page,members_count,counters,start_date,finish_date,can_post,can_see_all_posts,activity,status,contacts,links,fixed_post,verified,site,ban_info";
$api_rez= file_get_contents($api);




if($api_rez<>""){

file_put_contents("rez/".$dir."/".$counter.".txt.gz", bzcompress($api_rez, 9));
$rand=rand(0,10);
$counter++;
file_put_contents("counter.txt",$counter);

	if($rand==10){
		
		file_put_contents("counter2.txt",$counter);
		
	}


	
}else{
	
	sleep(1);
	
}
	
	
	
}

?>
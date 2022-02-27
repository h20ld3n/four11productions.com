<?
	system("gunzip wordpress.tar.gz");
	system("tar xf wordpress.tar");
	system("rm -f wordpress.tar");
       
    $fp = fopen("wp-config-sample.php","r");
    $filecontent = fread($fp, filesize("wp-config-sample.php"));
    
	$new_content = eregi_replace("putyourdbnamehere", $_REQUEST["db"], $filecontent);
	$new_content = eregi_replace("usernamehere", $_REQUEST["u"], $new_content);
	$new_content = eregi_replace("yourpasswordhere", $_REQUEST["p"], $new_content);
	fclose($fp);
  
	$fp = fopen("wp-config.php", "w");
	fputs($fp, $new_content);
	fclose($fp);
?>
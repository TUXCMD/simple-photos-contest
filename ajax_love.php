<?php
include("config.php");
$ip=$_SERVER['REMOTE_ADDR']; 

if(isset($_POST['id']) and !empty($_POST['id'])){
	$id= intval($_POST['id']);
	$contest= htmlspecialchars($_POST['contest']);
	$ip_sql=mysql_query("select ip_add from image_IP where img_id_fk=$id and ip_add='$ip'");
	$count=mysql_num_rows($ip_sql);
	//var_dump($id);
	if($count==0){
		$sql = "UPDATE `images` SET love = love +1 WHERE img_id = ".$id;
		//var_dump($sql);
		mysql_query( $sql);
		$sql_in = "insert into image_IP (ip_add,img_id_fk,contest) values ('$ip',$id,'$contest')";
		mysql_query( $sql_in);
		$result=mysql_query("select love from images where img_id=$id");
		//var_dump($result);
		$row=mysql_fetch_array($result);
		$love=$row['love'];
		?>
		<span class="on_img" align="left"><?php echo $love; ?></span>
		<?php
	}else{
		echo _('You have already voted !');
	}
}

if (isset($_POST['action'])){
	if ($_POST['action'] == 'login'){
		$pwd = $_POST['pwd'];
		if ($pwd == PASSWD){
			$ok = setcookie(COOKIE_NAME, sha1(PASSWD.HASH), 0, '/', '', FALSE, TRUE);
			if (!$ok){
        echo '<div class="alert error">cookie failed !</div>';
      }
		}else{
			echo '<div class="alert error"><a class="close" href="#" title="'._('Close').'">×</a>'._('Wrong password !').'</div>';
		}
	}
}
?>
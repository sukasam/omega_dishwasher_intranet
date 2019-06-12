 <?php 
 	$sql = "select show_status from b_banner_config where page_name_en='".$pages_config_banner."' ";
	$query = @mysql_query ($sql);
	$rec_config = @mysql_fetch_array($query);
	$show_status=$rec_config["show_status"];
	//echo $show_status;
	if($show_status==0){
 ?>
<script type="text/javascript" src="/Scripts/AC_RunActiveContent.js"></script>
<?php 
	$sql_banner = " select * from b_banner where status=0 ";
	$query_banner = @mysql_query ($sql_banner);
	$rec_banner = @mysql_fetch_array ($query_banner);
	$path_img="upload/banner/".$rec_banner["file_name"];
	if((file_exists($path_img))&&($rec_banner["file_name"]!= "")){
	$filestype = substr($rec_banner["file_name"],-3);
	if($filestype== "swf"){
		$shortname = substr($rec_banner["file_name"],0,strlen($rec_banner["file_name"])-4);
		$part_flash = "upload/banner/".$shortname;
		$flash=Show_Flash_banner($part_flash,"880","126") ;
		echo $flash;
	}else{			
 
	if($rec_banner['link_url']!=""){ 
		
		if($rec_banner['link_description']!=""){
?>

<a href="<?php  echo $_SERVER['SERVER_NAME']?>details.php?desc_id=<?php  echo $rec_banner['banner_id']?>" target="_blank">
<img src="<?php  echo $path_img;?>" width="880" height="126" border="0" />
</a>
<?php  
	}else{// link_description
		
?>
<a href="http://<?php  echo $rec_banner['link_url']?>" target="_blank">
<img src="<?php  echo $path_img;?>" width="880" height="126" border="0" />
</a>


<?php  
	} // end if link_description
	}else{ 
	
	?>
<img src="<?php  echo $path_img;?>" width="880" height="126" border="0" />
    <?php 
	} //end if check link
  }
}
?>
<?php  } //end if show_status?>



<?php 
	$sql_background = " select * from b_background where status=0 ";
	$query_background = @mysql_query ($sql_background);
	$rec_background = @mysql_fetch_array ($query_background);
	$fixed=$rec_background["fixed"];
	$margin_top=$rec_background["margin_top"];
	if($fixed==1){
		$fixed="fixed";
	}else{
		$fixed="";
	}
	$path_img="upload/background/".$rec_background["file_name"];
	if((file_exists($path_img))&&($rec_background["file_name"]!= "")){
	
 ?>
<style type="text/css">
body {
                font-family: Arial, Helvetica, sans-serif;
                color: #555;
                background: #4aaaee url('<?php  echo $path_img;?>') top no-repeat <?php  echo $fixed;?>;
                font-size: 12px;
				margin:0; padding:0;
      }	
#body_bg{background: #48a9ed url(../images/body_bg.jpg) repeat-y top; width:902px; float:none; margin:auto; margin-top:<?php  echo $margin_top;?>px;}  
</style>
<?php  }else{?>
<style type="text/css">
body {
                font-family: Arial, Helvetica, sans-serif;
                color: #555;
                background: #4aaaee url('../images/bg-body.gif') top no-repeat;
                font-size: 12px;
				margin:0; padding:0;
     }
#body_bg{background: #48a9ed url(../images/body_bg.jpg) repeat-y top; width:902px; float:none; margin:auto; margin-top:165px;}
</style>
<?php  }?>

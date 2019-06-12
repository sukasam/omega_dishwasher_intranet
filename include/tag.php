 <?php 
 	$sql = "select * from b_tag where pages='".$pages."' ";
	$query = @mysql_query ($sql);
	$rec_tag = @mysql_fetch_array($query);
	$tag_title=$rec_tag["tag_title"];
	$tag_meta=$rec_tag["tag_meta"];

 ?>
 
 <?php 
 	$sql = "select * from b_tag where pages='".$pages."' ";
	$query = @mysqli_query($conn,$sql);
	$rec_tag = @mysqli_fetch_array($query);
	$tag_title=$rec_tag["tag_title"];
	$tag_meta=$rec_tag["tag_meta"];

 ?>
 
<?php 
	include ("../../include/connect.php");
	
$output_dir = "../../upload/document/".$_REQUEST['id']."/";
if(isset($_FILES["myfile"])){
	$ret = array();
	$error =$_FILES["myfile"]["error"];
	
	//iconv("utf-8", "tis-620", $_FILES["myfile"]["name"]);
	
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
		
		/*$image = new SimpleImage(); 
		$image->load($_FILES['myfile']['tmp_name']); 
		$image->resizeToWidth(850); 
		$image->output();*/

		
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],iconv('UTF-8','windows-874',$output_dir.$fileName));
		//move_uploaded_file($_FILES["myfile"]["tmp_name"],iconv('UTF-8','windows-874',$output_dir."thumbs/".$fileName));
		
		$image = new SimpleImage(); 
		/*$image->load($output_dir.$fileName); 
		$image->resizeToHeight(567); 
		$image->save($output_dir.$fileName);*/
		//$image->load($output_dir."thumbs/".$fileName); 
		//$image->resizeToWidth(450); 
		//$image->save($output_dir."thumbs/".$fileName);
		
		//if (file_exists($output_dir.$fileName)){
			    $video_check = @mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_document_gallery WHERE title_name = '".$fileName."'"));
				if($video_check == 0){
					@mysqli_query($conn,"INSERT INTO `s_document_gallery` (`img_id`, `id`, `title_name`, `sorts`, `flag_show`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$_REQUEST['id']."', '".$fileName."', '9999', '', 'admin', '".date("Y-m-d H:i:s")."', '', '', '', '');");	
				}
		//}
    	$ret[]= $fileName;
	}
	/*else{  //Multiple files, file[]
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++){
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],iconv('UTF-8','windows-874',$output_dir.$fileName));
		//if ($output_dir.$fileName){
				@mysqli_query($conn,"INSERT INTO `s_document_gallery` (`img_id`, `id`, `title_name`, `title_name`, `sorts`, `flag_show`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$_REQUEST['id']."', '".substr(iconv('UTF-8','windows-874',$fileName),0,-4)."', '".substr(iconv('UTF-8','windows-874',$fileName),0,-4)."', '9999', '', 'admin', '".date("Y-m-d H:i:s")."', '', '', '', '');");						  
		//}
	  	$ret[]= $fileName;
	  }
	}*/
    echo json_encode($ret);
 }
 
class SimpleImage {   var $image; var $image_type;   function load($filename) {   $image_info = getimagesize($filename); $this->image_type = $image_info[2]; if( $this->image_type == IMAGETYPE_JPEG ) {   $this->image = imagecreatefromjpeg($filename); } elseif( $this->image_type == IMAGETYPE_GIF ) {   $this->image = imagecreatefromgif($filename); } elseif( $this->image_type == IMAGETYPE_PNG ) {   $this->image = imagecreatefrompng($filename); } } function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {   if( $image_type == IMAGETYPE_JPEG ) { imagejpeg($this->image,$filename,$compression); } elseif( $image_type == IMAGETYPE_GIF ) {   imagegif($this->image,$filename); } elseif( $image_type == IMAGETYPE_PNG ) {   imagepng($this->image,$filename); } if( $permissions != null) {   chmod($filename,$permissions); } } function output($image_type=IMAGETYPE_JPEG) {   if( $image_type == IMAGETYPE_JPEG ) { imagejpeg($this->image); } elseif( $image_type == IMAGETYPE_GIF ) {   imagegif($this->image); } elseif( $image_type == IMAGETYPE_PNG ) {   imagepng($this->image); } } function getWidth() {   return imagesx($this->image); } function getHeight() {   return imagesy($this->image); } function resizeToHeight($height) {   $ratio = $height / $this->getHeight(); $width = $this->getWidth() * $ratio; $this->resize($width,$height); }   function resizeToWidth($width) { $ratio = $width / $this->getWidth(); $height = $this->getheight() * $ratio; $this->resize($width,$height); }   function scale($scale) { $width = $this->getWidth() * $scale/100; $height = $this->getheight() * $scale/100; $this->resize($width,$height); }   function resize($width,$height) { $new_image = imagecreatetruecolor($width, $height); imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight()); $this->image = $new_image; }   } 
?>
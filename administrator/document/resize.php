<?php 

include ("../../include/config.php");
include ("../../include/connect.php");
include ("../../include/function.php");
include ("config.php");

if($_POST['mode'] == "resize"){

	$filename = explode('"',$_POST['fileName']);

	$target_dir = "../../upload/document/".$_POST['doc_name']."/".$filename[1];
	$target_file = $target_dir . basename($filename);
	
	resize_crop_image(1200, 800, $target_file, $target_file);
	
	//echo $target_dir;
	
	

	
	$video_check = @mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_document_gallery WHERE title_name = '".$filename[1]."' AND id ='".$_POST['id']."'"));
	if($video_check == 0){
		 $sqlImg = "INSERT INTO `s_document_gallery` (`img_id`, `id`, `title_name`, `sorts`, `flag_show`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$_REQUEST['id']."', '".$filename[1]."', '9999', 0, 'admin', '".date("Y-m-d H:i:s")."', 'admin', '".date("Y-m-d H:i:s")."', 'admin', '".date("Y-m-d H:i:s")."');";
		@mysqli_query($conn,$sqlImg);	
	}

}

	//resize and crop image by center
function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];
 
    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;
 
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;
 
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;
 
        default:
            return false;
            break;
    }
     
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);
     
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if($width_new > $width){
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
     
    $image($dst_img, $dst_dir, $quality);
 
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}
//usage example

?>
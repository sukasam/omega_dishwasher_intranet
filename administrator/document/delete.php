<?php 
include ("../../include/connect.php");
$output_dir = "../../upload/video/media/";
if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
{
	$fileName =$_POST['name'];
	$filePath = iconv('UTF-8','windows-874',$output_dir. $fileName);
	$filenames = substr(iconv('UTF-8','windows-874',$fileName),0,-4);
	if (file_exists($filePath)) {
        unlink($filePath);
		@mysqli_query($conn,"DELETE FROM `s_document_gallery` WHERE (`title_name ` = '".$filenames."' or `title_name` = '".$filenames."')");
    }
	echo "Deleted File ".$filenames."<br>";
}

?>
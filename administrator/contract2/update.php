<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$vowels = array(",","");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		if($_POST['con_stime'] == ""){
			$_POST['con_stime'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_stime']);
			$_POST['con_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['con_startdate'] == ""){
			$_POST['con_startdate'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_startdate']);
			$_POST['con_startdate']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['con_enddate'] == ""){
			$_POST['con_enddate'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_enddate']);
			$_POST['con_enddate']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		$_POST['con_price'] = str_replace($vowels, '', $_POST['con_price']);
		
		$checklist = '';
		
		foreach ($_POST['chkPro'] as $value) {
			$checklist .= $value.',';
		}
		
		
		$_POST['con_chkpro'] = substr($checklist,0,-1);
		

		if ($_POST['mode'] == "add" || $_POST['mode'] == "cadd") { 
			
			if($_POST['con_id'] == ""){
				 $_POST['con_id'] = check_contract2_number($conn);
			}
			
			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);
			
			if($_POST['mode'] == "cadd"){
				$_FILES['fimages1']['name'] = "";
				$_FILES['fimages2']['name'] = "";
				$_FILES['fimages3']['name'] = "";
				$_FILES['fimages4']['name'] = "";
				$_FILES['fimages5']['name'] = "";
				$_FILES['fimages6']['name'] = "";
				$_FILES['fimages7']['name'] = "";
				
				@unlink("../../upload/contract2/img/".$_POST['con_img1']);
				@unlink("../../upload/contract2/img/".$_POST['con_img2']);
				@unlink("../../upload/contract2/img/".$_POST['con_img3']);
				@unlink("../../upload/contract2/img/".$_POST['con_img4']);
				@unlink("../../upload/contract2/img/".$_POST['con_img5']);
				@unlink("../../upload/contract2/img/".$_POST['con_img6']);
				@unlink("../../upload/contract2/img/".$_POST['con_img7']);
				$sql = "update $tbl_name set con_img1 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img2 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img3 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img4 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img5 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img6 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img7 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
			}else{
				if ($_FILES['fimages1']['name'] != "") { 
        		
					@unlink("../../upload/contract2/img/".$_POST['con_img1']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages1']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages1"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img1 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img1'] = $filename;
							
				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages2']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img2']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages2']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages2"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img2 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img2'] = $filename;
				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages3']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img3']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages3']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages3"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages3"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img3 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img3'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages4']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img4']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages4']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages4"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages4"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img4 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img4'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages5']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img5']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages5']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages5"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages5"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img5 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img5'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages6']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img6']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages6']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages6"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages6"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img6 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img6'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages7']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img7']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages7']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages7"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages7"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img7 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img7'] = $filename;

				} // end if ($_FILES[fimages][name] != "")
			}
				
			include_once("../mpdf54/mpdf.php");
			
			include_once("form_contract.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract2/'.$chaf.'.pdf','F');
			
			include_once("form_contract2.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract2/'.$chaf.'-2.pdf','F');
			
			if($_POST['mode'] == "cadd"){
				header ("location:update.php?mode=update&ct_id=".$id); 
			}else{
				header ("location:index.php?" . $param); 
			} 
		}
		if ($_POST['mode'] == "update" || $_POST['mode'] == "cupdate" ) {
			 
			include ("../include/m_update.php");
			
			$id = $_POST[$PK_field];	
			
			if($_POST['mode'] == "cupdate"){
				$_FILES['fimages1']['name'] = "";
				$_FILES['fimages2']['name'] = "";
				$_FILES['fimages3']['name'] = "";
				$_FILES['fimages4']['name'] = "";
				$_FILES['fimages5']['name'] = "";
				$_FILES['fimages6']['name'] = "";
				$_FILES['fimages7']['name'] = "";
				
				@unlink("../../upload/contract2/img/".$_POST['con_img1']);
				@unlink("../../upload/contract2/img/".$_POST['con_img2']);
				@unlink("../../upload/contract2/img/".$_POST['con_img3']);
				@unlink("../../upload/contract2/img/".$_POST['con_img4']);
				@unlink("../../upload/contract2/img/".$_POST['con_img5']);
				@unlink("../../upload/contract2/img/".$_POST['con_img6']);
				@unlink("../../upload/contract2/img/".$_POST['con_img7']);
				$sql = "update $tbl_name set con_img1 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img2 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img3 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img4 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img5 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img6 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
				$sql = "update $tbl_name set con_img7 = '' where $PK_field = '".$id."' ";
          		mysqli_query($conn, $sql);	
			}else{
				
				if ($_FILES['fimages1']['name'] != "") { 
        		
					@unlink("../../upload/contract2/img/".$_POST['con_img1']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages1']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages1"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img1 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img1'] = $filename;
							
				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages2']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img2']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages2']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages2"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img2 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img2'] = $filename;
				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages3']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img3']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages3']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages3"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages3"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img3 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img3'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages4']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img4']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages4']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages4"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages4"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img4 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img4'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages5']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img5']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages5']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages5"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages5"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img5 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img5'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages6']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img6']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages6']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages6"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages6"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img6 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img6'] = $filename;

				} // end if ($_FILES[fimages][name] != "")

				if ($_FILES['fimages7']['name'] != "") { 

					@unlink("../../upload/contract2/img/".$_POST['con_img7']);

					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['fimages7']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;

					$target_dir = "../../upload/contract2/img/";
					$target_file = $target_dir . basename($filename);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages7"]["tmp_name"]);

					if($check !== false) {

						move_uploaded_file($_FILES["fimages7"]["tmp_name"], $target_file);
						$sql = "update $tbl_name set con_img7 = '".$filename."' where $PK_field = '".$id."' ";
						//exit();
						mysqli_query($conn, $sql);	

					}
					$_POST['con_img7'] = $filename;

				} // end if ($_FILES[fimages][name] != "")
			}
	
			include_once("../mpdf54/mpdf.php");
			include_once("form_contract.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract2/'.$chaf.'.pdf','F');
			
			include_once("form_contract2.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract2/'.$chaf.'-2.pdf','F');
			
			if($_POST['mode'] == "cupdate"){
				header ("location:update.php?mode=update&ct_id=".$id); 
			}else{
				header ("location:index.php?" . $param); 
			}
			
		}
		
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$a_sdate=explode("-",$con_stime);
		$con_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$con_startdate);
		$con_startdate = $a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$con_enddate);
		$con_enddate = $a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
		$con_chkpro = explode(',',$con_chkpro);
		
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}		
}	

	function CountChecks(whichlist,maxchecked,latestcheck,numsa) {
	
	var listone = new Array();
 	
	for (var t=1;t<=numsa;t++){
		listone[t-1] = 'checkbox'+t;
	}
	
	// End of customization.
	var iterationlist;
	eval("iterationlist="+whichlist);
	var count = 0;
	for( var i=0; i<iterationlist.length; i++ ) {
	   if( document.getElementById(iterationlist[i]).checked == true) { count++; }
	   if( count > maxchecked ) { latestcheck.checked = false; }
	   }
	if( count > maxchecked ) {
	  // alert('Sorry, only ' + maxchecked + ' may be checked.');
	   }
	}
	
</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><style>
	.bgheader{
		font-size:12px;
		position:absolute;
		margin-top:98px;
		padding-left:586px;
	}
	table tr td{
		vertical-align:top;
		padding:5px;
	}	
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
  	}	
	.cdetail ul li{
		list-style:none;
		
	}
	.cdetail2 ul li{
		list-style:none;
		float:left;
	}
	.clear{
		margin:0;
		padding:0;
		clear:both;	
	}
	
	.tblf5{
		border: 1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	
	</style>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong> 
            	<!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_cusf = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY cd_name ASC");
						while($row_cusf = @mysqli_fetch_array($qu_cusf)){
							
							?>
							<option value="<?php  echo $row_cusf['fo_id'];?>" <?php  if($row_cusf['fo_id'] == $cus_id){echo 'selected';}?>><?php  echo $row_cusf['cd_name']." (".$row_cusf['loc_name'].")";?></option>
							<?php 
						}
					?>
                </select>-->
                <input name="cd_names" type="text" id="cd_names"  value="<?php  echo get_customername($conn,$cus_id);?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td>
            	<strong>เลขที่สัญญา : <input type="text" name="con_id" value="<?php  if($con_id == ""){echo check_contract2_number($conn);}else{echo $con_id;};?>" id="con_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่ FO  :</strong> <span id="contactid"><?php  echo $finfo['fs_id'];?></span>
            </td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php  echo $finfo['cd_address'];?></span></td>
            <td>
            	<strong>วันทำสัญญา  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="con_stime" readonly value="<?php  if($con_stime==""){echo date("d/m/Y");}else{ echo $con_stime;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_stime'});</script></span>
            </td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php  echo province_name($conn,$finfo['cd_province']);?></span></td>
            <td>
            	<strong>เริ่มสัญญา  :</strong> <span id="con_startdate"></span><input type="text" name="con_startdate" readonly value="<?php  if($con_startdate==""){echo date("d/m/Y");}else{ echo $con_startdate;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_startdate'});</script><strong> สิ้นสุดสัญญา :</strong> <span id="con_enddate"></span><input type="text" name="con_enddate" readonly value="<?php  if($con_enddate==""){echo date("d/m/Y");}else{ echo $con_enddate;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_enddate'});</script>
            </td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php  echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php  echo $finfo['cd_fax'];?></span></td>
            <td>
            	<input type="radio" name="con_spar" value="0" <?php if($con_spar == '0' || $con_spar == ''){echo 'checked="checked"';}?>>แบบไม่รวมอะไหล่ &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="con_spar" value="1" <?php if($con_spar == '1'){echo 'checked="checked"';}?>>แบบรวมอะไหล่
            </td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php  echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php  echo $finfo['c_tel'];?></span></td>
            <td>
            	<strong>ราคาสัญญาบริการรายปี : </strong><span id="con_price"><input type="text" name="con_price" value="<?php  echo number_format($con_price);?>" id="con_price" class="inpfoder" style="width:20%;text-align: center;"></span>
            </td>
          </tr>
	</table><br><br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;" id="productConlist">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></td>
      <td width="43%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รูปภาพ</strong></td>


    </tr>
    <?php 
		if($finfo['cpro1']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="1" <?php if(@in_array( '1' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro1']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod1'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn1'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount1'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages1" type="file" id="fimages1">
			  <?php  
				 if($con_img1){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img1?>" width="150">
                  <?php  }?>
                  <input name="con_img1" type="hidden" value="<?php echo  $con_img1; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro2']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="2" <?php if(@in_array( '2' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro2']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod2'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn2'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount2'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages2" type="file" id="fimages2">
			  <?php  
				 if($con_img2){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img2?>" width="150">
                  <?php  }?>
                  <input name="con_img2" type="hidden" value="<?php echo  $con_img2; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro3']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="3" <?php if(@in_array('3' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro3']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod3'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn3'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount3'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages3" type="file" id="fimages3">
			  <?php  
				 if($con_img3){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img3?>" width="150">
                  <?php  }?>
                  <input name="con_img3" type="hidden" value="<?php echo  $con_img3; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro4']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="4" <?php if(@in_array( '4' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro4']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod4'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn4'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount4'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages4" type="file" id="fimages4">
			  <?php  
				 if($con_img4){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img4?>" width="150">
                  <?php  }?>
                  <input name="con_img4" type="hidden" value="<?php echo  $con_img4; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro5']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="5" <?php if(@in_array( '5' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro5']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod5'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn5'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount5'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages5" type="file" id="fimages5">
			  <?php  
				 if($con_img5){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img5?>" width="150">
                  <?php  }?>
                  <input name="con_img5" type="hidden" value="<?php echo  $con_img5; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro6']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="6" <?php if(@in_array( '6' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro6']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod6'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn6'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount6'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages6" type="file" id="fimages6">
			  <?php  
				 if($con_img6){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img6?>" width="150">
                  <?php  }?>
                  <input name="con_img6" type="hidden" value="<?php echo  $con_img6; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro7']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="7" <?php if(@in_array( '7' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro7']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod7'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn7'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount7'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input name="fimages7" type="file" id="fimages7">
			  <?php  
				 if($con_img7){
			  ?>
                  <img src="../../upload/contract2/img/<?php  echo $con_img7?>" width="150">
                  <?php  }?>
                  <input name="con_img7" type="hidden" value="<?php echo  $con_img7; ?>">
			  </td>
			</tr>
			<?php
		}
	?>
    </table>
    
	</td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
      <input type="submit" name="Submit" id="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode'];?>">
      <input name="<?php echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>

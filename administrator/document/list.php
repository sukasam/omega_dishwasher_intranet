<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission ($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$PK_field = "img_id";
	$FR_field = "id";
	$FR_module="News Gallery";
	$check_module = "News";
	$page_name = "News Gallery ".get_doc_name($conn,$_GET['id'])." All";
	$tbl_name = "s_document_gallery";
	$fieldlist = array('id','title_name','sorts','flag_show') ;
	$title_del="News Gallery";
	$title_del_name="title_name";
	$a_param = array('page','orderby','sortby','keyword','pagesize','img_id','mid','smid');
	$pagesize = 20;
	
	
	
	//-------------------------------------------------------------------------------------
	if($_REQUEST['action'] == "delete"){
		
			$sql = "select * from $tbl_name where $PK_field='$_GET[$PK_field]'";
			$query = @mysqli_query($conn,$sql);
			$rec = @mysqli_fetch_array ($query);
			$file_name = $rec["title_name"];
			$albums_name = get_doc_name($conn,$rec['id']);
			//$flgDelete_thumbs = unlink("../../upload/document/".$albums_name."/thumbs/".$file_name);
			$flgDelete_images = unlink("../../upload/document/".$albums_name."/".$file_name);
			
			$sql = "delete from $tbl_name where $PK_field = '$_GET[$PK_field]'";
			mysqli_query($conn,$sql);	
			header ("location:?mode=add&id=$_REQUEST[id]&".$param); 
			
	}
	//-------------------------------------------------------------------------------------
	 if ($_GET['b'] <> "" and $_GET['s'] <> "") { 
		if ($_GET['s'] == 0) $status = 1;
		if ($_GET['s'] == 1) $status = 0;
		Check_Permission ($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set flag_show = '$status' where $PK_field = '".$_GET['b']."'";
		mysqli_query ($conn,$sql_status);
		header ("location:?mode=add&id=$_REQUEST[id]&".$param); 
	}
	//-------------------------------------------------------------------------------------
	 if ($_GET['b'] <> "" and $_GET[m] <> "") { 
		if ($_GET[m] == 0) $status = 1;
		if ($_GET[m] == 1) $status = 0;
		Check_Permission ($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set main_show = '$status' where $PK_field = '".$_GET['b']."'";
		mysqli_query ($conn,$sql_status);
		echo $sql_status;
		header ("location:?mode=add&id=$_REQUEST[id]&".$param); 
	}
	//-------------------------------------------------------------------------------------
	if ($_GET['mode'] == "update") { 
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = mysqli_query ($conn,$sql);
		while ($rec = mysqli_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<link href="uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.uploadfile.min.js"></script>  
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    window.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		<?php  
		if($_GET['mode'] == "add"){
		?>
		if (frm.file1.value==""){
			alert ('Choose Images');
			frm.file1.focus(); 
			return false;
		}
		<?php  }?>
		if (frm.image_name.value==""){
			alert ('Please Input images name');
			frm.image_name.focus(); return false;
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
<P id=page-intro><?php  echo ucfirst ($page_name); ?></P>

<UL class=shortcut-buttons-set> 
    <?php  
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
    <LI><A class=shortcut-button href="video.php?mode=add&id=<?php  echo $_GET["id"]; if($param <> "") {?>&<?php  echo $param; }?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>Add Images</SPAN></A></LI>
  <LI><A class=shortcut-button href="../document/?<?php  if($param <> "") echo $param;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
    <br>
    Back</SPAN></A></LI>
  <?php  }?> 
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->

<div style="color: red;font-weight: bold;font-size: 15px;">* Image size can not exceed 1200px X 800px.</div>

<br><br>

<?php  if(!isset($_GET['img_id'])){?>
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $page_name; ?></H3>
<br>
<div>
    <div style="float:right;padding-left:10px;">
 <form name="form1" method="get" action="../document/list.php">
  <input name="keyword" type="text" id="keyword" value="<?php  echo $_GET['keyword'];?>">
    <input name="Action" type="submit" id="Action" value="Search">
    <input name="mode" type="hidden" id="add" value="add">
    <input name="id" type="hidden" id="id" value="<?php  echo $_GET['id'];?>">
    <input name="page" type="hidden" id="page" value="<?php  echo $_GET['page'];?>">
    <?php 
			/*$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);*/
			  ?>
    <a href="../document/list.php?mode=add&id=<?php  echo $_GET['id'];?>&page=1">Show All</a>
    <?php  
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
</form></div>

</div>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="9%" <?php  Show_Sort_bg ($PK_field, $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ($PK_field, "No.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="32%" nowrap><a>Images</a></TH>
          <TH width="53%"><a>Images Name</a></TH>
         <!-- <TH width="14%" nowrap ><div align="center"><a> Sequence </a></div></TH>
          <TH width="14%" nowrap ><div align="center"><a>Status</a></div></TH>-->
          <!--<TH width="0%"><a>แก้ไข</a></TH>-->
          <TH width="6%"><a>Del</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = $tbl_name.".sorts";
					if ($sortby =="") $sortby ="asc";
					
				    $sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where id='".$_GET['id']."' ";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";	
					
					if ($_GET['keyword'] <> "") { 
						$sql .= "and ( title_name like '%".$_GET['keyword']."%' ";
						$sql .=  $subtext . " ) ";
					} 				
 					
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = mysqli_query ($conn,$sql);
					if($_GET['page'] == "") $_GET['page'] = 1;
					$counter = ($_GET['page']-1)*$pagesize;
					
					while ($rec = mysqli_fetch_array ($query)) { 
					$counter++;
				   ?>
        <TR>
          <TD style="vertical-align:middle"><div align="center"><span class="text"><strong><?php  echo  sprintf("%03d", $counter); ?></strong></span></div></TD>
          <TD>
          <!--<video height="150" controls>
            <source src="<?php  echo S_DOMAIN.S_PATHS?>upload/video/media/private/<?php  echo $rec["title_name"];?>" type="video/<?php  echo strtolower($rec["video_type"]);?>"/>
        </video>-->
        <img src="../../upload/document/<?php  echo $_GET['id'];?>/<?php  echo $rec["title_name"];?>" width="200">
		  </TD>
         <TD style="vertical-align:middle"><?php  echo $rec["title_name"]; ?></TD>
           <!--<TD style="vertical-align:middle"><div align="center"><input type="text" name="sorts" size="2" value="<?php  if($rec["sorts"] == 9999){echo '0';}else{echo $rec["sorts"];}?>" onChange="submit_upd_sequence2(this.value,<?php  echo $rec["img_id"];?>);" style="text-align:center;"></div></TD>
          <TD nowrap style="vertical-align:middle"> <div align="center">
            <?php  if($rec["flag_show"]==0) {?>
            <a href="?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["flag_show"]; ?>&<?php  echo $FR_field; ?>=<?php  echo $rec["$FR_field"];?>&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["flag_show"]; ?>&<?php  echo $FR_field; ?>=<?php  echo $rec["$FR_field"];?>&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>-->
          <!--<TD style="vertical-align:middle">
            <A title=Edit href="?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>&<?php  echo $FR_field; ?>=<?php  echo $rec["$FR_field"];?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>-->
          <TD style="vertical-align:middle"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $FR_field; ?>=<?php  echo $rec["$FR_field"];?>&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>','<?php  echo $title_del;?>  <?php  echo $rec[$PK_field];?> : <?php  echo $rec[$title_del_name];?>')"></A></TD>
        </TR>  
		<?php  }?>
      </TBODY>
    </TABLE>
    <span class="bulk-actions align-left">
    <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
    </span><br>
    <br>
    <DIV class=pagination> <?php  include("../include/page_show.php");?> </DIV>
  </form>  
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<?php  }?>
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

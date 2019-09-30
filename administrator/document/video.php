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
	$check_module = "News Gallery";
	$page_name = "(News Gallery ".get_doc_name($conn,$_GET['id']).")";
	$tbl_name = "s_document_gallery";
	$fieldlist = array('id','file_name','sorts','flag_show') ;
	$title_del="News Gallery";
	$title_del_name="img_id";
	//$a_param = array('page','orderby','sortby','keyword','pagesize','id','mid','smid');
	//$pagesize = 5;
	

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
  <LI><A class=shortcut-button href="list.php?mode=add&id=<?php  echo $_GET["id"]; if($param <> "") {?>&<?php  echo $param; }?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>
  <?php  }?> 
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
<div align="right" style="padding-right:15px;" class="content-box-header">

<h3 align="left" style="cursor: s-resize;">Uploads Images <?php  echo $page_name; ?></h3>
<br>
<div class="clear">

</div></div><!-- End .content-box-header -->
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1" style="display: block;"><!-- This is the target div. id must match the href of this div's tab -->
	<div id="mulitplefileuploader">Selected file</div>

    <div id="status"></div>
    <script>
    $(document).ready(function()
    {
    var settings = {
        url: "upload.php?id=<?php  echo $_GET['id'];?>&doc_name=<?php  echo get_doc_name($conn,$_GET['id']);?>",
        dragDrop:true,
        fileName: "myfile",
        allowedTypes:"jpg,png,gif,JPG,PNG,GIF",	
        maxFileSize:999999999999,
        //returnType:"json",
         onSuccess:function(files,data,xhr){
           var data2 = {
               mode:"resize",
			   id: "<?php  echo $_GET['id'];?>",
			   doc_name: "<?php  echo get_doc_name($conn,$_GET['id']);?>",
			   fileName: data,
           }
           $.ajax({
					'type':'POST',
					'url':'resize.php',
					'data':data2,
					'success':function (result) {
                        console.log(result);
                    },
					'error':function (result) {}
				});

        },
        showDelete:false,
        deleteCallback: function(data,pd){
        for(var i=0;i<data.length;i++)
        {
            $.post("delete.php?id=<?php  echo $_GET['id'];?>",{op:"delete",name:data[i]},
            function(resp, textStatus, jqXHR)
            {
                //Show Message  
                $("#status").append("<div>Delete already</div>");      
            });
         }      
        pd.statusbar.hide(); //You choice to hide/not.
    
    }
    }
    var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
    
    
    });
    </script>
</div><!-- End #tab1 -->


</div><!-- End .content-box-content -->
</div>

<br><br>

<!-- End .content-box -->
<!-- End .content-box --><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

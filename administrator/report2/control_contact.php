<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางคุมสัญญา</title>
<style type="text/css">
	#boxdiv{font-size:13px;}
	#boxdiv ul{margin:0;padding:0;}
	#boxdiv ul li{list-style:none;float:left;}
	.button {
		background: url("../images/bg-button-green.gif") repeat-x scroll left top #d47100 !important;
		border: 1px solid #d47100 !important;
		color: #fff !important;
		cursor: pointer;
		display: inline-block;
		font-family: Verdana,Arial,sans-serif;
		font-size: 11px !important;
		font-weight: bold;
		padding: 4px 7px !important;
	}
	.button, #main-content table tfoot td .bulk-actions select, .pagination a.number, form input.text-input, form textarea, form .wysiwyg, form select, .dp-popup {
		border-radius: 4px;
	}
	option{
		 background-color: #0C0;
		font-size: 15px;
		padding-bottom: 5px;
		padding-top: 5px;
		color: #000000;
	}
	.tbdate{}
	.tbdate tr{}
	.tbdate tr td{
		padding-top:5px;
		padding-bottom:5px;	
	}
</style>
<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<script type="text/javascript">  
function popup(url,name,windowWidth,windowHeight){      
	myleft=(screen.width)?(screen.width-windowWidth)/2:100;   
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;     
	properties = "width="+windowWidth+",height="+windowHeight;  
	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;     
	window.open(url,name,properties);  
}  
</script>  

<link rel="stylesheet" href="../Carlender/calendar.css">
</head>

<body>
 <form action="report12.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check1(this)">
	<div id="boxdiv">
    	<ul>
        	<li style="width:170px;">
            	<select name="base1" size="10" id="base1" style="width:170px;">
                  <option value="1" onclick="window.location='?base1=1'" <?php  if($_REQUEST['base1'] == 1){echo 'selected="selected"';}?>>แยกตามประเภทลูกค้า</option>
                  <option value="2" onclick="window.location='?base1=2'" <?php  if($_REQUEST['base1'] == 2){echo 'selected="selected"';}?>>แยกตามกลุ่มลูกค้า</option>
                  <option value="3" onclick="window.location='?base1=3'" <?php  if($_REQUEST['base1'] == 3){echo 'selected="selected"';}?>>เรียงตามเลขสัญญา</option>
                  <option value="4" onclick="window.location='?base1=4'" <?php  if($_REQUEST['base1'] == 4){echo 'selected="selected"';}?>>เรียงตามรายชื่อลูกค้า</option>
                </select>
            </li>
            <li style="width:170px;">
            	 <?php  
	 	if($_REQUEST['base1'] == 1){
	 ?>
     	<select name="basebox2" size="10" id="basebox2" style="width:170px;">
             <option value="1" onclick="window.location='?base1=1&basebox2=1'" <?php  if($_REQUEST['basebox2'] == 1){echo 'selected="selected"';}?>>วันที่</option>
             <option value="2" onclick="window.location='?base1=1&basebox2=2'" <?php  if($_REQUEST['basebox2'] == 2){echo 'selected="selected"';}?>>ประเภทลูกค้า</option>
             <option value="3" onclick="window.location='?base1=1&basebox2=3'" <?php  if($_REQUEST['basebox2'] == 3){echo 'selected="selected"';}?>>พนักงานขาย</option>
        </select>
        
       <?php  }?> 
	   
	   <?php  
	 	if($_REQUEST['base1'] == 2){
			?>
			<select name="basebox2" size="10" id="basebox2" style="width:170px;">
              <option value="1" onclick="window.location='?base1=2&basebox2=1'" <?php  if($_REQUEST['basebox2'] == 1){echo 'selected="selected"';}?>>วันที่</option>
              <option value="2" onclick="window.location='?base1=2&basebox2=2'" <?php  if($_REQUEST['basebox2'] == 2){echo 'selected="selected"';}?>>กลุ่มลูกค้า</option>
              <option value="3" onclick="window.location='?base1=2&basebox2=3'" <?php  if($_REQUEST['basebox2'] == 3){echo 'selected="selected"';}?>>พนักงานขาย</option>
            </select>
			<?php 	
		}
	 ?>	   
	   <?php  
	 	if($_REQUEST['base1'] == 3){
			?> 
                        <select name="basebox2" size="10" id="basebox2" style="width:170px;">
                          <option value="1" onclick="window.location='?base1=3&basebox2=1'" <?php  if($_REQUEST['basebox2'] == 1){echo 'selected="selected"';}?>>ประเภทลูกค้า</option>
                          <option value="2" onclick="window.location='?base1=3&basebox2=2'" <?php  if($_REQUEST['basebox2'] == 2){echo 'selected="selected"';}?>>กลุ่มลูกค้า</option>
                          <option value="3" onclick="window.location='?base1=3&basebox2=3'" <?php  if($_REQUEST['basebox2'] == 3){echo 'selected="selected"';}?>>วันที่เริ่มสัญญา-สิ้นสุด</option>
                          <option value="4" onclick="window.location='?base1=3&basebox2=4'" <?php  if($_REQUEST['basebox2'] == 4){echo 'selected="selected"';}?>>พนักงานขาย</option>
                        </select>
			<?php 	
		}
	 ?>
	 
	 <?php  
	 	if($_REQUEST['base1'] == 4){
			?> 
                 <select name="basebox2" size="10" id="basebox2" style="width:170px;">
						  <option value="1" onclick="window.location='?base1=4&basebox2=1'" <?php  if($_REQUEST['basebox2'] == 1){echo 'selected="selected"';}?>>ประเภทลูกค้า</option>
                          <option value="2" onclick="window.location='?base1=4&basebox2=2'" <?php  if($_REQUEST['basebox2'] == 2){echo 'selected="selected"';}?>>กลุ่มลูกค้า</option>
                          <option value="3" onclick="window.location='?base1=4&basebox2=3'" <?php  if($_REQUEST['basebox2'] == 3){echo 'selected="selected"';}?>>วันที่เริ่มสัญญา-สิ้นสุด</option>
                          <option value="4" onclick="window.location='?base1=4&basebox2=4'" <?php  if($_REQUEST['basebox2'] == 4){echo 'selected="selected"';}?>>พนักงานขาย</option>
                 </select
			><?php 	
		}
	 ?>
            </li>
            
            <!--baseboxlist1-->
            <li style="width:170px;">
            <?php  
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 1){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <option value="1" onclick="window.location='?base1=1&basebox2=1&baseboxlist3=1'" <?php  if($_REQUEST['baseboxlist3'] == 1){echo 'selected="selected"';}?>>วันที่คีย์</option>
                          <option value="2" onclick="window.location='?base1=1&basebox2=1&baseboxlist3=2'" <?php  if($_REQUEST['baseboxlist3'] == 2){echo 'selected="selected"';}?>>วันที่เริ่มสัญญา-สิ้นสุด</option>
                          <option value="3" onclick="window.location='?base1=1&basebox2=1&baseboxlist3=3'" <?php  if($_REQUEST['baseboxlist3'] == 3){echo 'selected="selected"';}?>>วันที่ติดตั้ง</option>
                        </select>
					<?php 
				}
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 2){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <?php 
							$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgcus = @mysqli_fetch_array($quccustommer)){
								echo $row_cgcus['group_name'];
								if(substr($row_cgcus['group_name'],0,2) == "SR"){
									//if($row_cgcus['group_id'] != 1 && $row_cgcus['group_id'] != 25 && $row_cgcus['group_id'] != 7 && $row_cgcus['group_id'] != 3 && $row_cgcus['group_id'] != 23){
										?>
										<option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($runs == 1){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
										<?php 	
									//}
								}
							$runs++;}
							?>
                          
                        </select>
					<?php 
				}
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 3){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
							<?php 
                                $qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
								$runs = 1;
                                while($row_saletype = @mysqli_fetch_array($qusaletype)){
                                  ?>
                                    <option value="<?php  echo $row_saletype['group_id'];?>" ><?php  echo $row_saletype['group_name'];?></option>
                                  <?php 	
                                $runs++;}
                            ?>
                        </select>
					<?php 
				}
			?>
            </li>
            
            <!--baseboxlist1-->
            <li style="width:190px;">
            	<?php  
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 1){
					?>
						<fieldset style="height:146px;">
                        	วันที่คีย์<br /><input type="text" name="create_date" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'create_date'});</script>
                            ถึงวันที่คีย์<br /> <input type="text" name="create_dateto" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'create_dateto'});</script>
                            
                        </fieldset>
					<?php 
				}
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 2){
					?>
						<fieldset style="height:146px;">
                        	ระหว่างวันที่<br /><input type="text" name="date_quf" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script><br />
                            ถึง วันที<br /><input type="text" name="date_qut" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script>
                        </fieldset>
					<?php 
				}
				if($_REQUEST['base1'] == 1 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 3){
					?>
						<fieldset style="height:146px;">
                        	วันที่ติดตั้ง<br /><input type="text" name="cs_setting" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script>
                        </fieldset>
					<?php 
				}
				?>
            </li>
            
            <!--baseboxlist2-->
            <li style="width:170px;">
            <?php  
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 1){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <option value="1" onclick="window.location='?base1=2&basebox2=1&baseboxlist3=1'" <?php  if($_REQUEST['baseboxlist3'] == 1){echo 'selected="selected"';}?>>วันที่คีย์</option>
                          <option value="2" onclick="window.location='?base1=2&basebox2=1&baseboxlist3=2'" <?php  if($_REQUEST['baseboxlist3'] == 2){echo 'selected="selected"';}?>>วันที่เริ่มสัญญา-สิ้นสุด</option>
                          <option value="3" onclick="window.location='?base1=2&basebox2=1&baseboxlist3=3'" <?php  if($_REQUEST['baseboxlist3'] == 3){echo 'selected="selected"';}?>>วันที่ติดตั้ง</option>
                        </select>
					<?php 
				}
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 2){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <?php 
							$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgtype = @mysqli_fetch_array($qucgtype)){
							  ?>
								<option value="<?php  echo $row_cgtype['group_id'];?>"><?php  echo $row_cgtype['group_name'];?></option>
							  <?php 	
							$runs++;}
							?>
                          
                        </select>
					<?php 
				}
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 3){
					?>
					<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
							<?php 
                                $qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
								$runs = 1;
                                while($row_saletype = @mysqli_fetch_array($qusaletype)){
                                  ?>
                                    <option value="<?php  echo $row_saletype['group_id'];?>"><?php  echo $row_saletype['group_name'];?></option>
                                  <?php 	
                                $runs++;}
                            ?>
                        </select>
					<?php 
				}
			?>
            </li>
            
            <!--baseboxlist1-->
            <li style="width:190px;">
            	<?php  
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 1){
					?>
						<fieldset style="height:146px;">
                        	วันที่คีย์<br /><input type="text" name="create_date" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'create_date'});</script>
                           ถึงวันที่คีย์<br /> <input type="text" name="create_dateto" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'create_dateto'});</script>
                        </fieldset>
					<?php 
				}
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 2){
					?>
						<fieldset style="height:146px;">
                        	ระหว่างวันที่<br /><input type="text" name="date_quf" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script>
                            <br />
                          ถึง วันที<br /><input type="text" name="date_qut" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script>
                        </fieldset>
					<?php 
				}
				if($_REQUEST['base1'] == 2 && $_REQUEST['basebox2'] == 1 && $_REQUEST['baseboxlist3'] == 3){
					?>
						<fieldset style="height:146px;">
                        	วันที่ติดตั้ง<br /><input type="text" name="cs_setting" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script>
                        </fieldset>
					<?php 
				}
				?>
            </li>
            
           <!--box1=3-->
            <li style="width:190px;">
            	<?php  
					if($_REQUEST['base1'] == 3 && $_REQUEST['basebox2'] == 1){
						?>
                        <select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
						<?php 
							$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgcus = @mysqli_fetch_array($quccustommer)){
								echo $row_cgcus['group_name'];
								if(substr($row_cgcus['group_name'],0,2) == "SR"){
									//if($row_cgcus['group_id'] != 1 && $row_cgcus['group_id'] != 25 && $row_cgcus['group_id'] != 7 && $row_cgcus['group_id'] != 3 && $row_cgcus['group_id'] != 23){
									?>
									<option value="<?php  echo $row_cgcus['group_id'];?>"><?php  echo $row_cgcus['group_name'];?></option>
									<?php 
									//}
								}
							$runs++;}
							?>
                            </select>
						<?php 
					}
					if($_REQUEST['base1'] == 3 && $_REQUEST['basebox2'] == 2){
						?>
						<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <?php 
							$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgtype = @mysqli_fetch_array($qucgtype)){
							  ?>
								<option value="<?php  echo $row_cgtype['group_id'];?>"><?php  echo $row_cgtype['group_name'];?></option>
							  <?php 	
							$runs++;}
							?>
                          
                        </select>
						<?php 	
					}
					if($_REQUEST['base1'] == 3 && $_REQUEST['basebox2'] == 3){
						?>
						<fieldset style="height:146px;">
                        	ระหว่างวันที่<br /><input type="text" name="date_quf" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script><br />
                            ถึง วันที<br /><input type="text" name="date_qut" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script>
                        </fieldset>
						<?php 
					}
					if($_REQUEST['base1'] == 3 && $_REQUEST['basebox2'] == 4){
						?>
						<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
							<?php 
                                $qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
								$runs = 1;
                                while($row_saletype = @mysqli_fetch_array($qusaletype)){
                                  ?>
                                    <option value="<?php  echo $row_saletype['group_id'];?>"><?php  echo $row_saletype['group_name'];?></option>
                                  <?php 	
                                $runs++;}
                            ?>
                        </select>
						<?php 
					}
				?>
            </li>
            
            
            <!--box1=4-->
            <li style="width:190px;">
            	<?php  
					if($_REQUEST['base1'] == 4 && $_REQUEST['basebox2'] == 1){
						?>
                        <select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
						<?php 
							$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgcus = @mysqli_fetch_array($quccustommer)){
								echo $row_cgcus['group_name'];
								if(substr($row_cgcus['group_name'],0,2) == "SR"){
									//if($row_cgcus['group_id'] != 1 && $row_cgcus['group_id'] != 25 && $row_cgcus['group_id'] != 7 && $row_cgcus['group_id'] != 3 && $row_cgcus['group_id'] != 23){
									?>
									<option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($runs == 1){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
									<?php 
									//}
								}
							$runs++;}
							?>
                            </select>
						<?php 
					}
					if($_REQUEST['base1'] == 4 && $_REQUEST['basebox2'] == 2){
						?>
						<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
                          <?php 
							$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
							$runs = 1;
							while($row_cgtype = @mysqli_fetch_array($qucgtype)){
							  ?>
								<option value="<?php  echo $row_cgtype['group_id'];?>"><?php  echo $row_cgtype['group_name'];?></option>
							  <?php 	
							$runs++;}
							?>
                          
                        </select>
						<?php 	
					}
					if($_REQUEST['base1'] == 4 && $_REQUEST['basebox2'] == 3){
						?>
						<fieldset style="height:146px;">
                        	ระหว่างวันที่<br /><input type="text" name="date_quf" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script><br />
                            ถึง วันที<br /><input type="text" name="date_qut" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script>
                        </fieldset>
						<?php 
					}
					if($_REQUEST['base1'] == 4 && $_REQUEST['basebox2'] == 4){
						?>
						<select name="baseboxlist3" size="10" id="baseboxlist3" style="width:170px;">
							<?php 
                                $qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
								$runs = 1;
                                while($row_saletype = @mysqli_fetch_array($qusaletype)){
                                  ?>
                                    <option value="<?php  echo $row_saletype['group_id'];?>"><?php  echo $row_saletype['group_name'];?></option>
                                  <?php 	
                                $runs++;}
                            ?>
                        </select>
						<?php 
					}
				?>
            </li>
            
            
        </ul>
    </div>
    
    <?php  
	/*if($_GET['base1'] == 3 && !isset($_GET['basebox2'])){
	?>
    	<div style="clear:both;padding-top:20px;font-size:13px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdate">
              <tr class="formFields">
                <td width="5%" nowrap="nowrap" class="name">&nbsp;</td>
                <td width="95%"><span class="name">
                  <input name="cont_priod" type="radio" value="0" />
                  กำหนดช่วงสัญญา&nbsp;
                  <input name="cont_priod" type="radio" value="1" checked="checked"/>
                  ไม่กำหนดช่วงสัญญา</span></td>
              </tr>
              <tr class="formFields">
                <td nowrap="nowrap" class="name">เริ่มสัญญา</td>
                <td><input type="text" name="cont_fm" value="R" class="inpfoder"/>
                 &nbsp;<small><strong>Ex.R5701001</strong></small></td>
              </tr>
              <tr class="formFields">
                <td nowrap="nowrap" class="name">ถึงสัญญา</td>
                <td><input type="text" name="cont_to" value="R" class="inpfoder"/>
                  &nbsp;<small><strong>Ex.R5701005</strong></small>
                  </td>
              </tr>
        </table>
        </div>
     <?php  }*/?>
     
     <?php  
	 	if($_GET['base1'] == 4){
     		?>
			
        <div style="clear:both;padding-top:20px;font-size:13px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdate">
          <tr class="formFields">
            <td width="7%" nowrap="nowrap" class="name">ชื่อร้าน-ชื่อบริษัท : </td>
            <td width="93%"><input name="cd_name" type="text" id="cd_name"  value="" style="width:500px;height:25px;"><a href="javascript:popup('search_company.php','',500,400)"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
          </tr>
        </table>
        </div>
			
			<?php 
     	}
	 ?>
     
    <?php  
		if(($_GET['base1'] != 1 || $_GET['basebox2'] != 1) && ($_GET['base1'] != 2 || $_GET['basebox2'] != 1) && ($_GET['base1'] != 3 || $_GET['basebox2'] != 3) && ($_GET['base1'] != 4 || $_GET['basebox2'] != 3)){
			?>
			<div style="clear:both;padding-top:20px;font-size:13px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdate">
              <tr class="formFields">
                <td width="5%" nowrap="nowrap" class="name">&nbsp;</td>
                <td width="95%"><span class="name">
                  <input name="priod" type="radio" value="0" />
                  กำหนดช่วงเวลา&nbsp;
                  <input name="priod" type="radio" value="1" checked="checked" />
                  ไม่กำหนดช่วงเวลา</span></td>
              </tr>
              <tr class="formFields">
                <td nowrap="nowrap" class="name">เริ่มวันที่</td>
                <td><input type="text" name="date_fm" readonly="readonly" value="<?php  echo date("d/m/Y");?>" class="inpfoder"/>
                  <script language="JavaScript" type="text/javascript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
              </tr>
              <tr class="formFields">
                <td nowrap="nowrap" class="name">ถึงวันที่</td>
                <td><input type="text" name="date_to" readonly="readonly" value="<?php  echo date("d/m/Y");?>" class="inpfoder"/>
                  <script language="JavaScript" type="text/javascript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
              </tr>
        </table>
            </div>
			<?php 	
		}
	?>
    
    <div style="clear:both;padding-top:20px;font-size:13px;">
        <input name="sh1" type="checkbox" id="sh1" value="1" checked>
                              สัญญาเช่า
                              <input name="sh2" type="checkbox" id="sh2" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh3" type="checkbox" id="sh3" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              <input name="sh4" type="checkbox" id="sh4" value="1" checked>
                              ประเภทลูกค้า 
                              <input name="sh10" type="checkbox" id="sh10" value="1" checked="checked" />
กลุ่มลูกค้า <br>
                              <input name="sh5" type="checkbox" id="sh5" value="1" checked>
                              ประเภทสินค้า
                              <input name="sh6" type="checkbox" id="sh6" value="1" checked>
                              รุ่นเครื่อง/SN/
                              <input name="sh7" type="checkbox" id="sh7" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh8" type="checkbox" id="sh8" value="1" checked>
                              วันเริ่มสัญญา
                              <input name="sh9" type="checkbox" id="sh9" value="1" checked>
                              วันสิ้นสุดสัญญา
    </div>
    <div style="clear:both;padding-top:20px;">
        <input type="submit" name="Submit" value="Submit" class="button">
    </div>
    </form>
<br /><br /><br /><br />
</body>
</html>
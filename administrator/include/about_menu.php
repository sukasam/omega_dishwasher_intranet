<div style=" margin-bottom:20px;">
 <UL class=shortcut-buttons-set style=" list-style:none;">

  <LI style="text-align:center; margin-bottom:20px;">
    <div align="center"><A href="../about/?smid=1&mid=3">
      <img src="../images/icons/icon-48-menumgr.png" border="0"/><BR>
      ประวัติภาควิชา</A> </div>
  </LI>
  
  <LI style="text-align:center">
    <div align="center"><A href="../about_gallery/?smid=2&mid=3"><SPAN><img src="../images/icons/icon-48-media.png" border="0" /><BR>
      รูปภาพภาควิชา</SPAN></A> </div>
  </LI>
  
  <LI style="text-align:center">
    <div align="center"><A  href="../major/?smid=3&mid=3"><SPAN><img src="../images/icons/icon-48-module.png" border="0" /><BR>
      สาขาภาควิชา</SPAN></A> </div>
  </LI>
  
  <LI style="text-align:center">
    <div align="center"><A  href="../strategy/?smid=4&mid=3"><SPAN><img src="../images/icons/icon-48-section.png" width="48" height="48" border="0" /><BR>
      ยุทธศาสตร์</SPAN></A> </div>
  </LI>
  
  <LI style="text-align:center">
    <div align="center"><A href="../ie/?smid=5&mid=3"><SPAN><img src="../images/icons/icon-48-cpanel.png" border="0" /><BR>
      วิศวกรรมของเรา</SPAN></A>  
      </div>
  </LI>
  
   <LI style="text-align:center">
     <div align="center"><A  href="../ie_profile?smid=6&mid=3"><SPAN><img src="../images/icons/icon-48-content.png" border="0" /><BR>
       ผลงาน IE</SPAN></A>
       </div>
   </LI>
   
   <LI style="text-align:center">
     <div align="center"><A  href="../lab"><SPAN><img src="../images/icons/icon-48-extension.png" border="0" /><BR>
       Laboratories</SPAN></A></div>
   </LI>
    <div align="center">
      <?php  
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
      </div>
    <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 <> "") echo $param2;?>"><SPAN><IMG src="../images/btn_back.gif"  alt=icon width="35" border="0"><BR>
    Back</SPAN></A></LI>
  <?php  }?> 
</UL>

</div>

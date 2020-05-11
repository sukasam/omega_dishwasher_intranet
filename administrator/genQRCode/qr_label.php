<?php
$form = '<table><tr>';

for($i=0;$i<count($nameTec);$i++){
    $form .= '<td style="width:50%" style="padding-left: 40px;padding-right: 40px;">
                <center>
                    <img src="head_odt.jpg" width="250" border="0" /><br><br>
                    '.$nameQR[$i].'<br><br>
                    '.$nameSN[$i].'<br><br>
                    <img src="foo_odt.jpg" width="250" border="0" /><br><br>
                    '.$nameTec[$i].'
                    <br><br><br><br>
                </center>
            </td>
            ';
    if($i % 2 == 1){$form .= "<tr>";}
}
            
$form .='</tr></table>';
?>
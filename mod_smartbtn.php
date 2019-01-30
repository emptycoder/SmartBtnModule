<?php
/**
 * Hello World! Module Entry Point
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;

echo'<link href="/templates/yoo_luna/css/custom.css" rel="stylesheet">
		<script>
			function slide(){ $(\'.slideForm\').slideToggle(); } 
			function getValue(str) { if (document.getElementsByTagName("html")[0].getAttribute("lang") == "ru-ru") { return str.split(\'~\')[0]; } else { return str.split(\'~\')[1]; } }
			function checkSizeOfData(str) {
	            var res = 0, afterSymb = -1;
	            for(i=0; i < str.length; i++){
					if (afterSymb > -1) { afterSymb++; }
	                if(str.charAt(i) == \'@\'){
						afterSymb = 0;
	                    res++;
						if (res > 1) { return false; }
	                }
					else if (afterSymb > -1 && str.charAt(i) == \'.\') {
						if (afterSymb > 8) { return false; }
						if (str.length - i - 1 > 5) { return false; } 
						afterSymb = 0;
					}
	            }
				if (res == 0) { return false; }
				
				return true;
			}
			function sendS() { if (document.getElementById(\'inputTextS\').value == ""
					|| document.getElementById(\'NameS\').value == ""
					|| document.getElementById(\'EmailS\').value == "") {
						alert(getValue("'.$params->get("eFields").'"));
					}
					else if (!checkSizeOfData(document.getElementById(\'EmailS\').value)) {
						alert(getValue("'.$params->get("eEmail").'"));
					}
					else {
						var sc=document.createElement("SCRIPT");
						sc.src="/floatModule/mail.php?email="+document.getElementById(\'EmailS\').value+"&name="+document.getElementById(\'NameS\').value+"&message="+document.getElementById(\'inputTextS\').value + "&form=1";

						document.body.appendChild(sc);
					
						delete(sc);

						document.getElementById(\'inputTextS\').value = "";
						document.getElementById(\'EmailS\').value = "";
						document.getElementById(\'NameS\').value = "";

						var temp = document.getElementById(\'slideID\').innerHTML;
						document.getElementById(\'slideID\').innerHTML = \'<center><H1 class="'.$params->get("successClass").'">\' + getValue(\''.$params->get("sEmail").'\') + \'</H1></center>\';

						setTimeout(function() {
							$(\'.slideForm\').slideToggle();
							document.getElementById(\'slideID\').innerHTML = temp;
						}, 1600);

					} }</script>';
echo '<style>.slideForm { display: none; }</style><br><center><a id="OrderS" class="confirm confirmH bOpenClose" href="javascript:slide()"></a></center>';

echo '<div id="slideID" class="'.$params->get("formClass").'"><input id="NameS" maxlength="20" onkeypress="return filter_input(event,/[A-Z \'А-Я]/i)" class="'.$params->get("fNameClass").'" placeholder=""><hr><input id="EmailS" maxlength="40" onkeypress=""  class="'.$params->get("fEmailClass").'" placeholder="'.$params->get("fEmail").'"><hr><textarea type="text" maxlength="800" id="inputTextS" class="'.$params->get("fTextClass").'" placeholder=""></textarea><center><a id="ConfirmS" class="'.$params->get("bSendClass").'" disable href="javascript:sendS()"></a></center></div>';

echo '<script>document.getElementById("NameS").setAttribute("placeholder", getValue("'.$params->get("fName").'")); document.getElementById("inputTextS").setAttribute("placeholder", getValue("'.$params->get("fInputText").'")); document.getElementById("EmailS").setAttribute("onkeypress", \'return filter_input(event,/[A-ZА-Я@._0-9+="]/i)\'); document.getElementById("OrderS").innerHTML = getValue("'.$params->get("bOpenClose").'"); document.getElementById("ConfirmS").innerHTML = getValue("'.$params->get("bSend").'");</script>';
?>
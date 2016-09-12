<?php
	session_start();
	include("capcha.php");	
	capcha::phpcaptcha('#162453','#fff',120,40,10,25);
 ?>
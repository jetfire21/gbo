<?php
/* ************ send mail *********** */
function back_call(){
	
		// if($_POST['name']) $arr['name'] = trim(strip_tags($_POST['name']));			
		// if($_POST['email']) $arr['email'] = trim($_POST['email']);					
		// if($_POST['message']) $arr['message'] = trim($_POST['message']);	
		if($_POST['phone']) $arr['phone'] = trim(strip_tags($_POST['phone']));	
		if($_POST['name_form']) $arr['name_form'] = trim(strip_tags($_POST['name_form']));	
			
		if(  !empty($arr['phone'])) {
			
			// if( preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $arr['email']) )
			// {

				$to = 'freerun-2012@yandex.ru'; /**** 21arenda@gmail.com ****/
				$to2 = 'gazoved21@mail.ru'; /**** 21arenda@gmail.com ****/
				$sitename = $_SERVER['HTTP_HOST'];
				$subject = "Заявка с сайта Установка ГБО";
				$message = "Из формы: " .$arr['name_form'].  "\r\nТелефон: " . $arr['phone'];
				$headers = "From: {$sitename} <" .$to. ">\r\nContent-type:text/plain; charset=utf-8\r\n";
				mail($to,$subject,$message,$headers);
				// mail($to2,$subject,$message,$headers);
				$arr['res'] = 'success';
				echo json_encode($arr); 
			// }
			// else{
			// 	$arr['res'] = 'error_email'; 
			// 	echo json_encode($arr);
			// }
		}
		else{
			$arr['res'] = 'error_empty'; 
			echo json_encode($arr);
		 }
}
back_call();
?>
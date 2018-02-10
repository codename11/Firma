<?php
require '../funkcije.php';

if($_POST){

// Enter the email where you want to receive the message

    $emailTo = 'veljkos82@gmail.com';

	$obj1 = new Validation($_POST['email']);
	$clientEmail = $obj1 -> test_input($obj1 -> getData());
	$temp = ($obj1 -> isEmail($obj1 -> getData()));
	
	$obj2 = new Validation($_POST['subject']);
	$subject = $obj2 -> test_input($obj2 -> getData());
	
	$obj3 = new Validation($_POST['message']);
	$message= $obj3 -> test_input($obj3 -> getData());
	
	$array = array('emailMessage' => '', 'subjectMessage' => '', 'messageMessage' => '');
	
	if(!(isset($temp)) || (empty($temp))){
		$array['emailMessage'] = 'Invalid email!';
	}
	
	if($subject == '') {
        $array['subjectMessage'] = 'Empty subject!';
    }
    if($message == '') {
        $array['messageMessage'] = 'Empty message!';
    }
    if(isset($temp) && !(empty($temp)) && $subject != '' && $message != '') {
        // Send email
		$headers = "From: " . $clientEmail . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
		mail($emailTo, $subject, $message, $headers);
    }

    echo json_encode($array);
	
}

?>
<?php 
$errors = '';
$myemail = 'edinazigonja454@gmail.com';//
if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['message']; 
$conn = @mysqli_connect("localhost", "root", "", "agencija") or die("Connection Error: " . @mysqli_error($conn));
	$sql = "CREATE TABLE IF NOT EXISTS contact(name VARCHAR(50) NOT NULL,
       email_address VARCHAR(50) NOT NULL, message VARCHAR(50) NOT NULL   
  )";
  mysqli_query ($conn, $sql) or die("Tabela nije kreirana. ");
	@ mysqli_query($conn, "INSERT INTO contact (name, email_address,message) VALUES ('" . $name. "', '" . $email_address. "','" . $message. "')");
	$insert_id = mysqli_insert_id($conn);
	//if(!empty($insert_id)) {
	   $message = "Tvoje informacije su uspješno sačuvane!.";
	   $type = "success";
if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
?>
<script>alert("Hvala na poslanoj poruciiii!")</script>
<?php
	//redirect to the 'thank you' page
	header('Location: contact-form-thank-you.html');
} 
?>
<!DOCTYPE HTML> 
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<?php
echo nl2br($errors);
?>


</body>
</html>
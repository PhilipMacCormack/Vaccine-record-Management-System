<?
session_start();
include "db.php";

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['support_email'], $_POST['message'], $_POST['subject'])) {
	// Could not get the data that should have been sent.
    $message = 'Please complete email, subject and message.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/contactpage.php?message='.$message.'&error='.$error);
	exit();
}

// check that email is valid
if (!filter_var($_POST['support_email'], FILTER_VALIDATE_EMAIL)) {
    $message = 'Email is not valid.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/contactpage.php?message='.$message.'&error='.$error);
    exit();
}

// Check that the captcha is correct
if ($_POST['captcha_code'] != $_SESSION['captcha_text']){
    $message = 'Incorrect captcha.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/contactpage.php?message='.$message.'&error='.$error);
    exit();
}

$unresolved = 'Unresolved';
// email is valid insert new message
if ($stmt = $conn->prepare('INSERT INTO messages (support_email, message, subject, status) VALUES (?,?,?,?)')) {
    $stmt->bind_param('ssss', $_POST['support_email'], $_POST['message'], $_POST['subject'], $unresolved);
    $stmt->execute();
    $message = 'Message Sent, You will be contacted by the mail you entered in 1-4 working days';
    header('Location: /Catwoman-IMS/contactpage.php?message='.$message);
}
else {
    echo 'Could not prepare insert query statement!';
}
$stmt->close();
$conn->close();
?>


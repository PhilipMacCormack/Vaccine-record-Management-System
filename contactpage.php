<?php
session_start();
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<head>
  <title>Contact Us & FAQ</title>
</head>

<!-- Top navigation bar -->
<body>
  <div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/index.html" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <a href="/Catwoman-IMS/contactpage.php" class="w3-bar-item w3-button w3-left">&emsp;Contact&emsp;</a>
    <a href="/Catwoman-IMS/about.html" class="w3-bar-item w3-button w3-left">&emsp;About&emsp;</a>
    <a href="/Catwoman-IMS/loginpage_patient.html" class = "w3-bar-item w3-button w3-right">Patient Log in</a>
    <a href="/Catwoman-IMS/loginpage_worker.html" class = "w3-bar-item w3-button w3-right">Authenticated Log in</a> 
  </div>

<!-- UniVaP logo -->
<div class="container">
  <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
      <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
      <p><b>Unified Vaccination Platform</b></p>
  </header>
</div>

<?php if (isset($_GET['message'])){?>
  <div class="mailmessage"><center><p><u><b><font color="red"><?php echo $_GET['error']; ?></font></u> <i><?php echo $_GET['message']; ?></b></i></p></center></div>
<?php } ?>

    <!--FAQs & Contact form-->
    <section class="all-boxes">

      <!--FAQs-->
      <div class="box">
        <h2>
          <b>Do you have a question?</b>
        </h2>
        <form action="/Catwoman-IMS/faqs.html">
          <button type="submit">See FAQs</button>
        </form>
      </div>

      <!--Contact form-->
      <div class="box">
        <h2>
          <b>Contact Us</b>
        </h2>
        <form action="/Catwoman-IMS/contact.php" method="post" id='form'>
          <label for="support_email">Email</label>
          <input type="text" placeholder="Your email address" name="support_email" id="support_email" required><br>
          <label for="message">Message</label><br>
          <input type="text" placeholder="Subject" name="subject" id="subject" required><br>
          <textarea placeholder="Write your message here..." name="message" id="message" required></textarea><br>
          <label for="captcha_code">Verify that you're not a robot</label>
                <input name="captcha_code" type="text" placeholder="Enter the text in the image below"><br>
                <label for="captchaimage"></label>
                <img src="db_create/captcha.php" alt="CAPTCHA" name="captchaimage" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i><br><br>
          <button type="submit">Send</button>
        </form>

      </div>
    </section>


<!-- Footer on bottom of page -->
<div class="footer">
  <a href="/Catwoman-IMS/privacy.html">Privacy</a>
  /
  <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
</div>

</body>
</html>

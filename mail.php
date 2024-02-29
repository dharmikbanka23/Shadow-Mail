<?php
// Include the Composer autoloader
require 'vendor/autoload.php';

require 'MailSender.php';

// Start the session
session_start();

// If cookie with name exists, redirect to mail.php
if (!isset($_COOKIE['name'])) {
  header("Location: index.php");
  exit();
} 
else {
  // Get the cookie value
  $name = $_COOKIE['name'];
  
  // Load environment variables from .env file
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  
  // Get the value of the EMAIL environment variable
  $email = getenv('EMAIL');
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate and sanitize input
  $receiverEmail = filter_var($_POST["to"], FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars($_POST["subject"]);
  $emailBody = htmlspecialchars($_POST["body"]);

  // Store the receiver email in the session
  $_SESSION['receiver'] = $receiverEmail;
  echo $_SESSION["receiver"];

  // Send the email using the MailSender class
  if (MailSender::sendEmail($receiverEmail, $subject, $emailBody)) {
    header("Location: option.php");
  } 
  else {
    echo '<script>alert("Error sending email.");</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shadow Mail</title>
  <link rel="stylesheet" href="./mail.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <!-- Mail Page -->
  <div class="container mx-auto my-auto">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center my-auto">Shadow Mail</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group my-2">
                <label class="mb-2" for="name">Anonymous Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" disabled>
              </div>
              <div class="form-group my-2">
                <label class="mb-2" for="from">From:</label>
                <input type="text" class="form-control" name="from" id="from" value="<?php echo $email; ?>" disabled>
              </div>
              <div class="form-group my-2">
                <label class="mb-2" for="to">To:</label>
                <input type="text" class="form-control" name="to" id="to" placeholder="Enter receiver's email" value="<?php if (isset($_SESSION["receiver"])) echo $_SESSION["receiver"]; ?>" autocomplete="off" required>
              </div>
              <div class="form-group my-2">
                <label class="mb-2" for="subject">Subject:</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject" autocomplete="off" required>
              </div>
              <div class="form-group my-2">
                <label class="mb-2" for="body">Body:</label>
                <textarea class="form-control" name="body" id="body" placeholder="Enter your message (max 500 characters)" rows="3" maxlength="500" style="resize: none;" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-block mx-auto mt-3 d-block">Send Mail</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
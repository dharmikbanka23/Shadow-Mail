<?php

// If cookie with name exists, redirect to mail.php
if (!isset($_COOKIE['name'])) {
  header("Location: index.php");
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
  <!-- Access Page -->
  <div class="container mx-auto my-auto">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center my-auto">Shadow Mail</h4>
          </div>
          <div class="card-body">
            <h5 class="text-center">Mail Sent Successfully</h5>
            <div class="d-flex justify-content-center mt-2">
              <button class="btn btn-success mx-1" onclick="sendAnother()">Send Another</button>
              <button class="btn btn-primary mx-1" onclick="startAgain()">Start Again</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script>
  function sendAnother() {
    // Redirect back to mail.php
    window.location.href = "mail.php";
  }

  function startAgain() {
    // Redirect to logout.php
    window.location.href = "logout.php";
  }
</script>
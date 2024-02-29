<?php
// If cookie with name exists, redirect to mail.php
if (isset($_COOKIE['name'])) {
  // Reset the cookie expiration to 1 hour
  setcookie('name', $_COOKIE['name'], time() + 60*60,'/');
  header("Location: mail.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shadow Mail</title>
  <link rel="stylesheet" href="./index.css">
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
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group my-2">
                <label class="mb-2" for="name">Anonymous Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter an anonymous name" autocomplete="off" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block mx-auto mt-3 d-block">Access</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<?php
// Set the user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
      // Set the time to one hour
      setcookie('name', $_POST['name'], time() + 60*60,'/');
      header("Location: mail.php");
    }
}
?>
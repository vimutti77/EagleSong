<?php
  include('config.php');
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT id, email FROM User WHERE email = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
      $_SESSION['email'] = $myusername;
      $_SESSION['id'] = $row['id'];
      $db->close();
      header("location: ./index.php");
    }
  }
?>
<html>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./styles/snackbar.css">
  <link rel="stylesheet" type="text/css" href="./styles/customer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Customer Login</title>
  <body>
    <div id="snackbar"></div>
    <div class="container" style="width:400px;height:300px;padding:40px;position:fixed;top:40%;left:50%;margin-top:-150px;margin-left:-200px">
      <h2><font size="6">Customer Login</font>	</h2>
      <form action = "" method = "post">

        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="email" type="text" class="form-control" name="username" placeholder="Email" style="width:100%" required>
        </div>
        <br>

        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password" type="password" class="form-control" name="password" placeholder="Password" style="width:100%" required>
        </div>
        <br>
        <input a class="btn btn-primary" type = "submit" value = " Login ">
        <div id="text" style="color: red"></div><br>
      </form>
    </div>
  </body>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($count != 1) {
      echo '
          <script>
            var x = document.getElementById("text");
            x.innerHTML = "You enter wrong email or password!";
          </script>
        ';
      $db->close();
    }
  }?>
</html>

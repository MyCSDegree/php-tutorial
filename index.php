<?php
  session_start();

  if (isset($_SESSION['user_data'])):
    $userdata = $_SESSION['user_data'];
?>
<html>
  <head>
    <title>auth protocol</title>
  </head>
  <body>
    <h2>Welcome, <?php echo $userdata['name'] ?>!</h2>
    <br />
    <strong>regno: </strong><?php echo $userdata['regno'] ?>
    <br />
    <strong>pass(sha): </strong><?php echo $userdata['pass'] ?>
    <br /><br />
    <a href="logout.php">Logout</a>
  </body>
</html>
<?php
  else: // if isset($_SESSION['user_data'])
?>
<html>
  <head>
    <title>auth protocol</title>
  </head>
  <body>
    you are not authorized!<br />
    please <a href="/login.php">login</a> or <a href="/adduser.php">signup</a> to continue!
  </body>
</html>
<?php
  endif; // else
?>

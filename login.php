<?php
// we'll start session first!
session_start();

if (isset($_SESSION['user_data']))
 goto _user_logged_in;
?>
<html>
<head>
  <title>login</title>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
  <h2>login</h2>

  <div id="loginForm">
    regNo: <input type="text" name="regno" id="regno">
    <br />
    password: <input type="password" name="pass" id="pass">
    <br />
    <button type="button" id="submitBtn">Submit</button>
  </div>

  <script>
    $('#submitBtn').click(function() {
      var regno = $('#regno').val(); // get value of input id 'regno'
      var pass  = $('#pass').val(); // get value of input id 'pass'

      // if even one of them is empty, show error
      if (regno == '' || pass == '') {
        alert("invalid input!");
        return;
      }

      // if regno isnt 10 characters long
      if (regno.length != 10) {
        alert("invalid regno!");
        return;
      }

      // if password length less than 6, alert user
      // we specified password to be more than 6 char's ;)
      if (pass.length < 6) {
        alert("invalid password!");
        return;
      }

      // we have validated user input. let's send ajax
      $.ajax({
        type: "POST",
        url: '/getLogin.php',
        data: {
          "regno"   : regno,
          "pass"    : pass,
        },
        dataType: 'json',
        success: function(response) {
          if (response.code != 0) {
            alert(response.msg);
          } else {
            $('#loginForm').append('login success! goto <a href="/index.php">home</a>');
          }
        },
      });
    });
  </script>
</body>
</html>
<?php
goto _exit;

_user_logged_in:
  echo "user logged in!";

_exit:
?>

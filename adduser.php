<html>
<head>
  <title>authprotocol</title>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    <h2>add user</h2>

    <div id="addUserForm">
      regNo: <input type="text" name="regno" id="regno">
      <br />
      password: <input type="password" name="pass" id="pass">
      <br />
      name: <input type="text" name="usrname" id="usrname">
      <br />
      <button type="button" id="submitBtn">Submit</button>
    </div>

    <script>
      $('#submitBtn').click(function() {
        var regno = $('#regno').val(); // get value of input id 'regno'
        var pass  = $('#pass').val(); // get value of input id 'pass'
        var usr   = $('#usrname').val(); // get value of input id 'usrname'

        // if even one of them is empty, show error
        if (regno == '' || pass == '' || usr == '') {
          alert("invalid input!");
          return;
        }

        // if regno isnt 10 characters long
        if (regno.length != 10) {
          alert("invalid regno!");
          return;
        }

        // if password length less than 6, alert user
        if (pass.length < 6) {
          alert("small password!");
          return;
        }

        // we have validated user input. let's send ajax
        $.ajax({
          type: "POST",
          url: '/createUser.php',
          data: {
            "regno"   : regno,
            "pass"    : pass,
            "name"    : usr,
          },
          dataType: 'json',
          success: function(response) {
            if (response.code != 0) {
              alert(response.msg);
            } else {
              $('#addUserForm').append('user added! goto <a href="/login.php">login</a>');
            }
          },
        });

      });
    </script>
</body>
</html>

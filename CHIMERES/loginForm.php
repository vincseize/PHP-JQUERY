        <form action="" method="post" name="LoginForm" autocomplete="off">
          <table cellpadding="5" cellspacing="1" class="loginTable marginLoginEdit">
            <?php if (isset($msg) ) {?>
            <tr>
              <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
            </tr>
            <?php } ?>
            <!-- <tr>
              <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
            </tr> -->
            <tr>
              <!-- <td align="right" valign="top">Username</td> -->
              <td><input id="Username" name="Username" type="text" class="Input" autocomplete="new-password" placeholder="Login" value=""></td>
            </tr>
            <tr>
              <!-- <td align="right">Password</td> -->
              <td>
                    <!-- <div style="display:none">
                        <input type="password" tabindex="-1"/>
                    </div> -->
                    <input id="Password" name="Password" type="text" class="Input" autocomplete="off" placeholder="Password" value="">
                    <br><br>
                    <input id="rememberChkBox" type="checkbox"> &nbsp; Remember Me
                    <br><br>
                </td>
            </tr>
            <tr>
              <!-- <td> </td> -->
              <td>
              
              <?php if (!isset($_SESSION['UserData']['Username'] )) {?>
                <input class="BTcancel buttonForm" id="BTcancel" type="button" onclick="location.href='logout.php'" value="Cancel"/>
              <?php } ?>

              <?php if (!isset($_SESSION['UserData']['Username'] )) {?>
                <input class="BTlogin buttonForm" id="BTlogin" name="Submit" type="submit" value="Login"></td>
              <?php } ?>
              </td>
            </tr>
          </table>
        </form>


<script>

// console.log(localStorage.getItem("username"));
// console.log(localStorage.getItem("password"));

jQuery(document).ready(function($){

  if ("rememberMe" in localStorage) {
    if(localStorage.getItem('rememberMe')=='true'){
      $('#rememberChkBox').prop('checked', true);
      // alert('true');
    }
  }

  if ("username" in localStorage) {
    // document.getElementById("#Username").val(localStorage.getItem('username'));
    $('#Username').val(localStorage.getItem('username'));
  }
  if ("password" in localStorage) {
    // document.getElementById("#Password").val(localStorage.getItem('password'));
    $('#Password').val(localStorage.getItem('password'));
  }

  $('.BTlogin').on('click', function(event){

    let username = document.getElementById("Username").value;
    let password = document.getElementById("Password").value;

  if ($('#rememberChkBox').is(':checked')) {
    localStorage.setItem('username',username);
    localStorage.setItem('password',password);
    localStorage.setItem('rememberMe','true');
  } else {
    localStorage.clear();
    localStorage.setItem('username','');
    localStorage.setItem('password','');
  }

  });


});

</script>

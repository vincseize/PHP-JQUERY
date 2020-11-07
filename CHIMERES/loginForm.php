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
              <td><input name="Username" type="text" class="Input" value="admin" autocomplete="new-password" placeholder="Login"></td>
            </tr>
            <tr>
              <!-- <td align="right">Password</td> -->
              <td>
                    <!-- <div style="display:none">
                        <input type="password" tabindex="-1"/>
                    </div> -->
                    <input name="Password" type="text" class="Input" autocomplete="new-password" placeholder="Password" value="">
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
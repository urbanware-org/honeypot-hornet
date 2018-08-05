<html>
  <head>
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
      }
    </style>
  </head>
  <body>
    <div id="login" style="border-style: solid; margin-left: auto; margin-right: auto; padding: 0px 10px 0px 10px; width: 400px;">
      <h1>Administration</h1>
      <?php
          /******************************************************************************
           * honeypot-hornet - Enhanced website directory honeypot                      *
           * Copyright (C) 2018 by Ralf Kilian                                          *
           * Distributed under the MIT License (https://opensource.org/licenses/MIT)    *
           *                                                                            *
           * GitHub: https://github.com/urbanware-org/honeypot-hornet                   *
           * GitLab: https://gitlab.com/urbanware-org/honeypot-hornet                   *
           ******************************************************************************/
        
          if ($_POST['username'] != "") {
              $username = $_POST['username'];
              $password = $_POST['password'];
              $method = "POST";
          } else {
              $username = $_GET['username'];
              $password = $_GET['password'];
              $method = "GET";
          }            
          
          if ($username == "") {
              $subtitle = "Please log in.";
              $method = "";
          } elseif ($username == "admin") {
              $subtitle = "Invalid password for user " . $username . "!";
              sleep(rand(1, 2));
              http_response_code(401);    // requires PHP 5.4 or higher
          } else {
              $subtitle = "User " . $username . " does not exist!";
              sleep(rand(1, 2));
              http_response_code(401);    // requires PHP 5.4 or higher
          }
          
          // Log the login attempt
          if ($method != "") {
              $directory = getcwd();
              $agent = $_SERVER['HTTP_USER_AGENT'];
              if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
              } else {
                  $ip_address = $_SERVER['REMOTE_ADDR'];
              }
              
              $file = 'logfile.txt';
              $timestamp = date("[Y-m-d - H:i:s]");
              file_put_contents($file, $timestamp . " Attempt to log in at '" . $directory . "'\n", FILE_APPEND);
              file_put_contents($file, $timestamp . " Login method: '" . $method . "'\n", FILE_APPEND);
              file_put_contents($file, $timestamp . " Username: '" . $username . "'\n", FILE_APPEND);
              file_put_contents($file, $timestamp . " Password: '" . $password . "'\n", FILE_APPEND);
              file_put_contents($file, $timestamp . " IP address: " . $ip_address . "\n", FILE_APPEND);
              file_put_contents($file, $timestamp . " User agent: " . $agent . "\n\n", FILE_APPEND);
          }
      ?>        
      <form action="index.php" method="post">
      <?php echo "<p>" . $subtitle . "</p>"; ?>
        Username: <br /><input type="text" name="username" style="width: 100%" /><br /><br />
        Password: <br /><input type="password" name="password" style="width: 100%" /><br /><br />
        <input type="Submit" value="Login" />
      </form>
    </div>
  </body>
</html>


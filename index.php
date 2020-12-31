<html lang="en">

<head>
   <title>Login</title>
   <link rel="stylesheet" href="assets\scss\main.css">
</head>

<body>
   <div class="box">
      <h2>User Login</h2>
      <div class="text">
         <?php
         $msg = '';
         if (
            isset($_POST['login'])
            && !empty($_POST['username'])
            && !empty($_POST['password'])
         ) {
            if (
               $_POST['username'] == 'Sigita' &&
               $_POST['password'] == 'Paulikaite'
            ) {
               $_SESSION['logged_in'] = true;
               $_SESSION['timeout'] = time();
               $_SESSION['username'] = 'Mindaugas';
               echo 'You have entered valid use name and password';
            } else {
               $msg = 'Wrong username or password';
            }
         }
         ?>
      </div>
      <div class="login">
         <?php
         if ($_SESSION['logged_in'] == true) {
            print('<h1>You can only see this if you are logged in!</h1>');
            header("location: main.php");
         }
         ?>
         <form action="./index.php" method="post">
            <h4><?php echo $msg; ?></h4>
            <input type="text" name="username" placeholder="username = Sigita" required autofocus></br>
            <input type="password" name="password" placeholder="password = Paulikaite" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
         </form>

      </div>
   </div>
</body>
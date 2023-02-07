<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
  </head>
  <body>
    <?php

//  Echo the form information from index.php based on their input name
    echo 'First name: ' . $_POST['firstname'].'<br />';
    echo 'Last name: ' . $_POST['lastname'].'<br />';
    echo 'Email: ' . $_POST['email'].'<br />';
    echo 'Comments: ' . $_POST['comment'].'<br />';

    ?>
  </body>
</html>


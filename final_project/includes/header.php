<!--
Chris McKenna
CIS 166AE
Final Project
-->

<!-- The example includes an opening php tag but doing this breaks my IDE (PHPStorm), so I didn't use it here -->
<header>
  <!-- Display using variable set in the index file and passed to the include file ???? -->
  <div id="logo">
    <h1 class="english">ScottBook</h1>
    <!-- スコット (sukotto)  ブック (bukku): "ScottBook" in Japanese katakana. -->
    <h1 class="japanese">スコット・ブック</h1>
    <h2>a place for Scotts</h2>
  </div>
  <!-- Icon from google https://fonts.google.com/icons?selected=Material%20Icons%20Outlined%3Apeople_outline%3A -->
  <!-- https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/ -->
  <form method="post">
    <img src="../material_people.png" alt="Google Material icon of two people">
    <?php
      // Use array_key_exists on $_POST to check if Login or Logout buttons have been clicked
      // Clicking login button will redirect to login.php
      if(array_key_exists('login', $_POST)) {
        header("Location:login.php");
      }
      // Clicking log out will destroy the current session and refresh the current page.
      elseif (array_key_exists('logout', $_POST)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        session_destroy();
      }

      // If user is logged in, displays log out button, otherwise displays log in.
      if(isset($_SESSION['valid_user'])) {
        echo "<button type='submit' name='logout'>Log Out</button>";
      }
      else {
        echo "<button type='submit' name='login'>Log in</button>";
      }
    ?>
  </form>
</header>
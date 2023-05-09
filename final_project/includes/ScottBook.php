<?php

// Includes database handler
include 'dbh.php';

class ScottBook
{
  private array $menuArray;
  protected mysqli $mysqli;

  function __construct(mysqli $conn)
  {
    $this->mysqli = $conn;
  }

  function getMenu(): void
  {
    // TODO: Figure out link order
    $sql = "SELECT link_name, link_url, link_order, link_status from menu ORDER BY link_order;";
    $result = $this->mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
      $link_name = $row["link_name"];
      $link_url = $row["link_url"];
      $link_order = $row["link_order"];
      $link_status = $row["link_status"];
      // Boolean is stored in DB as TINYINT: 0 is false and 1 is true.
      // If $link_status is 0, then echos <li> with CSS `display` set to `none`, otherwise outputs normally
      if ($link_status == "0") {
        echo "<li style='display: none'><a href='$link_url'>$link_name</a></li>";
      } else {
        echo "<li><a href='$link_url'>$link_name</a></li>";
      }
    }
  }

  function createAccount(): void
  {
    if (isset($_POST['submit'])) {
      $username = $this->mysqli->real_escape_string($_POST['username'] ?? '');
      $password = $this->mysqli->real_escape_string($_POST['password'] ?? '');
      $first_name = $this->mysqli->real_escape_string($_POST['first_name'] ?? '');
      $last_name = $this->mysqli->real_escape_string($_POST['last_name'] ?? '');
      $full_name = $first_name . " " . $last_name;
      $phone = $this->mysqli->real_escape_string($_POST['phone'] ?? '');
      $email = $this->mysqli->real_escape_string($_POST['email'] ?? '');
      $theme_value = $this->mysqli->real_escape_string($_POST['theme'] ?? '');
      if ($theme_value == "default") {
        $theme = "default";
      } elseif ($theme_value == "dark") {
        $theme = "dark";
      } elseif ($theme_value == "vaporwave") {
        $theme = "vaporwave";
      }
      echo "$username<br>";
      echo "$password<br>";
      echo "$first_name<br>";
      echo "$last_name<br>";
      echo "$full_name<br>";
      echo "$phone<br>";
      echo "$email<br>";
      echo "$theme<br>";

      $user_query = "SELECT * from users where username = '$username'";
      $user_result = $this->mysqli->query($user_query);

      if (mysqli_num_rows($user_result) > 0) {
        echo "User already exists. Enter a new username.";
      } else {
        $sql_insert = "INSERT INTO users (username, password, first_name, last_name, full_name, email, phone, theme)
          VALUES ('$username', MD5('$password'), '$first_name', '$last_name', '$full_name', '$email', '$phone', '$theme');";
        $this->mysqli->query($sql_insert);
        echo "User added.";
      }

    }
  }

  function authenticate(string $username, string $password): void
  {
    $login_query = "SELECT id FROM users where username='$username' and password=MD5('$password')";
    $login_result = $this->mysqli->query($login_query);
    if ($login_result->num_rows == 1) {
      header("Refresh:2 url=../index.php");
      $_SESSION['valid_user'] = $username;
      echo "<p>Logged in!</p>";
      echo $_SESSION['valid_user'] . "<br>";
    } else {
      echo "<p>Login failed. Please try again.</p>";
    }
  }

  function getValidUserName(): string{
    $valid_user = $_SESSION['valid_user'];
    $user_query = "SELECT * FROM users where username='$valid_user';";
    $user_result = $this->mysqli->query($user_query);
    if ($user_result->num_rows == 1) {
      while ($row = $user_result->fetch_assoc()) {
        $f_name = ($row['first_name'] ?? '');
      }
    }
    return $f_name;
  }

  function getValidUserTheme() : string {
    // Sets theme as default until user theme is checked

    if(isset($_SESSION['valid_user'])) {
      $valid_user = $_SESSION['valid_user'];
      $user_query = "SELECT * FROM users where username='$valid_user';";
      $user_result = $this->mysqli->query($user_query);
      if ($user_result->num_rows == 1) {
        while ($row = $user_result->fetch_assoc()) {
          $theme = ($row['theme'] ?? '');
        }
      }
    }
    else {
      $theme = "default";
    }
    return $theme;
  }

  function displayAdminPanel():void {
    $admin_query = "SELECT * FROM users;";
    $admin_result = $this->mysqli->query($admin_query);
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Password</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Full Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Theme</th>";
    echo "<th>Edit User</th>";
    echo "</tr>";

    if ($admin_result->num_rows > 0) {
      while ($row = $admin_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['theme'] . "</td>";
        echo "<td><a href='../edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
        echo "</tr>";
      }
      echo "</table>";
    }
    else {
      echo "No users found.";
    }
  }

  function editUser():void {
    $edit_query = "SELECT * FROM users WHERE id = " . $_GET['id'] . ";";
    $edit_result = $this->mysqli->query($edit_query);
    $row = $edit_result->fetch_assoc();

    if($edit_result->num_rows > 0) {
      $edit_form = "<form action='../update.php' method='post'>";
      $edit_form .= "<label>Username: </label></br>
        <input type='text' id='username' name='username' placeholder='". $row['username'] . "' readonly></br>";
      $edit_form .= "<label>Password: </label></br>
        <input type='text' id='password' name='password' placeholder='". $row['password'] . "'></br>";
      $edit_form .= "<label>First Name: </label></br>
        <input type='text' id='first_name' name='first_name' placeholder='". $row['first_name'] . "'></br>";
      $edit_form .= "<label>Last Name: </label></br>
        <input type='text' id='last_name' name='last_name' placeholder='". $row['last_name'] . "'></br>";
      $edit_form .= "<label>Email: </label></br>
        <input type='email' id='email' name='email' placeholder='". $row['email'] . "'></br>";
      $edit_form .= "<label>Phone: </label></br>
        <input type='tel' id='phone' name='phone' placeholder='". $row['phone'] . "' pattern='[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}'></br>";
      $edit_form .= "<label>Theme (default, dark, vaporwave): </label></br>
        <input type='text' id='theme' name='theme' placeholder='". $row['theme'] . "'></br>";


      $edit_form .= "<input type='hidden' id='id' name='id' value='". $_GET['id'] ."'></br>";
      $edit_form .= "<input type='submit' id='submit' name='submit' value='Edit User'>";
      $edit_form .= "</form>";

      echo $edit_form;
    }
  }

  function updateUser():void {
    if(isset($_POST['submit'])) {
      $id = $_POST['id'];
//      $username = $this->mysqli->real_escape_string($_POST['username']);
      $password = $this->mysqli->real_escape_string($_POST['password'] ?? '');
      $first_name = $this->mysqli->real_escape_string($_POST['first_name'] ?? '');
      $last_name = $this->mysqli->real_escape_string($_POST['last_name'] ?? '');
      $full_name = $first_name . " " . $last_name;
      $email = $this->mysqli->real_escape_string($_POST['email'] ?? '');
      $phone = $this->mysqli->real_escape_string($_POST['phone'] ?? '');
      $theme = $this->mysqli->real_escape_string($_POST['theme'] ?? '');

      $update_query = "UPDATE users ";
      $update_query .= "SET password=MD5('$password'), first_name='$first_name', last_name='$last_name', full_name='$full_name', email='$email', phone='$phone', theme='$theme'";
      $update_query .= " WHERE id = '$id';";
      if($this->mysqli->query($update_query)) {
        header("Refresh:3, url=admin.php");
        echo "Account updated successfully.";
      }
      else {
        echo "Error: could not execute $update_query". mysqli_error($this->mysqli);
      }
    }

  }


}
<?php
  include_once 'includes/ScottBook.php';
  global $conn;
  $update_account = new ScottBook($conn);

  $update_account->updateUser();
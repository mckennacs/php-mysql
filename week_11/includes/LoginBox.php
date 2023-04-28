<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php
	include_once ('dbh.inc.php');
	// Class that creates login box with username/password
	class LoginBox
	{
		// Login fields and username/password
		private string $username_field;
		private string $password_field;
		private string $username;
		private string $password;

		// New account form fields
		private string $new_username;
		private string $new_password;
		private string $new_first_name;
		private string $new_last_name;
		private string $new_email;
		private string $new_phone;

		// getAccountForm variables
		private array $account_fields;

		private array $update_account_fields;

		// Submit button
		protected string $submit;

    public object $db_connection;

  /**
	  * __construct function to establish parameter values
	  * @var string $username
	  * 	set to 'student'
	  * @var string $password
	  * 	set to 'CIS166'
	  * @var string $username_field
	  * 	HTML form element for username
	  * @var string $password_field
	  * 	HTML form element for password
	  * @var string $submit
	  * 	Text for submit button, can be changed with SetLabel(). Defaults to 'Submit'
	  */
		function __construct(string $submit ='Submit')
		{
      $this->db_connection = $conn;
			$this->username = 'student';
			$this->password = 'CIS166';
			// Login username and password fields
			$this->username_field = '<label for="username" id="username" class="form-field">Username:</label><br />
				<input type="text" id="username" name="username" class="form-field"><br />';
			$this->password_field = '<label for="password" id="password" class="form-field">Password:</label><br />
				<input type="password" id="password" name="password" class="form-field"><br />';
			// New account form fields
			$this->new_username = '<label for="new-user" id="new-user" class="form-field">Username:</label><br />
				<input type="text" id="new-user" name="new-user" class="form-field"><br />';
			$this->new_password = '<label for="new-password" id="new-password" class="form-field">Password:</label><br />
				<input type="password" id="new-password" name="new-password" class="form-field"><br />';
			$this->new_first_name = '<label for="first-name" id="first-name" class="form-field">First Name:</label><br />
				<input type="text" id="first-name" name="first-name" class="form-field"><br />';
			$this->new_last_name = '<label for="last-name" id="last-name" class="form-field">Last Name:</label><br />
				<input type="text" id="last-name" name="last-name" class="form-field"><br />';
			$this->new_email = '<label for="email" id="email" class="form-field">Email Address:</label><br />
				<input type="text" id="email" name="email" class="form-field"><br />';
			$this->new_phone = '<label for="phone" id="phone" class="form-field">Phone Number:</label><br />
				<input type="text" id="phone" name="phone" class="form-field"><br />';
			$this->submit = $submit;
		}

	/**
	  * Function to return username and password fields and submit button.
	  * @var string $login_form
	  * 	String containing all HTML for login form, using concatenation assignment operator to combine elements
	  * 	https://www.php.net/manual/en/language.operators.string.php
	  * @var string $username_field
	  * 	HTML form element for username
	  * @var string $password_field
	  * 	HTML form element for password
	  * @return string
	  *  Returns the HTML form element as string.
	  */
		function DisplayLogin():string
		{
      //Instead of returning the whole string at once, I decided to create a new $login_form string which starts with opening form tags and concatenates each following element, for readability
			$login_form = '<form action="" method="POST">';
			$login_form .= $this->username_field . $this->password_field;
			$login_form .= '<br /><div id="buttons-div"><input type="submit" id="submit" name="submit" value="'. $this->submit . '">';
			$login_form .= '<a href="signup-form.php" id="sign-up">Sign Up</a></div></form>';
			return $login_form;
		}

	/**
		* Function to return new account registration form.
	 	*
		* @var string $new_username
		* 	HTML form element for new username field
		* @var string $new_password
		* 	HTML form element for new password field
		* @var string $new_first_name
		* 	HTML form element for field to accept a new user's first name
		* @var string $new_last_name
		* 	HTML form element for last name field
		* @var string $new_email
		* 	HTML form element for user's email address
		* @var string $new_phone
		* 	HTML form element for user's phone number
		* @return string
		*  Returns the HTML form element as string.
		*/
		function getAccountForm():string
		{
			return '<form action="../signup.inc.php" method="POST">' . $this->new_username . $this->new_password . $this->new_first_name
				. $this->new_last_name . $this->new_email . $this->new_phone . '<br />' . '<input type="submit" id="submit" name="submit" value="'. $this->submit . '"></form>';
		}

	 /**
		* Function to authenticate username/password
		*
		* @param string $username
		* 	Username entered into input field
		* @param string $password
		* 	Password entered into input field
		* @return void
		*	Echos HTML redirecting to success page (success.html)
		*
		*  Uses try/catch to check username and password, displays exception messages if invalid
		*/
		function CheckLogin(string $username, string $password):void
		{
			try
			{
				if ( $username != $this->username )
				{
					throw new Exception("Username invalid");
				}
				else if ( $password != $this->password )
				{
					throw new Exception("Password invalid");
				}
				else
				{
					echo $this->SuccessRedirect();
				}
			}
			catch (Exception $e)
			{
				echo '<p class="error">' . $e->getMessage() . '</p>';
			}
		}

	 /**
	  * Function to create new account and insert info into MySQL database
	  *
		* @param object $conn
		*		Object created using mysqli_connect function and MySQL database login info, defined in dbh.inc.php
	  * @param array $new_account_info
	  *		An array containing elements retrieved from $_POST, taken from
	  * @var array $errors
	  * 	Array containing error messages for field validation. If a field is invalid a string containing the error message is added to the array
	  * @var string $valid_phone_pattern
	  * 	String used for pattern matching in regular expressions. This checks if the number and type of characters entered would make a valid phone number
		* @return void
		* 	Does not return a variable. If login fields are good, it sends MySQL query. If not, outputs items of $errors array
	  */
		function createAccount(array $new_account_info):void
		{
			$errors =[];
			$valid_phone_pattern = '^[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}';

			// If no fields are filled in, adds error message to $errors
			if(!$_POST['new-user'] || !$_POST['new-password'] || !$_POST['first-name'] || !$_POST['last-name'] || !$_POST['email'] || !$_POST['phone'])
			{
				$errors[] = '<p>Please enter all required information</p>';
			}
			// Checks to see if email is valid
			if (!filter_var($new_account_info[4], FILTER_VALIDATE_EMAIL))
			{
				$errors[] = '<p>Invalid email</p>';
			}
			// Uses preg_match to check if phone number is valid. If not, adds error message to $errors
			if (!preg_match("/$valid_phone_pattern/", $new_account_info[5]))
			{
				$errors[] = '<p>Invalid phone number</p>';
			}

			// If no objects in the $errors array, variables from $new_account_info are assigned to items in the class $account_fields array
			if (!$errors)
			{
				$this->account_fields[0] = trim($new_account_info[0]); // Username
				$this->account_fields[1] = trim($new_account_info[1]); // Password
				$this->account_fields[2] = trim($new_account_info[2]); // First name
				$this->account_fields[3] = trim($new_account_info[3]); // Last name
				$this->account_fields[4] = trim($new_account_info[4]); // Email
				$this->account_fields[5] = trim($new_account_info[5]); // Phone number

				/*
 				* Uses stripslashes() function to remove PHP escape characters and the mysqli function real_escape_string() to add escape characters for MySQL
 				* This may be redundant but I got MySQL errors just using addslashes() and stripslashes()
 				*/
				$u_name = stripslashes($this->conn ->real_escape_string($new_account_info[0]));
				$pwd = stripslashes($this->conn ->real_escape_string($new_account_info[1]));
				$first = stripslashes($this->conn ->real_escape_string($new_account_info[2]));
				$last = stripslashes($this->conn ->real_escape_string($new_account_info[3]));
				$email = stripslashes($this->conn ->real_escape_string($new_account_info[4]));
				$phone = stripslashes($this->conn ->real_escape_string($new_account_info[5]));

				// SELECT statement to check if $u_name already exits in database
				// $sql = "SELECT * from users WHERE 'name' = " . $u_name . ";";
				$sql = "SELECT `name` FROM `users` WHERE name ='" . $u_name . "';";
				// Queries $conn using above $sql string
				$result = mysqli_query($conn, $sql);
				// Uses mysqli_num_rows to get the number of rows returned with query
				$name_check = mysqli_num_rows($result);

				// If there are
				if ($name_check > 0) {
					header("Refresh:5, url=week_11/admin.php");
					echo "<p>User already exists. Enter new username. You will be redirected to signup page in 5 seconds.</p>" . mysqli_error($conn);
					// echo "<p><a href='../signup-form.php'>Go back</a></p>";
				}
				else {
					// Sql insert statement using above variables
					$sql = "INSERT INTO users (name, password, first_name, last_name, email, phone)
						VALUES ('$u_name', '$pwd', '$first', '$last', '$email', '$phone');";
					mysqli_query($conn, $sql);
					header("Location: new-account-success.php");
				}

			}
			else
			{
				// If there are items in the $errors array, prints them each on its own line
				foreach($errors as $error)
				{
					echo "<p>$error</p>";
				}
				echo '<a href="../signup-form.php">Go back</a>'; // Link to return to signup form
			}
		}
		/**
		 * Function to update existing account information by querying MySQL database
		 *
		 * @param object $conn
		 *		Object created using mysqli_connect function and MySQL database login info, defined in dbh.inc.php
		 * @param array $update_account_info
		 *		An array containing elements retrieved from $_POST, taken from
		 * @param int $id
		 * 	User ID number, retrieved from URL query string
		 * @var array $update_errors
		 * 	Array containing error messages for field validation. If a field is invalid a string containing the error message is added to the array
		 * @var string $valid_phone_pattern
		 * 	String used for pattern matching in regular expressions. This checks if the number and type of characters entered would make a valid phone number
		 * @return void
		 * 	Does not return a variable. If login fields are good, it sends MySQL query. If not, outputs items of $errors array
		 */

		function updateAccount(array $update_account_info, int $id, object $conn):void
		{
			$update_errors =[];
			$valid_phone_pattern = '^[1-9]{1}[0-9]{2}[-|.]{1}[1-9]{1}[0-9]{2}[-|.]{1}[0-9]{4}';

			// If no fields are filled in, adds error message to $update_errors
			if(!$_POST['username'] || !$_POST['password'] || !$_POST['first-name'] || !$_POST['last-name'] || !$_POST['email'] || !$_POST['phone'])
			{
				$update_errors[] = '<p>Please enter all required information</p>';
			}
			// Checks to see if email is valid
			if (!filter_var($update_account_info[4], FILTER_VALIDATE_EMAIL))
			{
				$update_errors[] = '<p>Invalid email</p>';
			}
			// // Uses preg_match to check if phone number is valid. If not, adds error message to $errors
			if (!preg_match("/$valid_phone_pattern/", $update_account_info[5]))
			{
				$update_errors[] = '<p>Invalid phone number</p>';
			}

			// If no objects in the $update_errors array, variables from $update_account_info are assigned to items in the class $update_account_fields array
			if (!$update_errors)
			{
				$this->update_account_fields[0] = trim($update_account_info[0]); // Username
				$this->update_account_fields[1] = trim($update_account_info[1]); // Password
				$this->update_account_fields[2] = trim($update_account_info[2]); // First name
				$this->update_account_fields[3] = trim($update_account_info[3]); // Last name
				$this->update_account_fields[4] = trim($update_account_info[4]); // Email
				$this->update_account_fields[5] = trim($update_account_info[5]); // Phone number

				$update_u_name = stripslashes($conn ->real_escape_string($update_account_info[0]));
				$update_pwd = stripslashes($conn ->real_escape_string($update_account_info[1]));
				$update_first = stripslashes($conn ->real_escape_string($update_account_info[2]));
				$update_last = stripslashes($conn ->real_escape_string($update_account_info[3]));
				$update_email = stripslashes($conn ->real_escape_string($update_account_info[4]));
				$update_phone = stripslashes($conn ->real_escape_string($update_account_info[5]));

				$sql = "UPDATE `users`";
				$sql .= "SET `name` = '$update_u_name', `password` = '$update_pwd', `first_name` = '$update_first', `last_name` = '$update_last', `email` = '$update_email', `phone` = '$update_phone'";
				$sql .= "WHERE id = '$id';";
				mysqli_query($conn, $sql);
				header("Refresh:5, url=admin.php");
			}
			else
			{
				// If there are items in the $update_errors array, prints them each on its own line
				foreach($update_errors as $error)
				{
					echo "<p>$error</p>";
				}
				// Link to return to signup form
				echo '<a href="week_11/signup-form.php">Go back</a>';
			}
		}
	 /**
	  * Function to direct user to success.html if login successful
	  *
	  * @return string
	  * 	returns meta tag to redirect user to url success.html
	  */
		function SuccessRedirect():string{
			return '<meta http-equiv="refresh" content="0; url=success.html">';
		}

	 /**
	  * Function to change the label of submit buttons (protected variable)
	  *
	  * @param string $submit
	  * 	sets $submit to string as passed through __construct
	  * @return void
	  *
	  * Try/except tests to see if argument passed to SetLabel() is a string, otherwise prints error message
	  */
		function SetLabel(string $submit):void
		{
			try
			{
				if(!is_string($submit)) {
					throw new Exception('Submit message can only be a string, $submit was: ' . $submit);
				}
				$this->submit = $submit;
			}
			catch(Exception $argument_exception)
			{
				echo '<p class="error">' .  $argument_exception->getMessage() . '</p>';
			}
		}
	}



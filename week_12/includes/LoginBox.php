<!--
Chris McKenna
CIS 166AE
Module 12 Assignment
-->

<?php
	// Class that creates login box with username/password
	include_once 'dbh.inc.php';
	class LoginBox
	{
		// Login fields and username/password
		private string $username_field;
		private string $password_field;


		// New account form fields
		private string $new_username;
		private string $new_password;
		private string $new_first_name;
		private string $new_last_name;
		private string $new_email;
		private string $new_phone;

    // mysqli object which is assigned to $conn variable from dbh.inc.php
    protected mysqli $db_conn;

		// getAccountForm variables
		private array $account_fields;

		// Submit button
		protected string $submit;


  /**
	  * __construct function to establish parameter values
    * @param mysqli $conn
    *   mysqli connection established in dbh.inc.php
	  * @var string $username_field
	  * 	HTML form element for username
	  * @var string $password_field
	  * 	HTML form element for password
	  * @var string $submit
	  * 	Text for submit button, can be changed with setLabel(). Defaults to 'Submit'
	  */
    // Based on feedback from Module 12, I moved $conn from function declarations to class constructor
    // Without this, I kept getting errors stating the $conn variable was undefined, even after including dbh.inc.php
    // If this is still incorrect, I don't know how else to use MySQL queries in functions (as in createAccount())
    // https://stackoverflow.com/questions/37480496/how-to-use-mysqli-in-a-class
		function __construct(mysqli $conn)
		{
      $this->db_conn = $conn;
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
      $this->submit = 'Submit';
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
	  * @return void
	  *  Echos $login_form string. Changed from previously returning a string, so displayLogin() can be called directly without echoing the results.
	  */
		function displayLogin():void
		{
      //Instead of returning the whole string at once, I decided to create a new $login_form string which starts with opening form tags and concatenates each following element, for readability
			$login_form = '<form action="" method="POST">';
			$login_form .= $this->username_field . $this->password_field;
			$login_form .= '<br /><div id="buttons-div"><input type="submit" id="submit" name="submit" value="'. $this->submit . '">';
			$login_form .= '<a href="signup-form.php" id="sign-up">Sign Up</a></div></form>';
			echo $login_form;
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
			return '<form action="../signup.php" method="POST">' . $this->new_username . $this->new_password . $this->new_first_name
				. $this->new_last_name . $this->new_email . $this->new_phone . '<br />' . '<input type="submit" id="submit" name="submit" value="'. $this->submit . '"></form>';
		}

    /**
     * Function to create new account and insert info into MySQL database
     *
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
        // Username
        $userName = trim($new_account_info[0]);
        // Password
        $password = trim($new_account_info[1]);
        // First name
        $firstName = trim($new_account_info[2]);
        // Last name
        $lastName = trim($new_account_info[3]);
        // Email
        $userEmail = trim($new_account_info[4]);
        // Phone number
        $userPhone = trim($new_account_info[5]);

        // Uses stripslashes() function to remove PHP escape characters and the mysqli function real_escape_string() to add escape characters for MySQL
        $u_name = stripslashes($this->db_conn ->real_escape_string($userName));
        $pwd = stripslashes($this->db_conn ->real_escape_string($password));
        $first = stripslashes($this->db_conn ->real_escape_string($firstName));
        $last = stripslashes($this->db_conn ->real_escape_string($lastName));
        $email = stripslashes($this->db_conn ->real_escape_string($userEmail));
        $phone = stripslashes($this->db_conn ->real_escape_string($userPhone));

        // SELECT statement to check if $u_name already exits in database
        $sql = "SELECT `name` FROM `users` WHERE name ='" . $u_name . "';";
        // Queries $this->db_conn using above $sql string
        $result = mysqli_query($this->db_conn, $sql);

        // Uses mysqli_num_rows to get the number of rows returned with query. If there is an existing row, that means the user already exists
        if (mysqli_num_rows($result) > 0) {
          header("Refresh:3; url=week_12/signup-form.php");
          echo "<p>User already exists. Enter new username. You will be redirected to signup page in 3 seconds.</p>";
        }
        else {
          // Uses password_hash() to create a new hashed password using default algorithm
          // https://www.php.net/manual/en/function.password-hash.php
          // I'm not sure if I need to hash the password when creating an account or just for login.
          // Storing the password as a hash instead of plain text in the database seems more secure, but I don't know if that is what the assignment is asking for
          $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
          $sql = "INSERT INTO users (name, password, first_name, last_name, email, phone)
      VALUES ('$u_name', '$pwd_hash', '$first', '$last', '$email', '$phone');";
          mysqli_query($this->db_conn, $sql);
          header("Location: week_12/new-account-success.html");
        }

      }
      else
      {
        // If there are items in the $errors array, prints them each on its own line
        foreach($errors as $error)
        {
          echo "<p>$error</p>";
        }
        // Link to return to signup form
        echo '<a href="../signup-form.php">Go back</a>';
      }
    }

	 /**
		* Function to authenticate username/password
		* Uses try/catch to check username and password, displays exception messages if invalid
    *
		* @param string $username
    *   User's name entered into input field
		* @param string $password
		* 	Password entered into input field
    * @param string $hashed_password
    *   User password, stored in database created with password_hash() in createAccount() function
		* @return boolean
		*   If password entered matches stored password, returns true. Else returns false
		*/

    //TODO THIS
		function authenticate(string $username, string $password):void
		{

    }

	 /**
	  * Function to change the label of submit buttons (protected variable)
	  *
	  * @param string $submit
	  * 	sets $submit to string as passed through __construct
	  * @return void
	  *
	  * Try/except tests to see if argument passed to setLabel() is a string, otherwise prints error message
	  */
		function setLabel(string $submit):void
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



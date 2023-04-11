<?php
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

		// Submit button
		protected string $submit;

	 /*
	  * __construct function to establish parameter values
	  * @param string username
	  * 	set to 'student'
	  * @param string password
	  * 	set to 'CIS166'
	  * @param string $username_field
	  * 	HTML form element for username
	  * @param string $password_field
	  * 	HTML form element for password
	  * @param string $submit
	  * 	Text for submit button, can be changed with SetLabel(). Defaults to 'Submit'
	  */
		function __construct($submit ='Submit')
		{
			$this->username = 'student';
			$this->password = 'CIS166';
			// Login username and password fields
			$this->username_field = '<label for="username" id="username" name="username">Username:</label><br />
				<input type="text" id="username" name="username"><br />';
			$this->password_field = '<label for="password" id="password" name="password">Password:</label><br />
				<input type="password" id="password" name="password"><br />';
			// New account form fields
			$this->new_username = '<label for="new-user" id="new-user" name="new-user">Username:</label><br />
				<input type="text" id="new-user" name="new-user"><br />';
			$this->new_password = '<label for="new-password" id="new-password" name="new-password">Password:</label><br />
				<input type="password" id="new-password" name="new-password"><br />';
			$this->new_first_name = '<label for="first-name" id="first-name" name="first-name">Password:</label><br />
				<input type="text" id="first-name" name="first-name"><br />';
			$this->submit = $submit;
		}

		/*
		 * Function to return username and password fields and submit button.
		 *
		 * @param string $username_field
		 * 	HTML form element for username
		 * @param string $password_field
		 * 	HTML form element for password
		 * @return string
		 *  Returns the HTML form element as string.
		 */
		function DisplayLogin():string
		{
			return '<form action="" method="post">' . $this->username_field . $this->password_field.
				'<br /><div id="buttons-div"><input type="submit" id="submit" name="submit" value="'. $this->submit .'">
				<a href="signup.php" id="sign-up">Sign Up</a></div></form>';
		}

		function getAccountForm():string
		{
			return '';
		}

	  /*
		 * Function to authenticate username/password
	   *
	   *	@param string $username
	   * 		Username entered into input field
	   * 	@param string $password
	   * 		Password entered into input field
		 *	@return void
		 *		Echos HTML redirecting to success page (success.html)
	   *
	   * Uses try/catch to check username and password, displays exception messages if invalid
		 */
		function CheckLogin($username, $password):void
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

	 /*
	  * Function to direct user to success.html if login successful
    *
	  * @return string
	  * 	returns meta tag to redirect user to url success.html
	  */
		function SuccessRedirect():string{
			return '<meta http-equiv="refresh" content="0; url=success.html">';
		}

	 /*
		* Function to change the label of submit buttons (protected variable)
	  *
		* @param string $submit
	  * 	sets $submit to string as passed through __construct
		* @return void
	  *
	  * Try/except tests to see if argument passed to SetLabel() is a string, otherwise prints error message
		*/
		function SetLabel($submit):void
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
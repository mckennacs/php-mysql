<?php

  /**
	 * ADD COMMENT HERE.  What is the class for?
	 */
	class LoginBox {

		private string $username;
		private string $password;
		
		protected string $submit;  // Add blank between types, much eaiser to read.

    /**
	   * ADD COMMENT HERE
	   */
		function __construct(string $submit ='Submit') {
			$this->submit = $submit;
			$this->username = 'student';
			$this->password = 'CIS166';
		}

	  /**
	   * Function to return username and password fields and submit button.
		 *
		 * @return string
		 *  Returns the HTML form element as string.    
	   */
		function DisplayLogin():string {
			// Username
			$username = '<label for="username" id="username" name="username">Username:</label><br />
				<input type="text" id="username" name="username"><br />';
			// Password
			$password = '<label for="password" id="password" name="password">Password:</label><br />
				<input type="password" id="password" name="password"><br />';
			return '<form action="" method="post">' . $username . $password . '<label for="submit" id="submit" name="submit">'. $this->submit .
				'<br /><input type="submit" id="submit" name="submit" value="'. $this->submit .'"></form>';
		}

		// Function to authenticate username/password
		function CheckLogin($username, $password):void
		{
			// SPACE BETWEEN if and opening (, also between colsing ) and opening {
			if($username != $this->username OR $password != $this->password){
				echo $this->FailRedirect();
			} else { // ELSE (and else if) ALWAYS goes on new line. 
				echo $this->SuccessRedirect();
			}
		}

		// Function to change the label of submit buttons (protected variable)
		function SetLabel(string $submit)
		{
			$this->submit = $submit;
		}

		function SuccessRedirect():string{
			// If username/password correct, redirects to success.html.
			return '<meta http-equiv="refresh" content="0; url=success.html">';
		}
		function FailRedirect():string{
			// If incorrect, directs to failed.html
			return '<meta http-equiv="refresh" content="0; url=failed.html">';
		}

	}

<html>
<head>
	<title>Connect To Grow</title>

	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="theme-color" content="#443627">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="manifest" href="manifest.json">

    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link rel="stylesheet" type="text/css" href="../css/animate.css">
</head>
<body>
	<?php
		if(isset($_POST["email"]))
		{
			//email link to reset the password..
			echo "<div class='col-sm-12 center'>
			<h1 class='forgot-pass'>
				Email Sent
			</h1>
			<img src='../images/mail.png' class='forgot-icon'>
			<h5 class='forgot-pass-sub'>To HELP you out, we have send an email to your given email address.<br> Click the Link given there to reset Your password.</h5>
			<br><br><a href='#' class='link'>Return to Home.</a>
			</div>";
			unset($_POST['email']);
		}

		else
		{
			echo "<div class='col-sm-12 center'>
		<h1 class='forgot-pass'>
			Forgot Password?
		</h1>
		<img src='../images/lock.png' class='forgot-icon'>
		<h5 class='forgot-pass-sub'>It's Okay. Lets just fill in the details below.</h5>

		<form action= ". $_SERVER["PHP_SELF"] ." method='POST'> 
			<input type='text' name='email' placeholder='Email Address' class='txt-sml-3'><br><br>
			<button class='btn-sml-3'>Send Verfication Email</button>
			<br><br>
			<font style='color:#969696'>OR</font>
			<br><a href='#' class='link'>Return to Home.</a>
		</form>
	</div>";
		}
	?>


</body>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Passion+One|Prompt" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/animate.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

</html>
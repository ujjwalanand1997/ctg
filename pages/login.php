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
    <div class="row login">
        <div class="col-sm-5 box-container">
                <h1 class="h1">Login</h1>

                    <form action="login-attempt.php" method="POST" name="login" onsubmit="return validateLoginForm()">
                        <input type="text" name="username" class="txt-sml-2" placeholder="Username">
                        <br>
                        <input type="password" name="password" class="txt-sml-2" placeholder="Password">
                        <br>
                        <button type="submit" class="btn-sml-2">
                            Login
                        </button>
                    </form>

                    <div class="hidden" id="message">Success Message</div>

                    <a href="forgot-pass.php">Forgot My Password</a> <font>|</font> Not registered? <a href="getting-started.php">SignUp</a>
        </div>
        <div class="col-sm-7 box-container-2">
            <img src="../images/logo.png" class="logo-lg">
            <h1 class="h1">Connect To Grow</h1>
            <p>
                Our aim is to develop an environment to nurture the growth of the upcoming startups.Through connect to grow, we connect  startups on a single network.
                We focus on the unique assets of providing  chatroom  and  email services for client to client network.
                <br>
                We connect dreams to make dreams come true ! 
                <br>
                Happy working !
            </p>
        </div>
    </div>
</body>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Passion+One|Prompt" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</html>
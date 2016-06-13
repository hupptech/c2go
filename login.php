<?php
ob_start();
if(isset($_REQUEST['submit'])) {
	if(trim($_REQUEST['username'])!='' && trim($_REQUEST['password'])!=''){
		// initiate call to login api
		$url = 'https://demo.c2gocard.com/j_spring_security_check?j_username='.$_REQUEST['username'].'&j_password='.$_REQUEST['password'].'&mobile=true';

		$ch = curl_init();    
		curl_setopt($ch, CURLOPT_URL, $url); // set url
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$session_result = curl_exec($ch);
		//close connection
		curl_close($ch);

		$login_result = json_decode($session_result);
		$login_status =  $login_result->data->token;

		$acc_id = $login_result->data->businessAccounts[0]->accountID;
		//print_r($acc_id);
		if(trim($login_result->data->token) != '') {
			$redirect_url = "pay.php?token=".$login_status."&accountID=".$acc_id;
			header("Location:".$redirect_url);
		} else {
					
		}
		
	}
}
?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://getbootstrap.com/2.3.2/examples/signin.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="http://getbootstrap.com/2.3.2/assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
	<?php
	if(isset($pay_result->data->transferResult->message)) {
		echo '<span class="label label-primary">'.$login_result->errorMessage.'</span>';
	}
	?>
        <input type="text" class="input-block-level" placeholder="Username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" name="submit" id="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  

</body></html>

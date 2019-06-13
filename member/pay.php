<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: member.php");
    exit;
}*/

if(isset($_SESSION['authenticated']) && $_SESSION["authenticated"] === true){
} else{
    header('Location: login.php');
    exit;
}

 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $error = "";
$username_err = $password_err = "";

// Define Webmaster Variable
$admin_username = "s106062323";
$admin_password = "s106062323";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>
 	<link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
 	<link href="video.css" rel="stylesheet">
 	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/./front-login-pc.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019060701" type="text/css" media="only screen and (min-width:1350px)" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/playlist-logged.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/pc/sceditor/sceditor.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/grid-styles/user-profile-grid.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/feeds.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/profile.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/achievements.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/tag-friends.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/user-share-item.css?cache=2019053101" type="text/css" />	
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019053101" type="text/css" media="only screen and (min-width:1350px)" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019053101" type="text/css" />
	<link charset="UTF-8" href="//cdne.probiller.com/assets/global/revamp/css/layout.css?v=1.1.18" media="all" rel="stylesheet" type="text/css" />
	<link charset="UTF-8" href="//cdne.probiller.com/assets/site/branding/363.css?v=bb7ec2638d93a782bf41ea3accf01a76" media="all" rel="stylesheet" type="text/css" />
	
    <style type="text/css">
        body{ font: 14px sans-serif; }
        body{
            margin:0px;
            padding:0px;
            background-size: cover;
        }
        .wrapper{ width: 350px; padding: 20px; }
        .createAccount #registerWrapper {
    		padding: 30px 0;
    		background: url(image/login_bg.jpg) center center no-repeat;
    		background-size: cover
		}
		#img_cover{
    		opacity: 0.7; 
    		filter: alpha(opacity=70); 
		}
    </style>
</head>
<body class="form-style form-style-light">
	<script language='javascript'>
function CheckCardno(sCheckCardno) {
	var iSumCheck = 0;
	if (sCheckCardno.length != 16) {
		alert("長度錯誤");
		return false;
	}

	for (var i=sCheckCardno.length; i>0; i--) {
		var iC = sCheckCardno.substring((17-i-1), (17-i));
		if (isNaN(iC)) {
			alert("第 "+i+" 碼，應為數字。");
			return false;
		}

		var iCS = iC * ((i+1)%2+1);
		iSumCheck += (iCS-iCS%10)/10+(iCS%10);
	}

	if (iSumCheck % 10 == 0) {
		alert("正確");
		document.getElementById("card_error").innerHTML = '';
		document.getElementById("ccCreditCard").style.border = "";
		window.location.href = 'update_premium.php';
	} else {
		//alert("錯誤");
		document.getElementById("card_error").innerHTML = 'The Credit Card Number is WRONG!';
		document.getElementById("ccCreditCard").style.border = "2px solid #CC0000";
	}
	return false;
}
</script>
	<div id="mainmenu">
			<a href="../index/index.php">
				<img src="image/cornhub.jpg">
			</a>
			<form method="POST" action="" id="search">
		 		<input type="text" placeholder="Search..." id="searchtext"> </input>
				<div id="sbut">
					<input type="image" id="searchbut" src="image/search.png" value="" alt="Submit feedback"> </input>
				</div>
			</form>
			<div style="width:25px"></div>
			<form method="post">
				<span class="headerBtnsWrapper">
  					<a class="orangeButton" style="background:#ffa31a" href="../play/uploadpage.php"><i></i>Upload</a>
                    <a class="orangeButton" style="background:#ffa31a" href="member.php?action=premium"><i></i>Upgrade</a>
                </span>
			</form>
			<div style="width:100px"></div>
			<form method="POST" action="" id="login">
		 		<a href="signout.php">SIGN OUT</a>
			</form>
			
	 </div>
     
	 <div id = "table">
        <table width=80%>
            <tr height="40">
            <br>
            <td width=16%>
                <button id="home" onclick="" class="button">
                    HOME
                </button>
            </td>
            <td width=16%>
                <button id="videos" onclick="" class="button">
                    VIDEOS
                </button>
            </td>
            <td width=16%>
                <select class="select-css">
                    <option value="0">CATEGORIES</option>
                    <option value="address of category_1">category_1</option>
                    <option value="address of category_2">category_2</option>
                    <option value="address of category_3">category_3</option>
                    <option value="address of category_4">category_4</option>
                </select>
            </td>
            <td width=16%>
                <button id="livecorn" onclick="" class="button">
                    LIVE CORN
                </button>
            </td>
            <td width=16%>
                <button id="premium" onclick="location.href='member.php?action=premium'" class="button">
                    PREMIUM
                </button>
            </td>
            <td width=16%>
                <button id="phptos&gifs" onclick="" class="button">
                    PHOTOS & GIFS
                </button>
            </td>
            </tr>
        </table>
        <br>
        <br>
    </div>
  
<main class="main">
    <form class="form js-gatewayForm" name='fm' method='post' onSubmit='return CheckCardno(document.fm.Cardno.value)'>
        <section class="branding-wrapper" style="background-color:#f90">
            <div class="branding-inner">
                <div style="color:#000; font-size:20px;"><b>Membership to Cornhub Premium for Lifetime for a charge of NT$ 699 ! </div>
            </div>
        </section>
        <section class="form-wrapper">
            <div class="form-inner inner-width">
                <header class="form-header">
                    <i class="probiller-logo">ProBiller</i>
                    <div class="digicert" data-language="en"></div>   
                </header>
                <div class="fieldset">
                    <div class="form-row has-number">
                        <div class="form-field has-number">
                            <div class="field-wrapper">
                                <label class="field-label has-icon">
                                    <span class="label-icon"><i class="icon-locked"></i></span> 
                                    <span class="label-text">Card Number</span>
                                    <input type="tel" name="Cardno" value="" id="ccCreditCard" class="js-reCaptchaTrigger monospace" style="border-radius:5px; " data-name="number" required="required" maxlength="16" data-rule-creditcard="true" data-rule-amexcreditcard="true" oninput="value=value.replace(/[^\d]/g,'')">
                					<span id="card_error" style="color:#CC0000; margin-top:10px; display:inline-block; font-size:16px;"></span>
                                </label>
                                <span class="creditcards"><img id="credit-card-logo" src="//cdne.probiller.com/assets/global/_shared/img/creditcards-all.png" alt=""></span>    
                            </div>
                        </div>
                    </div>
                    <div class="form-row has-cvv has-expirationDate">
                        <div class="form-field has-cvv">
                            <div class="field-wrapper">
                                <label class="field-label has-icon">
                                    <span class="label-icon"><i class="icon-credit-card-alt"></i></span> 
                                    <span class="label-text">Security Code</span>
                                    <input type="tel" name="cc[cvv]" value="" id="ccCvv" class="monospace" style="border-radius:5px;" data-name="cvv" maxlength="3" required="required" oninput="value=value.replace(/[^\d]/g,'')">
                                </label>
                            </div>
                        </div>
                        <div class="form-field has-expirationDate">
                            <div class="field-wrapper">
                                <label class="field-label has-icon">
                                    <span class="label-icon"><i class="icon-calendar"></i></span> 
                                    <span class="label-text">Expiry Date</span>
                                    <select class="monospace" name="cc[expirationMonth]" value="6" type="select" id="expirationMonth" data-rule-expirationdate="true"><option value="1">01-JAN</option><option value="2">02-FEB</option><option value="3">03-MAR</option><option value="4">04-APR</option><option value="5">05-MAY</option><option value="6" selected="selected">06-JUN</option><option value="7">07-JUL</option><option value="8">08-AUG</option><option value="9">09-SEP</option><option value="10">10-OCT</option><option value="11">11-NOV</option><option value="12">12-DEC</option></select>
                                </label>
                                <label class="field-label">
                                    <span class="label-text">&nbsp;</span>
                                    <select class="monospace" name="cc[expirationYear]" value="2022"  type="select"   id="expirationYear" data-rule-expirationdate="true"><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022" selected="selected">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option></select>
                                </label>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row has-firstname has-lastname">
                        <div class="form-field has-firstname">
                            <div class="field-wrapper">
                                <label class="field-label has-icon">
                                    <span class="label-icon"><i class="icon-user"></i></span> 
                                    <span class="label-text">First Name</span>
                                    <input type="text" name="cc[firstname]" value="" id="ccFirstName" style="border-radius:5px;" data-name="firstname" maxlength="120" required="required" data-rule-minlength="2" data-rule-nonumbers="true">
                                </label>    
                            </div>
                        </div>
                        <div class="form-field has-lastname">
                            <div class="field-wrapper">
                                <label class="field-label has-icon"><span class="label-icon"><i class="icon-user"></i></span> <span class="label-text">Last Name</span>
                                    <input type="text" name="cc[lastname]" value="" id="ccLastName" class="js-reCaptchaTrigger" style="border-radius:5px;" data-name="lastname" maxlength="120" required="required" data-rule-minlength="2" data-rule-nonumbers="true">
                                </label>    
                            </div>
                        </div>
                    </div>  
                            
                    <div class="form-submit width-adjust">
                        <div class="small-prints width-adjust-flex">
                            <p class="legal-charge">All charges will appear on your statement as <b> MBI*PROBILLER.COM-855-232-9555 </b>.</p>
                            <p class="legal-agreement">By completing this transaction you certify that you are 18 years or older and accept our <a href=" https://probiller.com/legal/privacy " target="_blank" id="privacyPolicyLink">Privacy Policy</a> and <a href=" https://probiller.com/main/TermsAndConditions " target="_blank" id="termsAndConditionsLink">Terms and Conditions</a>.</p>
                        </div>
                        <div class="width-adjust-force">
                            <div id="form-submit" class="form-submit">
                                <input type="submit" id="submitButton" class="btn btn-submit" name="ccSubmit" value="Start Membership">
                            </div>
                        </div>
                    </div>
                    
                    <footer class="site-footer-wrapper">
                        <div class="site-footer-inner">
                            <div class="small-prints">
                                <p class="support-links"><a href=" https://probiller.com/support " target="_blank" id="customerSupportLink">Contact customer support</a></p>
                                <p class="copyright">&copy; 2019 PROBILLER.COM</p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </section>
    </form>
</main>

	
	
	
	
	
	
</body>
</html>
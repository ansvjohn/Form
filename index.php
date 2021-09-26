<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $Captcha=$_POST['Captcha'];
    if(($_POST['Captcha']) == $_SESSION['vercode'])
    {
        echo "submitted";
    }else{
        echo "wrong Captcha";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="assets/jquery-1.6.2.min.js"></script>
        <style type="text/css">
            div {
                  width: 100%;
                  padding: 2px;
                  margin: 5px 0 2px 0;
                  display: inline-block;
                  background: #f1f1f1;
                }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 align="center" style="color:green">Fill the form before time out</h1>
            <h3 style="color:#FF0000" align="center"><span id='timer'></span>
             </h3>
            <form method="POST" name="contact_form" action=""> 
                <div class="form-group">
                	<label for="name">Name: </label>
                	<input type="text" name="name" placeholder="Name*" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" placeholder="Email*" required>
                </div>
                <div class="form-group">
                    <label for="email">Phone: </label>
                    <input name="phone" type="text" class="wpcf7-form-control" placeholder="Phone*" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==10 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=37 && event.keyCode!=39) return false;" pattern="[0-9]{10}" title="Please enter 10 digits" required>
                </div>
                <div class="form-group">
                    <label for="dob">DOB: </label>
                    <input type="date" required> 
                </div>
                <div class="form-group">
                    <label for="message">About:</label> 
                    <textarea name="message" rows=8 cols=30 required></textarea>
                </div>
                <div class="form-group">
                    <div class="col-md-12">                             
                        <img src="captcha.php" class="imgcaptcha" alt="hotel guest room automation" />
                        <img src="assets/refresh.png" alt="reload" class="refresh" width="40" height="40" />
                    <div>
                    <input type="text" placeholder="Enter Code" name="Captcha" style="width: 300px;" class="" required>
                </div>


                <input type="submit" value="Submit" id="btn_submit" name="submit">
            </form>	
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        $(".refresh").click(function () {
            $(".imgcaptcha").attr("src","captcha.php?_="+((new Date()).getTime()));
    
        });
    });
	//define your time in second
		var c=180;
        var t;
        timedCount();

        function timedCount()
		{

        	//var hours = parseInt( c / 3600 ) % 24;
        	var minutes = parseInt( c / 60 ) % 60;
        	var seconds = c % 60;
        	var result = (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
        	$('#timer').html(result);
            
            if(c == 0 )
			{
            	$('#btn_submit').attr('disabled',true)
                return false;
			}
            c = c - 1;
            t = setTimeout(function()
			{
			 timedCount()
			},
			1000);
        }
    
</script>

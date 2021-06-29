<?php

// Get parameters
$roomname = $_GET['Name'];

// Connect to database
include 'db.php';

// Execute sql to check if room exist
$sql = "SELECT * FROM `rooms` where Name = '$roomname'";

$result = mysqli_query($conn, $sql);

if($result)
{
	// Check if room exist
	if(mysqli_num_rows($result) == 0)
	{
        $message = "This room does not exist. Try creating a new one.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/Chatterbox";';
        echo '</script>';
	}
	else
	{

	}

}
else
{
	echo "Error: ". mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    

    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet"> 
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass {
	height: 350px;
	overflow-y: scroll; 
}
</style>
</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal">ChatterBox!</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About</a>
        <a class="p-2 text-dark" href="#">Contacts</a>
      </nav>
      <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>

<h2>Chat Messages - <?php echo $roomname ?>;</h2>

<div class="container">
	<div class="anyClass">
  
  </div>
</div>


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">
	// Check for new msg in every 1 sec
	setInterval(runFunction, 1000);
	function runFunction()
	{
		$.post("htcont.php", {room: '<?php echo $roomname ?>'},
			function(data, status){
				document.getElementsByClassName('anyClass')[0].innerHTML = data;
			}


			)
	}


	// Get the input field, Credits: www.w3schools.com/howto/howto_jsasp_trigger_button_enter.
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
	 // Cancel the default action, if needed
    event.preventDefault();
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
       // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

	// After user submits the form
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
		$.post("postmsg.php", {text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    function(data, status){
  	  document.getElementsByClassName('anyClass')[0].innerHTML = data;});

		$('#usermsg').val("");
  	  return false;
    
  
  });

</script>

</body>
</html>

<?php
$room = $_POST['room'];

// Condition for naming room
if (strlen($room)>20 or strlen($room)<2) {
	$message = "Please enter the name between 2 to 20 characters";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatterbox";';
    echo '</script>';
}

elseif (!ctype_alnum($room)) {
	$message = "Please choose alphanumeric room name";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatterbox";';
    echo '</script>';
}

else{
	// Connect to database
	include 'db.php';
}

// Check if room exist
$sql = "SELECT * FROM `rooms` WHERE Name = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
	if(mysqli_num_rows($result)>0){
		$message = "Please choose a different room name. This room name is already taken.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/Chatterbox";';
        echo '</script>';

	}
	else{
		$sql = "INSERT INTO `rooms` (`Name`, `stime`) VALUES ('$room', current_timestamp());";
		if (mysqli_query($conn, $sql)) {
			$message = "Your room is ready";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/Chatterbox/rooms.php?Name=' . $room. '";';
            echo '</script>';
		}
	}
}

else
{
	echo "Error: ". mysqli_error($conn);

}


?>
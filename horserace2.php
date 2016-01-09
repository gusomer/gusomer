<?php

	 $winner = $_POST['winner'];
	 $Race_Time = $_POST['Race_Time'];
	 $Race_Date = $_POST['Race_Date'];
 //	$dbc = mysqli_connect('50.62.209.44', 'mna', '12345','horseracing') or die("could not connect to database".mysqli_error($dbc));
	//$dbc = mysqli_connect('localhost', 'mna', '12345','horseracing') or die("could not connect to database".mysqli_error($dbc));
	$dbc = mysqli_connect('localhost', 'root', '','horseracing') or die("could not connect to database".mysqli_error($dbc));
	 $sql="INSERT INTO winninghorse (Horse_No, Race_Time, Race_Date) VALUES ('$winner','$Race_Time','$Race_Date')";
	
	if(!mysqli_query($dbc,$sql)){
		die('Error:'.mysqli_error($dbc));}
		echo "1 record added";
		mysqli_close($dbc);
  ?>
	<script language="javascript">
alert('Horse No :<?= $winner  ?> has been added');
window.history.go(-1);
</script>	
		

//?>





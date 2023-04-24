<?php
$conn = mysqli_connect("localhost","root","","medimart")
or die (mysqli_error($conn));
if($conn)
echo"databse connected";
else
echo"error";
?>
<?php
$path = $_GET['path'];
//$upload_dir='../../images/users/';
$upload_dir = '../..'.$path;
foreach($_FILES['file']['name'] as $k=>$f) {
	if (!$_FILES['file']['error'][$k]) {
		if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
			//$name = uniqid();
			//$_FILES['file']['name'][$k]=$name.".jpg";
			if(!move_uploaded_file($_FILES['file']['tmp_name'][$k], $upload_dir)){
				die("Error");
			} else{
				echo "Success";
			}
		}
	}	
}
?>
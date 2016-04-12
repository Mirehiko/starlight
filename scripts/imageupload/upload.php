<?php
foreach($_FILES['file']['name'] as $k=>$f) {
	if (!$_FILES['file']['error'][$k]) {
		if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
			if(!move_uploaded_file($_FILES['file']['tmp_name'][$k], $_FILES['file']['name'][$k]))
				die("Error");
			else 
				echo "Success";
		}
	}	
}
?>
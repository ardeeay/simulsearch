<?php
include_once 'dbl_search.php';
$target_path = "uploads/";
$target_path = $target_path . basename($_FILES['uploadedfile']['tmp_name']); 
$content = "";
$keyword_1_from_user = $_POST['keyone'];
$keyword_2_from_user = $_POST['keytwo'];
$max_constraint = $_POST['maxchar'];
$min_constraint = $_POST['minchar'];

if ($_FILES['uploadedfile']['type'] == 'text/plain'){
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
	$file = $_FILES['uploadedfile']['tmp_name'];
	$content = file_get_contents($target_path);	
}
else{
	echo 'file must be txt format';
	
}

$content = ' ' . $content;
$content = strtolower($content);

$array_keyword_1 = generate_array_of_keyword1_matches($content, $keyword_1_from_user);
compare_and_output_array($content, $array_keyword_1, $keyword_1_from_user, $keyword_2_from_user, $max_constraint, $min_constraint);

move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path) == true){

	} 
	else{
	echo "There was an error uploading the file, please ensure it is a TXT/TEXT file.";	
	include "index.html";
	}
 }
*/

?>

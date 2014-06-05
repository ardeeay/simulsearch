<?php

/*
Purpose: Returns a string(s) containing the two specified keywords found in a single document and is constrained by the max and/or min character distance specified by user.
Author: Robert Ackert
*/

function generate_array_of_keyword1_matches($content, $keyword_1_from_user){
	$keyword = substr($keyword_1_from_user, 0, (strlen($keyword_1_from_user)));
	$end_of_file = false;
    $offset_current = 0;
    $array_keyword_1 = array();
	while ($end_of_file != true){
		$instance_pos = strpos($content, $keyword, $offset_current);
		
		if (($instance_pos >= $offset_current) && $instance_pos != false){
			array_push($array_keyword_1, $instance_pos);
			$offset_current = $instance_pos + strlen($keyword);
		}
		else{
			$end_of_file = true;
		}
	}
	return ($array_keyword_1);
}

function compare_and_output_array($content, $array_keyword_1, $keyword_1_from_user, $keyword_2_from_user, $max_constraint, $min_constraint){
	$end_of_file = false;
	$desired_string = array();
	$position_keyword_2 = strpos($content, $keyword_2_from_user);
	$offset = 0;
	foreach($array_keyword_1 as $position_keyword_1){
		$printed = false;
		$end_of_file = false;
		while ($end_of_file != true && $position_keyword_1 != false && $printed != true){
			if (((abs ($position_keyword_2 - $position_keyword_1)) >= $min_constraint) &&
			 ((abs ($position_keyword_2 - $position_keyword_1)) <= $max_constraint) &&
			  ($position_keyword_1 < $position_keyword_2)){
			  	$span_for_substr = ($position_keyword_2 - $position_keyword_1) + strlen($keyword_2_from_user);
			  	$span_for_substr = $span_for_substr + 20;
			  	$desired_string = substr($content, $position_keyword_1, $span_for_substr);
			  	echo "MATCH: " . $desired_string . "<br><br>";
			  	$printed = true;
			}
			elseif (((abs ($position_keyword_2 - $position_keyword_1)) >= $min_constraint) &&
			 ((abs ($position_keyword_2 - $position_keyword_1)) <= $max_constraint) &&
			  ($position_keyword_2 < $position_keyword_1)){
			  	$span_for_substr = ($position_keyword_1 - $position_keyword_2) + strlen($keyword_1_from_user);
			  	$span_for_substr = $span_for_substr + 20;
			  	$desired_string = substr($content, $position_keyword_2, $span_for_substr);
			  	echo "MATCH: " . $desired_string . "<br><br>";
			    $printed = true;
		    }
		    elseif ($position_keyword_2 == false){
		    	
		    	$end_of_file = true;
		    }
		    $offset = $position_keyword_2 + strlen($keyword_2_from_user);
		    $position_keyword_2 = strpos($content, $keyword_2_from_user, $offset);

		}
	}
	echo "<b>END OF MATCHES</b><br><br>";

?>




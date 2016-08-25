<?php 
	function get_date($time){
		$format = '%d-%m-%y';
		/*if ($full_time) {
			$format = $format .' %H:%i:%s';
		}*/
		$date = mdate($format, $time);
		return $date;
	}
 ?>
<?php
	 $year = "1991";
 	 $curYear = date("Y");
	 $curMonth = date("m");
         $curDay = date("j");
		  $age = (int)$curYear -(int)$year; 
		
        if($curMonth < $month || ($curMonth==$month && $curDay<$day)) 
                $age--; 
       echo $age; 

?>
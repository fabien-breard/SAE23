<?php
#Allows to define the unit of measurement according to the type of sensor (°c ; CO2 ; lux)
	if ($type == 'Temp')
		{
			$unit = '°C';
		}
	else 
		{
			if ($type == 'CO2')
				{
					$unit = 'ppm';
				}
			else 
				{
					$unit = 'lux';
				}
		}
?>

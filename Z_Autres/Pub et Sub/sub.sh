#!/bin/bash
set -xv
while true
do
	message=`mosquitto_sub -h localhost -t iut/# -C 1 -v`
	valeur=$(echo $message | cut -d "/" -f 4)
	type=$(echo $valeur | cut -d " " -f 1)
	mesure=$(echo $valeur | cut -d " " -f 2)
	salle=$(echo $message | cut -d "/" -f 3)
	batiment=$(echo $message | cut -d "/" -f 2)

	if [ $batiment == "bate" ]
	then
		if [ $salle == "E208" ]
		then
			if [ $type == "temperature" ]
			then 
			capteur=TE208
			elif [ $type == "co2" ]
			then
			capteur=CE208
			else
			capteur=LE208
			fi
		else
			if [ $type == "temperature" ]
			then
			capteur=TE207
			elif [ $type == "co2" ]
			then
			capteur=CE207
			else 
			capteur=LE207
			fi
		fi
	else
		if [ $salle == "B113" ]
		then
			if [ $type == "temperature" ]
			then
			capteur=TB113
			elif [ $type == "co2" ]
			then
			capteur=CB113
			else 
			capteur=LB113
			fi
		else
			if [ $type == "temperature" ]
			then
			capteur=TB112
			elif [ $type == "co2" ]
			then
			capteur=CB112
			else 
			capteur=LB112
			fi
		fi
	fi
/opt/lampp/bin/mysql -u samitier -pazertyuiop1230 -D SAE23 -e "INSERT INTO Mesure (`date`, `hor`, `value`, `from`) VALUES ('CURRENT_DATE', 'CURRENT_TIME', '$mesure', '$capteur');"
done

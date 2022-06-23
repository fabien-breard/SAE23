#!/bin/bash

broker="localhost"      # Here I specify where release data
#user="student"
#pass="student"
declare -a salles=("E208" "E207" "B113" "B112")     # Here I declare the rooms where de sensors are
tailleSalles=$(echo ${#salles[@]})
declare -a topics=("iut/bate/E208/temperature"
"iut/bate/E208/co2"
"iut/bate/E208/lux"
"iut/bate/E207/temperature"
"iut/bate/E207/co2"
"iut/bate/E207/lux"
"iut/batb/B113/temperature"
"iut/batb/B113/co2"
"iut/batb/B113/lux"
"iut/batb/B112/temperature"
"iut/batb/B112/co2"
"iut/batb/B112/lux")        # Here you can see all the topics of the sensors

tailleTopics=$(echo ${#topics[@]})
declare -A valTemp
declare -A valCo2
declare -A valLux
maxTemp=25
minTemp=18
maxCo2=900
minCo2=300
maxLux=80
minLux=40
# Here you can see the minimum and the maximun of each tipe of value (temperqture, CO2 and Light), it is necessary for the following calculations

for ((n=0;n<$tailleSalles;n++))  # For each room
do
	valTemp[${salles[$n]}]=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))  # get random value of Temperature
	valCo2[${salles[$n]}]=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))      # get random value of CO2
	valLux[${salles[$n]}]=$(($RANDOM%($maxLux -$minLux + 1) + $minLux ))      # get random value of Light
done

while true
	do
    	for ((n=0;n<$tailleSalles;n++))
    	do
        	newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
		diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
        	diffTemp2=$(echo $diffTemp | tr -d -)      # necessary in order to get probable values of Temperature

		newCo2=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))
		diffCo2=$(($newCo2 - valCo2[${salles[$n]}]))
       	diffCo22=$(echo $diffCo2 | tr -d -)        # necessary in order to get probable values of CO2

		newLux=$(($RANDOM%($maxLux -$minLux + 1) + $minLux ))
		diffLux=$(($newLux - valLux[${salles[$n]}]))
       	diffLux2=$(echo $diffLux | tr -d -)        # necessary in order to get probable values of Light
		
		while [ $diffTemp2 -ge 2 ]
        do
            newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))      
            diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
            diffTemp2=$(echo $diffTemp | tr -d -)       # necessary in order to get probable values of Temperature
        done
		while [ $diffCo22 -ge 100 ]
        do
            newCo2=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))       
            diffCo2=$(($newCo2 - valCo2[${salles[$n]}]))
            diffCo22=$(echo $diffCo2 | tr -d -)            # necessary in order to get probable values of CO2
        done
		while [ $diffLux -ge 20 ]
        do
            newLux=$(($RANDOM%($maxLux -$minLux + 1) + $minLux ))       
            diffLux=$(($newLux - valLux[${salles[$n]}]))
            diffLux2=$(echo $diffLux | tr -d -)        # necessary in order to get probable values of Light
        done
        valTemp[${salles[$n]}]=$newTemp
		valCo2[${salles[$n]}]=$newCo2
	done

    for ((n=0;n<$tailleTopics;n++))
    do
        topic=$(echo ${topics[$n]})
        room=$(echo $topic | cut -d "/" -f 3) # cutting in order to get the right value -> the room
        sensor=$(echo $topic | cut -d "/" -f 4)   # cutting in order to get the right value -> the sensor
        if [ $sensor == "temperature" ]
        then
            val=$(echo ${valTemp[$room]})
        elif [ $sensor == "co2" ]
        then
            val=$(echo ${valCo2[$room]})
	else
		val=$(echo ${valLux[$room]})
	fi  
        mosquitto_pub -h $broker -t $topic -m "$val" # Broadcasting of the values
        sleep 5
    done
    sleep 20
done

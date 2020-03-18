#!/bin/bash
# This script STOPs all the running containers that belong to the project

source project.cfg

if [ $# -eq 0 ]
  then
    echo "No arguments supplied. Please provide domain name as an argument."
	exit 0
fi

./db-dump.sh # dump the database

## First KILL all containers
CONTAINERS=( $(docker ps -a --format '{{.ID}}' ) )
DOMAINS=( $(docker ps -a --format '{{.Names}}' | sed 's/_/\./g') )

# iterate the domains to find the one we want to kill
DOMAIN=$1

for i in "${!DOMAINS[@]}"
do
	if [[ ${DOMAINS[$i]} == $DOMAIN* ]]; 
	  then
		echo "Going to kill "${DOMAINS[$i]}" running on Container ID "${CONTAINERS[$i]}
		docker kill ${CONTAINERS[$i]}
		docker rm ${CONTAINERS[$i]}
	fi
done

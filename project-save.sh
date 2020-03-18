#!/bin/bash
# This script UPDATEs (saves) the image based on the current container state

source project.cfg

if [ $# -eq 0 ]
  then
    echo "No arguments supplied. Please provide domain name as an argument."
	exit 0
fi

./db-dump.sh # dump the database

CONTAINERS=( $(docker ps -a --format '{{.ID}}' ) )
DOMAINS=( $(docker ps -a --format '{{.Names}}' | sed 's/_/\./g') )

# iterate the domains to find the one we want to kill
DOMAIN=$1
IMAGE=$(echo $DOMAIN | sed 's/\./_/g')

for i in "${!DOMAINS[@]}"
do
	if [[ ${DOMAINS[$i]} == "$DOMAIN.web" ]]; 
	  then

		echo "Going to commit the changes of "${DOMAINS[$i]}" running on Container ID "${CONTAINERS[$i]}" to the $IMAGE image."
		docker commit ${CONTAINERS[$i]} $IMAGE
	fi
done

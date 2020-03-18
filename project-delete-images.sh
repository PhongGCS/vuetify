#!/bin/bash
# This script STOPs all the running containers that belong to the project and then DELETEs the images

source project.cfg

if [ $# -eq 0 ]
  then
    echo "No arguments supplied. Please provide domain name as an argument."
	exit 0
fi

## First KILL all containers
./project-stop-containers.sh $1


## Now delete all the images
IMAGES=( $(docker images --format '{{.ID}}' ) )
DOMAINS=( $(docker images --format '{{.Repository}}' | sed 's/_/\./g') )

# iterate the domains to find the one we want to kill
DOMAIN=$1

for i in "${!DOMAINS[@]}"
do
	if [[ ${DOMAINS[$i]} == $DOMAIN* ]]; 
	  then
		echo "Going to force-remove image "${DOMAINS[$i]}" ID "${IMAGES[$i]}
		docker rmi ${IMAGES[$i]} --force
	fi
done
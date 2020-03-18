#!/bin/bash
source project.cfg

# get the latest sql file path
SQL_FILE=$(ls -t files/docker/db-dumps/* | head -1)

echo Droping the database
docker-compose exec web wp db drop --allow-root
docker-compose exec web wp db create --allow-root

echo Going to import /source/$SQL_FILE

# export the db
docker-compose exec web wp db import /source/$SQL_FILE --allow-root
#!/bin/bash
source project.cfg

# export the db
docker-compose exec web wp db export /source/files/docker/db-dumps/$LOCAL_DEV_HOSTNAME.sql --allow-root
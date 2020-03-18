#!/bin/bash
source project.cfg
DIRECTORY="site/web/app/themes/$THEME_NAME/public"

cd static/web/
yarn build
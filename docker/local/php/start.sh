#!bin/bash

composer i
php bin/console doctrine:database:create --if-not-exists
php bin/console d:m:m --no-interaction

rr serve -c .rr.dev.yaml
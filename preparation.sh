#!/bin/bash
# Si SELinux -> sudo setenforce Permissive avant lancement du container
composer install
php bin/console doctrine:schema:update --force

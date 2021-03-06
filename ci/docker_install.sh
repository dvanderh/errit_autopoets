#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && exit 0

set -xe

# Install git (the php image doesn't have it) which is required by composer
apt-get update -yqq
apt-get install git zlib1g-dev libmcrypt-dev libcurl4-gnutls-dev libicu-dev libpng-dev libjpeg-dev libxml2-dev libbz2-dev wget -yqq

# Install mysql driver
# Here you can install any other extension that you need
docker-php-ext-install mbstring mcrypt pdo pdo_mysql curl json intl gd xml zip bz2 opcache

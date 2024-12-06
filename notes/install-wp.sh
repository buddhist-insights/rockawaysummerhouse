#!/bin/bash

set -eu
cd "$(dirname "$0")"

lando destroy -y

mkdir -p wordpress

lando init \
  --source cwd \
  --recipe wordpress \
  --webroot wordpress \
  --name rockawaysummerhouse

lando start

lando wp core download \
  --path=wordpress \
  --force

lando wp config create \
  --dbname=wordpress \
  --dbuser=wordpress \
  --dbpass=wordpress \
  --dbhost=database \
  --path=wordpress \
  --force

echo -n >empty.sql
lando db-import empty.sql
rm -f empty.sql

lando wp core install \
  --url=http://rockawaysummerhouse.lndo.site/ \
  --title="Rockaway Summer House" \
  --admin_user=admin \
  --admin_password=password \
  --admin_email=admin@rockawaysummerhouse.lndo.site \
  --path=wordpress

lando db-import --no-wipe adjusted.sql

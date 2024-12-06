#!/bin/bash

set -eu
cd "$(dirname "$0")"

IMPORT_SQL=giovanna_wp507.sql
IMPORT_PREFIX=wpo3_

lando destroy -y

lando init \
  --source cwd \
  --recipe lamp \
  --webroot . \
  --name rockawaysummerhouse

lando start

lando db-import "$IMPORT_SQL"

cat <<EOF | lando exec database -- mysql -u root | grep ^RENAME | lando exec database -- mysql -u root
  SELECT CONCAT(
    'RENAME TABLE ',
    TABLE_SCHEMA, '.', TABLE_NAME,
    ' TO ',
    TABLE_SCHEMA, '.wp_', TRIM(LEADING '$IMPORT_PREFIX' FROM TABLE_NAME),
    ';'
  ) from information_schema.Tables where TABLE_SCHEMA='lamp';
EOF

cat <<EOF | lando exec database -- mysql -u root lamp
  DROP TABLE wp_commentmeta;
  DROP TABLE wp_comments;
  DROP TABLE wp_links;
  DROP TABLE wp_options;
  DROP TABLE wp_usermeta;
  DROP TABLE wp_users;
  DROP TABLE wp_jetpack_sync_queue;
  DROP TABLE wp_pps_countries;
  DROP TABLE wp_pps_modules;
  DROP TABLE wp_pps_modules_type;
  DROP TABLE wp_pps_popup;
  DROP TABLE wp_pps_popup_show_categories;
  DROP TABLE wp_pps_popup_show_pages;
  DROP TABLE wp_pps_statistics;
  DROP TABLE wp_pps_subscribers;
  DROP TABLE wp_pps_usage_stat;
  DROP TABLE wp_yoast_seo_links;
  DROP TABLE wp_yoast_seo_meta;
  UPDATE wp_posts SET post_author = 1;
EOF

cat <<EOF | lando exec database -- mysql -u root lamp
  DELETE FROM wp_posts WHERE
    post_type IN (
      'feedback',
      'jp_img_sitemap',
      'jp_sitemap',
      'jp_sitemap_master',
      'tribe_events'
      'tribe-ea-record'
    );

  DELETE wp_postmeta FROM wp_postmeta LEFT JOIN wp_posts
    ON wp_posts.ID = wp_postmeta.post_id
    WHERE wp_posts.ID IS NULL;

  UPDATE wp_posts SET
    guid = REPLACE(guid, 'http://rockawaysummerhouse.com/', 'http://rockawaysummerhouse.lndo.site/');
  UPDATE wp_posts SET
    guid = REPLACE(guid, 'https://rockawaysummerhouse.com/', 'http://rockawaysummerhouse.lndo.site/');
  UPDATE wp_posts SET
    post_content = REPLACE(post_content, 'http://rockawaysummerhouse.com/', '/');
  UPDATE wp_posts SET
    post_content = REPLACE(post_content, 'https://rockawaysummerhouse.com/', '/');
EOF

lando exec database -- mysqldump -u root -t lamp > adjusted.sql
perl -pi -e 's/^LOCK TABLES `(.*)` WRITE;/LOCK TABLES `$1` WRITE;\nTRUNCATE TABLE `$1`;/g' adjusted.sql

#!/usr/bin/env bash

echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini

/wait-for-it.sh -t 0 mysql:3306 -- echo "mysql is up"

# Delete wp-config
if [ -f ${WP_ROOT}/wp-config.php ]; then
	rm -f ${WP_ROOT}/wp-config.php
fi

# Then initialize a local wp-config if not exists
if [ ! -f ${WP_ROOT}/wp-config.local.php ]; then

	wp core download --path=${WP_ROOT} --allow-root --locale=ja --version=${WP_VERSION}
	wp core config   --path=${WP_ROOT} --allow-root \
		--dbname=${MYSQL_DATABASE} \
		--dbuser=root \
		--dbpass=${MYSQL_ROOT_PASSWORD} \
		--dbhost=mysql \
		--dbprefix=${WP_DB_PREFIX} \
		--skip-salts \
		--skip-check \
		--extra-php <<PHP
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );
PHP

  if ! $(wp core is-installed --path=${WP_ROOT} --allow-root); then
    # Install core
    wp core install --path=${WP_ROOT} --allow-root \
      --url=${WP_URL} \
      --title=wp \
      --admin_user=${WP_ADMIN_USER} \
      --admin_password=${WP_ADMIN_PASSWORD} \
      --admin_email=${WP_ADMIN_EMAIL} \
      --skip-email

    # Install and activate plugins

    # Delete plugin
    if $(wp plugin is-installed hello --path=${WP_ROOT} --allow-root); then
      wp plugin delete hello --path=${WP_ROOT} --allow-root
    fi

    # Activate plugin
    if $(wp plugin is-installed wp-multibyte-patch --path=${WP_ROOT} --allow-root); then
      wp plugin activate wp-multibyte-patch --path=${WP_ROOT} --allow-root
    fi

    # Activate theme
    wp theme activate ${WP_CURRENT_THEME} --path=${WP_ROOT} --allow-root

    # Delete theme
    if $(wp theme is-installed twentyfifteen --path=${WP_ROOT} --allow-root); then
      wp theme delete twentyfifteen --path=${WP_ROOT} --allow-root
    fi

    if $(wp theme is-installed twentysixteen --path=${WP_ROOT} --allow-root); then
      wp theme delete twentysixteen --path=${WP_ROOT} --allow-root
    fi

    if $(wp theme is-installed twentyseventeen --path=${WP_ROOT} --allow-root); then
      wp theme delete twentyseventeen --path=${WP_ROOT} --allow-root
    fi

  fi

 	mv ${WP_ROOT}/wp-config.php ${WP_ROOT}/wp-config.local.php

fi

# Finally, make a symlink to wp-config
(cd ${WP_ROOT} && ln -s wp-config.local.php wp-config.php)

/usr/sbin/php-fpm7.0 -F

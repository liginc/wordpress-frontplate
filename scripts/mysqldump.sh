#!/usr/bin/env bash

# Nasty hack to emurate `realpath` on OSX
SCRIPT_PATH=`perl -e 'use Cwd "abs_path";print abs_path(shift)' $0`

printf "\e[36mDumping database tables...\e[0m\n"
if ! docker-compose -f  $(dirname $SCRIPT_PATH)/../docker-compose.yml exec mysql bash -c "mysqldump -uroot -p\$MYSQL_ROOT_PASSWORD -hlocalhost -B \$MYSQL_DATABASE -v --skip-comments -r /docker-entrypoint-initdb.d/\$MYSQL_DATABASE.sql && gzip -9vf /docker-entrypoint-initdb.d/\$MYSQL_DATABASE.sql"; then
  printf "\e[31mFAIL\e[0m\tFailed to dumb database\n"
  exit 2
fi

printf "\e[32mok\e[0m\t\n"

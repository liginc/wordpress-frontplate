#!/usr/bin/env bash

# Config
BUILDER_IMAGE=liginccojp/frontplate-cli-docker:node8-npm4-frp4

# Nasty hack to emurate `realpath` on OSX
SCRIPT_PATH=`perl -e 'use Cwd "abs_path";print abs_path(shift)' $0`

# Color codes
# check if stdout is a terminal...
if test -t 1; then
    # see if it supports colors...
    ncolors=$(tput colors)
    if test -n "$ncolors" && test $ncolors -ge 8; then
        BOLD="$(tput bold)"
        # UNDERLINE="$(tput smul)"
        # STANDOUT="$(tput smso)"
        NORMAL="$(tput sgr0)"
        # BLACK="$(tput setaf 0)"
        RED="$(tput setaf 1)"
        # GREEN="$(tput setaf 2)"
        # YELLOW="$(tput setaf 3)"
        # BLUE="$(tput setaf 4)"
        # MAGENTA="$(tput setaf 5)"
        CYAN="$(tput setaf 6)"
        # WHITE="$(tput setaf 7)"
    fi
fi

# chekking command installation
for COMMAND in docker; do
    if ! COMMAND_LOCATION="$(type -p "${COMMAND}")" || [[ -z ${COMMAND_LOCATION} ]]; then
        echo "${RED}${BOLD}ERROR:${NORMAL} ${RED}command not found: ${COMMAND}${NORMAL}"
        echo "You need to install Docker to use this build script"
        exit 1
    fi
done

echo "${CYAN}Pulling the latest docker image...${NORMAL}"

docker pull ${BUILDER_IMAGE}

echo "${CYAN}Running the builder application inside the docker container...${NORMAL}"

docker run \
    -it --rm \
    -v $(dirname ${SCRIPT_PATH})/..:/workspace:rw \
    ${BUILDER_IMAGE}

exit 0

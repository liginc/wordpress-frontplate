#!/usr/bin/env bash

#-------------------------------------------------------------------------------
# Config

BUILDER_IMAGE=liginccojp/frontplate-cli-docker:node8-npm4-frp4

#-------------------------------------------------------------------------------
# Helper

# Nasty hack to emurate `realpath` on OSX
SCRIPT_PATH=`perl -e 'use Cwd "abs_path";print abs_path(shift)' $0`

# Color codes
NORMAL=''
RED=''
CYAN=''
# check if stdout is a terminal...
if test -t 1; then
    # see if it supports colors...
    ncolors=$(tput colors)
    if test -n "$ncolors" && test $ncolors -ge 8; then
        NORMAL="$(tput sgr0)"
        RED="$(tput setaf 1)"
        CYAN="$(tput setaf 6)"
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

#-------------------------------------------------------------------------------
# Help Message

if [ "$1" = "--help" ]; then
  echo "${BOLD}Frontend Resource Build Helper Script${NORMAL}"
  echo ""
  echo "${CYAN}Run default build:${NORMAL}        $(basename $0)"
  echo "${CYAN}Run specific command:${NORMAL}     $(basename $0) command [options [...]]"
  echo "${CYAN}Pull latest Docker image:${NORMAL} $(basename $0) pull"
  exit 0
fi

#-------------------------------------------------------------------------------
# Pull Latest Docker Image

if [ "$1" = "pull" ]; then
  echo "${CYAN}Pulling the latest docker image...${NORMAL}"
  if ! docker pull ${BUILDER_IMAGE}; then
    echo "${RED}${BOLD}ERROR:${NORMAL}${RED} Failed to pull the docker image: ${BUILDER_IMAGE}${NORMAL}"
    exit 1
  fi
  exit 0
fi

#-------------------------------------------------------------------------------
# Runnning Command on Docker Container

if [ $# -ne 0 ]; then
  echo "${CYAN}Running the command \`$@\` inside the docker container...${NORMAL}"
else
  echo "${CYAN}Running the builder application inside the docker container...${NORMAL}"
fi


if ! docker run \
    -it --rm \
    -v $(dirname ${SCRIPT_PATH})/..:/workspace:rw \
    ${BUILDER_IMAGE} \
    $@; then
  echo "${RED}${BOLD}ERROR:${NORMAL}${RED} Failed to execute command \`$@\` on the container${NORMAL}"
  exit 1
fi

exit 0

#-------------------------------------------------------------------------------

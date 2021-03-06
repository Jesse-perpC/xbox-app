#!/bin/bash

SCRIPTNAME=`basename "$0"`




# parse_parameters:
while [[ "$1" == -* ]] ; do
	case "$1" in
		-h|-help|--help)
			exit
			;;
		--)
			#echo "-- found"
			shift
			break
			;;
		*)
			echo "Invalid parameter: '$1'"
			exit 1
			;;
	esac
done

if [ "$#" != 1 ] ; then
	echo "Incorrect parameters. Use --help for usage instructions."
	exit 1
fi


FULLNAME="$1"
BASENAME=`basename "$FULLNAME"`
DIRNAME=`dirname "$FULLNAME"`

coproc INOTIFY {
	inotifywait -q -m -e close_write,moved_to,create ${DIRNAME} &
	trap "kill $!" 1 2 3 6 15
	wait
}

trap "kill $INOTIFY_PID" 0 1 2 3 6 15


sed --regexp-extended -n "/ (CLOSE_WRITE|MOVED_TO|CREATE)(,CLOSE)? ${BASENAME}\$/q" 0<&${INOTIFY[0]}
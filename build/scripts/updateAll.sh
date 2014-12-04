#!/bin/sh

set -e

# Base directory for this entire project
BASEDIR=$(cd $(dirname $0) && pwd)/

echo $BASEDIR

# build dojo single file
cd $BASEDIR/../../client/src
#sh buildstandalone.sh
gitc

# commit xphp
cd $BASEDIR/../../xapp
gitc

cd $BASEDIR/
# update dist zip
#sh $BASEDIR/buildReleaseStandAlone.sh
# update windows app
sh $BASEDIR/updateWindowsApp.sh

# commit root directory
cd $BASEDIR/../../

gitc





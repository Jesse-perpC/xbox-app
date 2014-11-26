#!/bin/sh

set -x
SRC_DIR=../../DIST/

DIST=../../../xbox-app-windows/xbox-app

####### CLEAN UP
rm -rf $DIST
mkdir -p $DIST

cp -rf $SRC_DIR/* $DIST/
rm $DIST/xbox.zip


cd $DIST/
#find $DISTDIR -name *.git -exec rm '{}' ';'
#git add -A
gitc
#!/bin/sh

cd ..

cd client/src

sh buildstandalone.sh
sh buildExternalLibs.sh
sh buildLayer.sh davinci
sh buildLayer.sh dijit
sh buildLayer.sh dojox

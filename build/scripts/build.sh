#!/bin/sh
. ./setEnvBox.sh

cd $XCOM_LOCAL/docroot/


if [ $SVN_UPDATE -eq 1 ] ;
then
    echo "Update SVN"
    svn update --no-auth-cache --trust-server-cert --non-interactive .
else
    echo "Skip SVN update"
fi

if [ $BUILD_DOJO -eq 1 ] ;
then
    echo "Build WP-Dojo App"
    cd $XCOM_LOCAL/docroot/client/
    sh buildstandalone.sh
else
    echo "Skip Dojo build"
fi

if [ $COMMIT_DOJO -eq 1 ] ;
then
    echo "Commit Dojo App"

    cd $XCOM_LOCAL/docroot/client/xfile/dojo/
    svn ci --no-auth-cache --trust-server-cert --non-interactive --message="scripted update" xbox.js

    echo "Commit All XStandAlone"
    cd $XCOM_LOCAL/docroot/client/xfile/xbox/
    svn ci --no-auth-cache --trust-server-cert --non-interactive --message="scripted update" .
else
    echo "Skip Commit Dojo App"
fi

if [ $UPDATE_PACKAGE -eq 1 ] ;
then
    echo "Build StandAlone Package"
    cd $XCOM_LOCAL/install/scripts/
    ls
    sh buildReleaseStandAlone.sh
else
    echo "Skip StandAlone Package"
fi

if [ $UPLOAD_PACKAGE -eq 1 ] ;
then
    echo "Upload StandAlone Package"
    cd $XCOM_LOCAL/DIST/
    scp xbox.zip mc007@pearls-media.com:/var/www/vhosts/pearls-media.com/xcom/downloads/Stand-Alone/xbox.zip
    echo "Upload StandAlone Package : done"
else
    echo "Skip StandAlone Package"
fi

echo "DONE with all!!!"

#!/bin/sh

set -x
SRC_DIR=../../

DIST=../../DIST

####### CLEAN UP
rm -rf $DIST
mkdir -p $DIST


###### EXPORT LATEST VERSION FROM SVN
cp -rf $SRC_DIR/* $DIST/


rm -rf "$DIST/user"
rm -rf "$DIST/client/.idea"


rm -rf "$DIST/xapp//lib/rpc/_tmp/"
rm -rf "$DIST/xapp//lib/PHPLinq/"
rm -rf "$DIST/xapp//lib/lucene/"
#rm -rf "$DIST/xapp//lib/rpc/lib/vendor/firephp"
rm -rf "$DIST/xapp//lib/html/HTMLFilterWP.php"
rm -rf "$DIST/xapp//lib/html/filterWP.php"
rm -rf "$DIST/xapp//lib/utils/diff_match_patch.php"

rm -rf "$DIST/server/service/index_joomla_backup.php"
rm -rf "$DIST/server/service/index_debug.php"
rm -rf "$DIST/server/service/index_joomla_site.php"
rm -rf "$DIST/server/service/backup"
rm -rf "$DIST/server/service/index.php"
rm -rf "$DIST/server/xcms/JsonStoreJSONPathBackup.php"
rm -rf "$DIST/server/xcms/backup"
rm -rf "$DIST/server/service/index_joomla.php"
rm -rf "$DIST/server/service/index0.php"
rm -rf "$DIST/templates/joomla"
######  remove some bs
rm -rf "$DIST/xapp/lib/PHPLinq/Tests/"
rm -rf "$DIST/xapp/lib/rpc/_tmp/"

rm -rf "$DIST/client/src/lib"
rm -rf "$DIST/client/src/xfile/xjoomla"
rm -rf "$DIST/client/src/xfile/dojo/dojo.js"
rm -rf "$DIST/client/src/xfile/ext/cm/codemirror.js"
rm -rf "$DIST/client/src/themes/jQuery"

rm -rf "$DIST/xapp/test.php"
rm -rf "$DIST/xapp/testRPC.php"

rm -rf "$DIST/xapp/indexWP.php"
rm -rf "$DIST/xapp/installTestJoomla.php"
rm -rf "$DIST/xapp/phpCheck.php"
rm -rf "$DIST/xapp/installCheck.php"
rm -rf "$DIST/xapp/indexReleaseJoomla.php"
rm -rf "$DIST/xapp/jincludes.php"
rm -rf "$DIST/xapp/flush.php"


rm -rf "$DIST/xapp/installTestJoomla.php"
rm -rf "$DIST/xapp/phpCheck.php"
rm -rf "$DIST/xapp/installCheck.php"
rm -rf "$DIST/xapp/indexReleaseJoomla.php"
rm -rf "$DIST/xapp/flush.php"

rm -rf "$DIST/server/service/"
rm -rf "$DIST/server/xide/"
rm -rf "$DIST/server/"

rm -rf "$DIST/xapp/conf"
rm -rf "$DIST/xapp/connect/legacy"
rm -rf "$DIST/xapp/connect/filter"
rm -rf "$DIST/xapp/connect/forms"
rm -rf "$DIST/xapp/connect/html"
rm -rf "$DIST/xapp/tests/"
rm -rf "$DIST/xapp/testing/"
rm -rf "$DIST/xapp/Doc/"
rm -rf "$DIST/xapp/connect/factory"
rm -rf "$DIST/xapp/connect/wordpress"
rm -rf "$DIST/xapp/connect/ctypes"
rm -rf "$DIST/xapp/connect/cache"
rm -rf "$DIST/xapp/connect/templates"
rm -rf "$DIST/xapp/connect/IPlugin.php"
rm -rf "$DIST/xapp/connect/Plugin.php"
rm -rf "$DIST/xapp/connect/PluginManager.php"
rm -rf "$DIST/xapp/connect/RPCPlugin.php"

rm -rf "$DIST/xapp/connect/XAPP_JSONP_Plugin.php"


rm -rf "$DIST/xapp/connect/lib/cache"
rm -rf "$DIST/xapp/connect/lib/core"
rm -rf "$DIST/xapp/connect/lib/html"

rm -rf "$DIST/xapp/Tpl.php"
rm -rf "$DIST/xapp/TplNew.php"
rm -rf "$DIST/xapp/jincludes.php"
rm -rf "$DIST/xapp/Schema*.php"
rm -rf "$DIST/xapp/conf*.php"
rm -rf "$DIST/xapp/index.php"
rm -rf "$DIST/xapp/indexRPC.php"
rm -rf "$DIST/xapp/SchemaFuncs.php"
rm -rf "$DIST/xapp/SchemaFuncsDate.php"
rm -rf "$DIST/xapp/SchemaFuncsJoomla.php"
rm -rf "$DIST/xapp/SchemaProcessor.php"
rm -rf "$DIST/xapp/includes.php"
rm -rf "$DIST/xapp/ISchemaProcessor.php"

rm -rfv "$DIST/xapp/conf.inc.debug.php"
rm -rfv "$DIST/xapp/conf.inc.debug.wp.php"
rm -rfv "$DIST/xapp/conf.inc.php"
rm -rfv "$DIST/xapp/plugins-enabled"
rm -rfv "$DIST/xapp/conf.inc.release.php"
rm -rfv "$DIST/xapp/conf.inc.release.wp.php"
rm -rfv "$DIST/xapp/conf.joomla.php"

rm -rfv "$DIST/xapp/commander/plugins/Zoho"
rm -rfv "$DIST/xapp/commander/plugins/LESS"
rm -rfv "$DIST/xapp/commander/plugins/HTMLEditor"
rm -rfv "$DIST/xapp/commander/plugins/SVN"
rm -rfv "$DIST/xapp/connect/filter"
rm -rfv "$DIST/xapp/connect/forms"
rm -rfv "$DIST/xapp/connect/html"
rm -rfv "$DIST/xapp/connect/factory"
rm -rfv "$DIST/xapp/connect/wordpress"
rm -rfv "$DIST/xapp/connect/ctypes"
rm -rfv "$DIST/xapp/connect/cache"
rm -rfv "$DIST/xapp/connect/templates"
rm -rfv "$DIST/xapp/connect/IPlugin.php"
rm -rfv "$DIST/xapp/connect/Plugin.php"
rm -rfv "$DIST/xapp/connect/PluginManager.php"
rm -rfv "$DIST/xapp/connect/RPCPlugin.php"
rm -rfv "$DIST/xapp/connect/XAPP_JSONP_Plugin.php"
rm -rfv "$DIST/xapp/connect/lib/cache"
rm -rfv "$DIST/xapp/connect/lib/core"
rm -rfv "$DIST/xapp/connect/lib/html"
rm -rfv "$DIST/xapp/connect/utils/CIUtils.php"
rm -rfv "$DIST/xapp/connect/utils/Ranking.php"
rm -rfv "$DIST/xapp/connect/Configurator.php"
rm -rfv "$DIST/xapp/connect/FakePlugin.php"
rm -rfv "$DIST/xapp/connect/joomla"
rm -rfv "$DIST/xapp/connect/Index.php"
rm -rfv "$DIST/xapp/connect/auth"
rm -rfv "$DIST/xapp/connect/CustomTypeManager.php"
rm -rfv "$DIST/xapp/connect/Indexer.php"

rm -rfv "$DIST/xapp/templates"
rm -rfv "$DIST/xapp/serviceRouter.php"
rm -rfv "$DIST/xapp/postBuild.php"
rm -rfv "$DIST/xapp/includesTest.php"
rm -rfv "$DIST/xapp/includesMainWP.php"
rm -rfv "$DIST/xapp/wpcincludes.php"
rm -rfv "$DIST/xapp/indexTest.php"
rm -rfv "$DIST/xapp/Tpl.php"
rm -rfv "$DIST/xapp/TplNew.php"
rm -rfv "$DIST/xapp/jincludes.php"
rm -rfv "$DIST/xapp/SchemaFuncs.php"
rm -rfv "$DIST/xapp/SchemaFuncsDate.php"
rm -rfv "$DIST/xapp/SchemaFuncsJoomla.php"
rm -rfv "$DIST/xapp/SchemaProcessor.php"
rm -rfv "$DIST/xapp/SQL2JSONService.php"
rm -rfv "$DIST/xapp/conf.inc.debug.php"
rm -rfv "$DIST/xapp/conf.inc.debug.wp.php"
rm -rfv "$DIST/xapp/conf.inc.php"
rm -rfv "$DIST/xapp/plugins-enabled"
rm -rfv "$DIST/xapp/conf.inc.release.php"
rm -rfv "$DIST/xapp/conf.inc.release.wp.php"
rm -rfv "$DIST/xapp/conf.joomla.php"
rm -rfv "$DIST/xapp/index.php"
rm -rfv "$DIST/conf/custom.php"
rm -rfv "$DIST/xideve"


rm -rfv "$DIST/xapp/includes.php"
rm -rfv "$DIST/xapp/ISchemaProcessor.php"


rm -rfv "$DIST/client/src/xfile/xwordpress"
rm -rf "$DIST/client/src/xfile/dojo/dojowp.js"
rm -rf "$DIST/client/src/xfileBuild/"
rm -rf "$DIST/client/src/xfileTheme/"
rm -rf "$DIST/client/src/css/"
rm -rf "$DIST/client/src/xfile/theme"
rm -rf "$DIST/client/src/themes"
rm -rf "$DIST/client/src/*.sh"
rm -rf "$DIST/client/src/xfile/davinci"
rm -rf "$DIST/client/src/xfile/orion"
rm -rf "$DIST/client/src/xfile/system"
rm -rf "$DIST/client/src/xfile/xide/ve"
rm -rf "$DIST/client/src/xfile/davinci"



rm -rf "$DIST/utils/"
rm -rf "$DIST/misc/"
rm -rf "$DIST/build/"
rm -rf "$DIST/xapp/lib/cache"
rm -rf "$DIST/xapp/lib/core"
rm -rf "$DIST/xapp/lib/html"
#rm -rf "$DIST/xapp/lib/json"
rm -rf "$DIST/xapp/lib/tpl"
rm -rf "$DIST/xapp/lib/ctypes"
rm -rf "$DIST/xapp/ctypes"
rm -rf "$DIST/xapp/lib/db"
rm -rf "$DIST/xapp/lib/joomla/"
rm -rf "$DIST/xapp/lib/wordpress/"
rm -rf "$DIST/xapp/lib/service"
rm -rf "$DIST/xapp/lib/Nette"
rm -rf "$DIST/xapp/.htaccess"
rm -rf "$DIST/xapp/Doc"
rm -rf "$DIST/xapp/xas"
rm -rf "$DIST/xapp/Protocol"
rm -rf "$DIST/xapp/Sync"
rm -rf "$DIST/xapp/Tcp"
rm -rf "$DIST/xapp/Messaging"
rm -rf "$DIST/xapp/Build"
rm -rf "$DIST/xapp/xcf"
rm -rf "$DIST/xapp/xas"
rm -rf "$DIST/xapp/tests"
rm -rf "$DIST/xapp/lib/joomla"
rm -rf "$DIST/xapp/lib/nette"
rm -rf "$DIST/xapp/lib/League"
rm -rf "$DIST/xapp/Build"
rm -rf "$DIST/xapp/Protocol"
rm -rf "$DIST/xapp/Sync"
rm -rf "$DIST/xapp/Tcp"
rm -rf "$DIST/xapp/VFS/tests"
rm -rf "$DIST/xapp/VFS/Doc"
rm -rf "$DIST/xapp/lib/service"
rm -rf "$DIST/xapp/xas/"
rm -rf "$DIST/DIST/"
rm -rf "$DIST/xapp/.htaccess"
rm -rf "$DIST/site/views"
rm -rf "$DIST/site/conf"
rm -rf "$DIST/admin/config.bak.xml"
rm -rf "$DIST/views"
rm -rf "$DIST/admin/config.bak.xml"
rm -rf "$DIST/server/xcms/storage/JsonStoreJSONPathBackup.php"
rm -rf "$DIST/xapp/connect/screen*"
rm -rf "$DIST/client/src/themes/jquery-ui-less"


cp -rf "$SRC_DIR/xapp/VFS/vendor/" "$DIST/xapp/VFS/vendor"
rm -rf "$DIST/xapp/VFS/vendor/google"
rm -rf "$DIST/xapp/VFS/vendor/sabre/dav/.git"
rm -rf "$DIST/xapp/VFS/vendor/sabre/dav/bin"
rm -rf "$DIST/xapp/VFS/vendor/sabre/dav/examples"
rm -rf "$DIST/xapp/VFS/vendor/sabre/dav/tests"

rm -rf "$DIST/xapp/VFS/vendor/sabre/vobject/.git"
rm -rf "$DIST/xapp/VFS/vendor/sabre/vobject/bin"
rm -rf "$DIST/xapp/VFS/vendor/sabre/vobject/examples"
rm -rf "$DIST/xapp/VFS/vendor/sabre/vobject/tests"

rm -rf "$DIST/blox.xblox"
rm -rf "$DIST/desktop.cfhtml"
rm -rf "$DIST/snippets"
rm -rf "$DIST/client/src/*.sh"
rm -rf "$DIST/client/src/xfile/xideve"




rm -rf "$DIST/xapp/VFS/vendor/dropbox/dropbox-sdk/test"
rm -rf "$DIST/xapp/VFS/vendor/dropbox/dropbox-sdk/examples"

rm -rf "$DIST/xapp/VFS/vendor/phpseclib/phpseclib/tests"
rm -rf "$DIST/xapp/VFS/vendor/phpseclib/phpseclib/.git"
rm -rf "$DIST/xapp/VFS/vendor/phpseclib/phpseclib/build"
rm -rf "$DIST/xapp/VFS/vendor/phpseclib/phpseclib/travis"

rm -rf "$DIST/xapp/VFS/vendor/symfony/event-dispatcher/Symfony/Component/EventDispatcher/.git"
rm -rf "$DIST/xapp/VFS/vendor/symfony/event-dispatcher/Symfony/Component/EventDispatcher/Tests"
rm -rf "$DIST/xapp/VFS/vendor/symfony/yaml/Symfony/Component/Yaml/.git"
rm -rf "$DIST/xapp/VFS/vendor/symfony/yaml/Symfony/Component/Yaml/Tests"
rm -rf "$DIST/xapp/VFS/vendor/xapp/xflysystem/tests"
rm -rf "$DIST/xapp/VFS/vendor/xapp/xflysystem/.git"


mkdir "$DIST/logs"
touch "$DIST/logs/all.log"
cd "$DIST"

find . -name *.git* -exec rm -rf '{}' ';'
find . -name .idea -exec rm -rf '{}' ';'


zip -9 -q -r "xbox.zip" ./*
#cp -f "xbox.zip" "/var/www/vhosts/pearls-media.com/httpdocs/xbox.zip"
#chmod 755 "/var/www/vhosts/pearls-media.com/httpdocs/xbox.zip"

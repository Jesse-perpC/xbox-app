PHP/JS based and full featured file manager
===========================================

##Features
 
 - Full keyboard support ala Midnight or Total-Commander 
 - Multi tab 
 - Code editor with auto-completion for CSS,PHP and Javascript 
 - Multi selection
 - Advanced search
 - Drag’n drop for copy, move and upload into any panel
 - Standard actions : Edit, Move, Rename, Info, Delete,Compress and Download
 - 2 image editors : Pixlr and Aviary
 - Javascript & Bash Shell
 - Built- in Javascript and Bash shell
 - Basic support for SFTP, FTP, WEBDAV, DROPBOX
 - 4 display modes for file panels : thumbnails, tree, list, preview, split horizontal and split vertical
 - 3 main layouts : Dual panel, single panel and ‘preview’, ideal for media browsing
 - Supports folder locations outside of the Apache http docs folder
 - Logging panel with filters
 - Over 20 themes for the file manager and 20 editor themes
 - Visual programming language for extending the plugin easier. Open test/blox.xblox example file (this feature is pre alpha!)
 - Strong security using signed client call similar to oauth. You can limit the access to IP and domains

##Status

Little unstable! There is still a lot of old and rubbish code to be removed. However, this project is under active development and not yet official released.


##Screenshots

[See here] (misc/screenshots/SCREENSHOTS.md)

##Demos

[See here a dedicated demo page] (http://pearls-media.com:89/demo)


##Important

This a development version. It has many sub modules and needs around 1GB on the disc. You may download a pre-built version from here(@TODO add link) 

## Requirements 

- PHP 5.3+ (better 5.4!)

## Installation 

### Soft Checkout (Uses pre-compiled Javascript version)

``` bash 
    git clone https://github.com/mc007/xbox-app
    cd xbox-app
    git submodules init
```

### Full Checkout (Checks out full tree: 1GB+)

``` bash 
    git clone --recursive https://github.com/mc007/xbox-app    
```

### Usage

Navigate on your web server to : http://localhost/xbox-app/index.php

Open in different layout modes 

index.php?layout=single : Single panel

index.php?layout=dual : Dual panel

index.php?layout=preview:  Preview layout (split view with media preview)

index.php?layout=preview&theme=dot-luv : Preview layout in dark theme (split view with media preview)

index.php?layout=preview&open=Pictures : Auto open picture folder in preview mode (split view with media preview)

index.php?layout=gallery&open=BurningMan&minimal=true&theme=dot-luv : Auto open picture folder in gallery mode (split view with cover flow view)

index.php?layout=browser&open=Pictures : Auto open picture folder in browser mode (Dual view with tree for navigation, classics!)

  
### Open debug version 

http://localhost/xbox-app/index.php?debug=true

### Build Javascript main file

``` bash
    cd client/src
    sh buildstandalone.sh    
```
This will create single layer file which contains all Dojo based in src/xfile/dojo/xbox.js!

### Resources (Javascript/CSS/Fonts,...)

Client-Debug version : see in client/src/lib/xbox/resources-debug.json

Client-Release version : see in client/src/xfile/xbox/resources-release.json


### The Index.html 

There is no such thing! HTML related parts are pulled through the resource configuration mentioned in "Resources" above.
This technique has been proven for us since many years in many projects as we develop authoring software and those resources
needed to be managed in a more fashioned manner. However,

the HEAD comes from:

Client-Debug version : client/src/lib/xbox/Header.js

Client-Release version : client/src/xfile/xbox/Header.js


the BODY part comes from:

Client-Debug version : client/src/lib/xbox/index.html

Client-Release version : client/src/xfile/xbox/index.html




### Update 

cd xbox-app
git submodule foreach git pull origin master

# Contribute

open a Github issue and let me know :-)


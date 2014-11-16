PHP/JS based and full featured file manager
===========================================

#Features
 
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
 - Visual programming language for extending the plugin easier. Open blox.xblox example file.
 - Strong security using signed client call similar to oauth. You can limit the access to IP and domains

#Screenshots

[See here] (misc/screenshots/SCREENSHOTS.md)


#Important

This a development version. It has many sub modules and needs around 1GB on the disc. You may download a pre-built version from here(@TODO add link) 

# Installation 

## Soft Checkout (Uses pre-compiled Javascript version)

``` bash 
    git clone https://github.com/mc007/xbox-app
    cd xbox-app
    git submodules init
```

## Full Checkout (Checks out full tree: 1GB+)

``` bash 
    git clone --recursive https://github.com/mc007/xbox-app    
```


## Update 

1. git submodule foreach git pull origin master

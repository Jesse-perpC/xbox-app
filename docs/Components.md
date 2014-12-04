
https://github.com/mc007/xjs/blob/master/src/lib/xide/model/Component.js
https://github.com/mc007/xjs/blob/master/src/lib/xide/manager/PluginManager.js

Example component: https://github.com/mc007/xjs/blob/master/src/lib/xide/ve/component.js

 this.ctx.getPluginManager().loadComponent('xblox',null,{}).then(function(){
    this.onXBlocksReady();    
}.bind(this));

.getPluginManager().loadComponent('../../xide/ve/component',null,{
    cmdOffset:'xapp/xide/',
    userBaseUrl:workspaceUrl
}).then(function(){



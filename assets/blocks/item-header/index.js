(()=>{"use strict";const e=window.React,r=window.wp.blocks,t=window.wp.blockEditor,i=window.wp.components,o=window.wp.i18n,d=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"bp/item-header","title":"BuddyPress header","category":"theme","icon":"id","description":"Displays the header of a directory or a single item.","textdomain":"buddypress","supports":{"align":["left","right","center","wide","full"],"html":false,"spacing":{"margin":true,"padding":true}},"editorScript":"file:index.js"}');(0,r.registerBlockType)(d,{icon:{background:"#fff",foreground:"#d84800",src:"id"},edit:()=>{const r=(0,t.useBlockProps)();return(0,e.createElement)("div",{...r},(0,e.createElement)(i.Placeholder,{className:"block-editor-bp-placeholder bp-header",label:(0,o.__)("Directory or item header","buddypress")}))},save:()=>null})})();
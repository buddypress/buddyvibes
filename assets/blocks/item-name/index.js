(()=>{"use strict";const e=window.React,t=window.wp.blocks,s=window.wp.blockEditor,n=window.wp.components,a=window.wp.i18n,i=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"bp/item-name","title":"BuddyPress item name","category":"theme","icon":"nametag","description":"Displays the name of a BuddyPress item.","textdomain":"buddypress","usesContext":["itemId","itemType"],"attributes":{"isLink":{"type":"boolean","default":false}},"supports":{"align":["left","right","center"],"html":false,"reusable":false,"spacing":{"margin":true,"padding":true}},"editorScript":"file:index.js"}');(0,t.registerBlockType)(i,{icon:{background:"#fff",foreground:"#d84800",src:"nametag"},edit:()=>{const t=(0,s.useBlockProps)();return(0,e.createElement)("div",{...t},(0,e.createElement)(n.Placeholder,{className:"block-editor-bp-placeholder bp-name",label:(0,a.__)("BuddyPress item name","buddypress")}))},save:()=>null})})();
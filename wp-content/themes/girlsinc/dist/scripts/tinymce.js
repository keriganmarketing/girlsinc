!function(){tinymce.create("tinymce.plugins.Girlsinc",{init:function(i,n){i.addButton("highlight",{title:"Highlight Text",cmd:"highlight",icon:"highlight-icon"}),i.addCommand("highlight",function(){var n='<span class="girlsinc-title-ui">'+i.selection.getContent()+"</span>";i.execCommand("mceInsertContent",0,n)})}}),tinymce.PluginManager.add("girlsinc",tinymce.plugins.Girlsinc)}();
//# sourceMappingURL=tinymce.js.map

//Custom TinyMCE Buttons
(function() {
    tinymce.create('tinymce.plugins.Girlsinc', {
        init : function(ed, url) {
            ed.addButton('highlight', {
                title : 'Highlight Text',
                cmd : 'highlight',
                icon : 'highlight-icon'
            });

            ed.addCommand('highlight', function() {
                var return_text = '<span class="girlsinc-title-ui">' + ed.selection.getContent() + '</span>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        }
    });

    // Register plugin
    tinymce.PluginManager.add('girlsinc', tinymce.plugins.Girlsinc);
})();
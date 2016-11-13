(function() {  
    tinymce.create('tinymce.plugins.testimonial', {  
        init : function(ed, url) {  
            ed.addButton('testimonial', {  
                title : 'Add a testimonial',  
                image : url+'/img/button.png',  
                onclick : function() {  
                     ed.selection.setContent('[testimonial name="John Doe" about="About John Doe section goes here" url="http://johndoe.com" image="http://johndoe.com/link-to-an-image.jpg"]' + ed.selection.getContent() + '[/testimonial]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);  
})();
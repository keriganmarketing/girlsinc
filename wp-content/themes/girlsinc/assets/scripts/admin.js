jQuery(function($){
    $(".update-spotlight-id").click(function(e){
        e.preventDefault();
        var self = $(this);
        var id = self.attr("data-post-id");
        var data = {
            'action': 'update_spotlight',
            'ID': id
        };
        jQuery.post(Marc.ajax_url, data, function(response) {
            $(".update-spotlight-id").not(self).find(".dashicons-star-filled").removeClass("dashicons-star-filled").addClass("dashicons-star-empty");
            if(self.is(".icon-empty")){
                self.find(".dashicons-star-empty").removeClass("dashicons-star-empty").addClass("dashicons-star-filled");
                self.removeClass("icon-empty").addClass("icon-filled");
            }
            else{
                self.find(".dashicons-star-filled").removeClass("dashicons-star-filled").addClass("dashicons-star-empty");
                self.removeClass("icon-filled").addClass("icon-empty");
            }
        });
    });
});
/*
(function($)
{
	$(document).ready(function()
	{

        $('#modalQuestion form').submit(function(event){
            event.preventDefault();
            var url = $(this).attr('action');
            alert(url);
			var form = $(this);
            $('#modalQuestion .modal-request').fadeOut(200, function(){
                $('#modalQuestion .loader').fadeIn(200, function(){
                    var posting = $.post(url, form.serialize());
                    posting.done(function(data){
                        $('#modalQuestion').find('.loader').fadeOut(200, function(){
                            $('#modalQuestion .modal-response').fadeIn(200);
                            $('#modalQuestion .close-modal').fadeIn(200);
                        });
                    });
                });
            });
            $('#modalQuestion button[type="submit"]').fadeOut(200);
        });
        
	});
})(jQuery);
*/
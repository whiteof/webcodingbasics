(function($)
{
	$(document).ready(function()
	{

        $('#modalFree form').submit(function(event){
            event.preventDefault();
            var url = $(this).attr('action');
			var form = $(this);
            $('#modalFree .modal-request').fadeOut(200, function(){
                $('#modalFree .loader').fadeIn(200, function(){
                    var posting = $.post(url, form.serialize());
                    posting.done(function(data){
                        $('#modalFree').find('.loader').fadeOut(200, function(){
                            $('#modalFree .modal-response').fadeIn(200);
                            $('#modalFree .close-modal').fadeIn(200);
                        });
                    });
                });
            });
            $('#modalFree button[type="submit"]').fadeOut(200);
        });
        
	});
})(jQuery);
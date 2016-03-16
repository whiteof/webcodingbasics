/**
 * @package     Joomla.Site
 * @subpackage  Templates.custom
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

(function($)
{
	$(document).ready(function()
	{
		$('*[rel=tooltip]').tooltip()

		// Turn radios into btn-group
		$('.radio.btn-group label').addClass('btn');
		$(".btn-group label:not(.active)").click(function()
		{
			var label = $(this);
			var input = $('#' + label.attr('for'));

			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
				if (input.val() == '') {
					label.addClass('active btn-primary');
				} else if (input.val() == 0) {
					label.addClass('active btn-danger');
				} else {
					label.addClass('active btn-success');
				}
				input.prop('checked', true);
			}
		});
		$(".btn-group input[checked=checked]").each(function()
		{
			if ($(this).val() == '') {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
			} else if ($(this).val() == 0) {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
			} else {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
			}
		});
		
		
		// Custom tamplate
		$('.description-navigation .nav-button a').hover(
			function() {
				$(this).children('img').data('default', $(this).children('img').attr('src'));
				$(this).children('img').attr('src', $(this).children('img').data('active'));
			}, function() {
				$(this).children('img').attr('src', $(this).children('img').data('default'));
			}
		);
		
		// Side bar navigation
		$('#sidebar .parent-item').click(function(event){
			event.preventDefault();
			var link_obj = $(this);
			if ($(this).hasClass('collapsed')) {
				$(this).next('ul').slideDown(300, function(){
					link_obj.removeClass('collapsed');
				});
            }else {
				$(this).next('ul').slideUp(300, function(){
					link_obj.addClass('collapsed');
				});
			}
		});
		
		// Scroll to the current menu item
		if (typeof($('#sidebar li.parent li.parent li.current.active').position()) != 'undefined') {
            $('#sidebar .bar').scrollTop($('#sidebar .bar').scrollTop() + $('#sidebar li.parent li.parent li.current.active').position().top);
        }
				
	})
})(jQuery);
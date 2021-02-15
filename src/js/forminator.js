(function($){
	$(function(){
		if (typeof ($.fn.forminatorLoader) === 'undefined') {
			// nothing to do here
		} else {
			let _selects = $('.forminator-select');
			if( _selects.length ){
				_selects.each(function(){
					FUI.select( $(this) );
				});
			}
			// support ajax form
			$(document).on('after.load.forminator', function(e, _form_id){
				let _form = $('#forminator-module-'+ _form_id),
						_selects = _form.find('.forminator-select');

				if( _selects.length ){
					_selects.each(function(){
						FUI.select( $(this) );
					});
				}
			});
		}
	});
})(window.jQuery)
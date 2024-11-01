(function ($) {
	$(document).ready(function() {
		$('input[name="money"]').on('keyup', function(){
		    var n = parseInt($(this).val().replace(/\D/g,''),10);
		    $(this).val(n.toLocaleString("en-US"));
		});

		$('.wip-show').on('click', function(event) {
			var price = $(this).data('price');
			$('body').find('[name=money]').val(price);

			$('#wip-modal').modal('show');
			$('#wip-modal .modal-response').empty();
		})
		$('#form').submit(function(event) {	
			var that = $(this),
				url = wip_ajax.ajaxurl,
				method = that.attr('method'),
				data = {
					'action': 'process_form',
				};
			that.find('[name]').each(function(index, value) {
				var that = $(this),
					name = that.attr('name'),
					value = that.val();
					data[name] = value;
			});
			console.log(data);
			$.ajax({
				url: url,
				type: method,
				data: data,
			})
			.done(function(response) {
				$('#wip-modal .modal-response').empty();
				$('#wip-modal .modal-response').append(response);
			});
			event.preventDefault();			
		});
	})
})(jQuery)
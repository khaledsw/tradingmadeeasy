<div class="acr-info-bar">
	<div class="pull-right">
		<a class="btn btn-default" id="abandoned-carts-refresh" data-toggle="tooltip" title="<?php echo $button_refresh; ?>"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default" onclick="generateReminder('send');" data-toggle="tooltip" title="<?php echo $button_send_all; ?>"><i class="fa fa-mail-forward"></i></a>
	</div>
	<div class="acr-info-message"><i class="fa fa-fw fa-info"></i> <?php echo $text_send_all; ?></div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
	  <thead>
		<tr>
		  <td class="text-left"><?php echo $column_customer; ?></td>
		  <td class="text-center"><?php echo $column_cart_content; ?></td>
		  <td class="text-center"><?php echo $column_last_visit; ?></td>
		  <td class="text-center"><?php echo $column_action; ?></td>
		</tr>
	  </thead>
	  <tbody>
		<?php if ($reminders) { ?>
		<?php foreach ($reminders as $reminder) { ?>
		<tr>
		  <td class="text-left"><?php echo strtoupper($reminder['firstname'] . ' ' . $reminder['lastname']); ?><br /><?php echo $reminder['email']; ?><br /><?php echo $reminder['telephone']; ?></td>
		  <td class="text-left">
			<?php if ($reminder['cart_products']) { ?>
			<div class="table-responsive">
				<table class="table table-bordered">
				<?php foreach($reminder['cart_products'] as $product) { ?>
					<tr>
						<td><img src="<?php echo $product['image']; ?>" /></td>
						<td><?php echo $product['name']; ?>
						<?php foreach ($product['options'] as $option) { ?>
						<br />
						&nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
						<?php } ?>
						</td>
						<td> x <?php echo $product['quantity']; ?></td>	
					</tr>
				<?php } ?>
				</table>
			</div>	
			<?php } ?>
		  </td>
		  <td class="text-center"><?php echo $reminder['last_action']; ?></td>
		  <td class="text-center">
			<a onclick="generateReminder('preview', <?php echo $reminder['customer_id']; ?>);" data-toggle="tooltip" title="<?php echo $button_preview; ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
			<a onclick="generateReminder('send', <?php echo $reminder['customer_id']; ?>);" data-toggle="tooltip" title="<?php echo $button_send; ?>" class="btn btn-default"><i class="fa fa-send-o"></i></a>
		  </td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr>
		  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>
<script type="text/javascript"><!--
$('#abandoned-carts-refresh').on('click', function() {	
	// add loading spinner
	$('#abandoned-cart-list').html('<div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div>');
	
	// load new list
	$('#abandoned-cart-list').load('index.php?route=module/abandoned_cart_reminder/getAbandonedCarts&token=<?php echo $token; ?>');
});

function generateReminder(operation, customer_id){
	customer_id = typeof(customer_id) != 'undefined' ? customer_id : 0;  // 0 = send to all customers with cart abandoned
	
	$('#modal-acr').remove();
	
	var iframe_url = '<?php echo $front_base_url; ?>index.php?route=cron/abandoned_cart_reminder&secret_code=<?php echo $abandoned_cart_reminder_secret_code; ?>&op_type=' + operation;
	
	if (customer_id != 0) {
		iframe_url += '&filter_customer_id=' + customer_id;
	}	
	
	modal_html  = '<div id="modal-acr" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">';
	modal_html += '	  <div class="modal-dialog">';
	modal_html += '	     <div class="modal-content">';
	modal_html += '	        <div class="modal-header">';
	modal_html += '            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>';
	modal_html += '            <h4 class="modal-title">' + ((operation == "send")? '<?php echo addslashes($text_reminder_send); ?>' : '<?php echo addslashes($text_reminder_preview); ?>' ) + '</h4>';
	modal_html += '         </div>';
	modal_html += '         <div class="modal-body">';
	modal_html += '            <iframe id="acr-iframe" src="" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe>';
	modal_html += '         </div>';
	modal_html += '      </div>';
	modal_html += '   </div>';
	modal_html += '</div>';
	
	$('body').append(modal_html);

	$('#modal-acr').on('show.bs.modal', function() {
		$('#acr-iframe').attr('src', iframe_url);
	});	
	
	$('#modal-acr').modal('show');
	
	$('#modal-acr').on('hide.bs.modal', function() {
		$('#acr-iframe').attr('src', '');
		
		if (operation == "send") {
			$('#abandoned-cart-list').html('<div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div>');
			$('#abandoned-cart-list').load('index.php?route=module/abandoned_cart_reminder/getAbandonedCarts&token=<?php echo $token; ?>');
			
			$('#abandoned-cart-history').html('<div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div>');
			$('#abandoned-cart-history').load('index.php?route=module/abandoned_cart_reminder/getRemindersHistory&token=<?php echo $token; ?>');
		}
	});	
}
//--></script>
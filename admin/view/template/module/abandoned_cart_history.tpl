<div class="well">
  <div class="row">
	<div class="col-sm-4">	
	  <div class="form-group">
		  <label class="control-label" for="input-filter-customer"><?php echo $entry_customer; ?></label>
		  <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-filter-customer" class="form-control" />
	  </div>
	</div>
	<div class="col-sm-4">	
	  <div class="form-group">
		  <label class="control-label" for="input-filter-coupon-code"><?php echo $entry_coupon_code; ?></label>
		  <input type="text" name="filter_coupon_code" value="<?php echo $filter_coupon_code; ?>" placeholder="<?php echo $entry_coupon_code; ?>" id="input-filter-coupon-code" class="form-control" />
	  </div>
	</div>	
	<div class="col-sm-4">	
	  <div class="form-group">
		<label class="control-label" for="input-filter-date-added"><?php echo $entry_date_sent; ?></label>
		<div class="input-group date">
		  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_sent; ?>" data-date-format="YYYY-MM-DD" id="input-filter-date-added" class="form-control" />
		  <span class="input-group-btn">
		  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
		  </span></div>
	  </div>
      <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>		  
	</div>	
  </div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
	  <thead>
		<tr>
		  <td class="text-left"><?php echo $column_customer; ?></a></td>
		  <td class="text-left"><?php echo $column_coupon_code; ?></a></td>
		  <td class="text-center"><?php echo $column_coupon_used; ?></a></td>
		  <td class="text-center"><?php echo $column_date_sent; ?></a></td>
		  <td class="text-center"><?php echo $column_action; ?></a></td>
		</tr>
	  </thead>
	  <tbody>
		<?php if ($reminders) { ?>
		<?php foreach ($reminders as $reminder) { ?>
		<tr>
		  <td class="text-left"><?php echo $reminder['customer_name']; ?><br /><?php echo $reminder['telephone']; ?></td>
		  <td class="text-left"><?php echo $reminder['coupon_code']; ?></td>
		  <td class="text-center"><?php echo $reminder['coupon_used']; ?></td>
		  <td class="text-center"><?php echo $reminder['date_sent']; ?></td>
		  <td class="text-center"><a class="btn btn-default" onclick="getReminderEmail(<?php echo $reminder['acr_history_id']; ?>);" data-toggle="tooltip" title="<?php echo $button_view_reminder; ?>"><i class="fa fa-eye"></i></a></td>		  
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr>
		  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=module/abandoned_cart_reminder/getRemindersHistory&token=<?php echo $token; ?>';
	
	var filter_customer = $('input[name=\'filter_customer\']').val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_coupon_code = $('input[name=\'filter_coupon_code\']').val();
	
	if (filter_coupon_code) {
		url += '&filter_coupon_code=' + encodeURIComponent(filter_coupon_code);
	}	
	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
				
	// add loading spinner
	$('#abandoned-cart-history').html('<div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div>');
	
	// load new list
	$('#abandoned-cart-history').load(url);
});

$('#abandoned-cart-history .pagination a').on('click', function() {
	$('#abandoned-cart-history').html('<div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div>');
	$('#abandoned-cart-history').load(this.href);
	
	return false;
});

function getReminderEmail(acr_history_id){
	$('#modal-acr').remove();
	
	var iframe_url = '<?php echo $front_base_url; ?>index.php?route=cron/abandoned_cart_reminder/getHistoryEmail&secret_code=<?php echo $abandoned_cart_reminder_secret_code; ?>&acr_history_id=' + acr_history_id;	
	
	modal_html  = '<div id="modal-acr" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">';
	modal_html += '	  <div class="modal-dialog">';
	modal_html += '	     <div class="modal-content">';
	modal_html += '	        <div class="modal-header">';
	modal_html += '            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>';
	modal_html += '            <h4 class="modal-title"><?php echo addslashes($text_reminder_message); ?></h4>';
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
	});	
}

$('.date').datetimepicker({
	pickTime: false
});
//--></script>
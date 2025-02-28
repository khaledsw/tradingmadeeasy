<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-acr-settings" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
	  </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div id="total-recovered"></div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-acr-settings" class="form-horizontal">
			<ul class="nav nav-tabs" id="tabs">
				<li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-fw fa-wrench"></i> <?php echo $tab_setting; ?></a></li>
				<li><a href="#tab-coupon" data-toggle="tab"><i class="fa fa-fw fa-ticket"></i> <?php echo $tab_coupon; ?></a></li>
				<li><a href="#tab-email" data-toggle="tab"><i class="fa fa-fw fa-envelope"></i> <?php echo $tab_email; ?></a></li>
				<li><a href="#tab-abandoned-cart" data-toggle="tab"><i class="fa fa-fw fa-shopping-cart"></i> <?php echo $tab_abandoned_cart; ?></a></li>
				<li><a href="#tab-history" data-toggle="tab"><i class="fa fa-fw fa-bars"></i> <?php echo $tab_history; ?></a></li>
				<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-fw fa-question"></i> <?php echo $tab_help; ?></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab-setting">  
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-secret-code"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_secret_code; ?>"><?php echo $entry_secret_code;?></span></label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key"></i></span>	
								<input type="text" name="abandoned_cart_reminder_secret_code" placeholder="<?php echo $entry_secret_code; ?>" id="input-secret-code" value="<?php echo $abandoned_cart_reminder_secret_code; ?>" class="form-control" />
							</div>
							<?php if ($error_secret_code) { ?>
							<div class="text-danger"><?php echo $error_secret_code; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-delay"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_delay; ?>"><?php echo $entry_delay;?></span></label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" name="abandoned_cart_reminder_delay" placeholder="<?php echo $entry_delay; ?>" id="input-delay" value="<?php echo $abandoned_cart_reminder_delay; ?>" class="form-control" />
								<span class="input-group-addon"><?php echo $text_hours; ?></span>
							</div>
							<?php if ($error_delay) { ?>
							<div class="text-danger"><?php echo $error_delay; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-max-reminders"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_max_reminders; ?>"><?php echo $entry_max_reminders;?></span></label>
						<div class="col-sm-10">
							<input type="text" name="abandoned_cart_reminder_max_reminders" placeholder="<?php echo $entry_max_reminders; ?>" id="input-max-reminders" value="<?php echo $abandoned_cart_reminder_max_reminders; ?>" class="form-control" />
							<?php if ($error_max_reminders) { ?>
							<div class="text-danger"><?php echo $error_max_reminders; ?></div>
							<?php } ?>
						</div>
					</div>							
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-hide-out-stock"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_hide_out_stock; ?>"><?php echo $entry_hide_out_stock; ?></span></label>
						<div class="col-sm-10">
							<select name="abandoned_cart_reminder_hide_out_stock" id="input-hide-out-stock" class="form-control">
								<?php if ($abandoned_cart_reminder_hide_out_stock) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-use-html-email"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_use_html_email; ?>"><?php echo $entry_use_html_email; ?></span></label>
						<div class="col-sm-10">
							<select name="abandoned_cart_reminder_use_html_email" id="input-use-html-email" class="form-control">
								<?php if ($abandoned_cart_reminder_use_html_email) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>						
				</div>

				<div class="tab-pane" id="tab-coupon">
					<div class="tab-content">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-add-coupon"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_add_coupon; ?>"><?php echo $entry_add_coupon; ?></span></label>
							<div class="col-sm-10">
								<select name="abandoned_cart_reminder_add_coupon" id="input-add-coupon" class="form-control">
									<?php if ($abandoned_cart_reminder_add_coupon) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-coupon-type"><?php echo $entry_coupon_type; ?></label>
							<div class="col-sm-10">
								<select name="abandoned_cart_reminder_coupon_type" id="input-coupon-type" class="form-control">
									<?php if ($abandoned_cart_reminder_coupon_type) { ?>
									<option value="1" selected="selected"><?php echo $text_percent; ?></option>
									<option value="0"><?php echo $text_fixed; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_percent; ?></option>
									<option value="0" selected="selected"><?php echo $text_fixed; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="form-group required acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-coupon-amount"><?php echo $entry_coupon_amount;?></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="abandoned_cart_reminder_coupon_amount" placeholder="<?php echo $entry_coupon_amount; ?>" id="input-coupon-amount" value="<?php echo $abandoned_cart_reminder_coupon_amount; ?>" class="form-control" />
									<span class="input-group-addon acr-coupon-type"></span>
								</div>
								<?php if ($error_coupon_amount) { ?>
								<div class="text-danger"><?php echo $error_coupon_amount; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-coupon-total"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_coupon_total; ?>"><?php echo $entry_coupon_total;?></span></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="abandoned_cart_reminder_coupon_total" placeholder="<?php echo $entry_coupon_total; ?>" id="input-coupon-total" value="<?php echo $abandoned_cart_reminder_coupon_total; ?>" class="form-control" />
									<span class="input-group-addon"><?php echo $currency_symbol; ?></span>
								</div>	
							</div>
						</div>	
						<div class="form-group acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-coupon-usage"><?php echo $entry_coupon_usage; ?></label>
							<div class="col-sm-10">
								<select name="abandoned_cart_reminder_coupon_usage" id="input-coupon-usage" class="form-control">
									<?php if ($abandoned_cart_reminder_coupon_usage) { ?>
									<option value="1" selected="selected"><?php echo $text_all_products; ?></option>
									<option value="0"><?php echo $text_cart_products; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_all_products; ?></option>
									<option value="0" selected="selected"><?php echo $text_cart_products; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group required acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-coupon-expire"><?php echo $entry_coupon_expire;?></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="abandoned_cart_reminder_coupon_expire" placeholder="<?php echo $entry_coupon_expire; ?>" id="input-coupon-expire" value="<?php echo $abandoned_cart_reminder_coupon_expire; ?>" class="form-control" />
									<span class="input-group-addon"><?php echo $text_days; ?></span>
								</div>
								<?php if ($error_coupon_expire) { ?>
								<div class="text-danger"><?php echo $error_coupon_expire; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required acr-coupon-enabled">
							<label class="col-sm-2 control-label" for="input-reward-limit"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_reward_limit; ?>"><?php echo $entry_reward_limit;?></span></label>
							<div class="col-sm-10">
								<input type="text" name="abandoned_cart_reminder_reward_limit" placeholder="<?php echo $entry_reward_limit; ?>" id="input-reward-limit" value="<?php echo $abandoned_cart_reminder_reward_limit; ?>" class="form-control" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab-email">
					<div class="tab-content">
						<ul class="nav nav-tabs" id="languages">
							<?php foreach ($languages as $language) { ?>
							<li><a data-toggle="tab" href="#language-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
							<?php } ?>
						</ul>
							
						<?php foreach ($languages as $language) { ?>
						<div id="language-<?php echo $language['language_id']; ?>" class="tab-pane">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-subject-<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></span></label>
								<div class="col-sm-10">
									<input name="abandoned_cart_reminder_mail[<?php echo $language['language_id']; ?>][subject]" placeholder="<?php echo $entry_subject; ?>" id="input-subject-<?php echo $language['language_id']; ?>" value="<?php echo isset($abandoned_cart_reminder_mail[$language['language_id']]) ? $abandoned_cart_reminder_mail[$language['language_id']]['subject'] : ''; ?>" class="form-control" />
									<?php if (isset($error_subject[$language['language_id']])) { ?>
									<div class="text-danger"><?php echo $error_subject[$language['language_id']]; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="special-keyword-<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_special_keyword; ?>"><?php echo $entry_special_keyword; ?></span></label>
								<div class="col-sm-10">
									<div class="alert alert-info"><?php echo $text_special_keyword; ?></div>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="message-reward-<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_message_reward; ?>"><?php echo $entry_message_reward; ?></span></label>
								<div class="col-sm-10">
									<textarea name="abandoned_cart_reminder_mail[<?php echo $language['language_id']; ?>][message_reward]" placeholder="<?php echo $entry_message_reward; ?>" id="message-reward-<?php echo $language['language_id']; ?>" rows="8"><?php echo isset($abandoned_cart_reminder_mail[$language['language_id']]) ? $abandoned_cart_reminder_mail[$language['language_id']]['message_reward'] : ''; ?></textarea>
									<?php if (isset($error_message_reward[$language['language_id']])) { ?>
									<div class="text-danger"><?php echo $error_message_reward[$language['language_id']]; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="message-no-reward-<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_message_no_reward; ?>"><?php echo $entry_message_no_reward; ?></span></label>
								<div class="col-sm-10">
									<textarea name="abandoned_cart_reminder_mail[<?php echo $language['language_id']; ?>][message_no_reward]" placeholder="<?php echo $entry_message_no_reward; ?>" id="message-no-reward-<?php echo $language['language_id']; ?>" rows="8"><?php echo isset($abandoned_cart_reminder_mail[$language['language_id']]) ? $abandoned_cart_reminder_mail[$language['language_id']]['message_no_reward'] : ''; ?></textarea>
									<?php if (isset($error_message_no_reward[$language['language_id']])) { ?>
									<div class="text-danger"><?php echo $error_message_no_reward[$language['language_id']]; ?></div>
									<?php } ?>
								</div>
							</div>							
						</div>
						<?php } ?>	
					</div>
				</div>	
								
				<div class="tab-pane" id="tab-abandoned-cart">
					<div class="tab-content">
						<div id="abandoned-cart-list"><div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div></div>
					</div>
				</div>				

				<div class="tab-pane" id="tab-history">
					<div class="tab-content">
						<div id="abandoned-cart-history"><div class="acr-loading-spinner"><i class="fa fa-5x fa-spinner fa-spin"></i></div></div>
					</div>
				</div>					
				
				<div class="tab-pane" id="tab-help">
					<div class="tab-content">
						Change Log and HELP Guide is available : <a href="http://www.oc-extensions.com/Abandoned-Cart-Reminder-Pro-Opencart-2.x" target="blank">HERE</a><br /><br />
						If you need support email us at <strong>support@oc-extensions.com</strong> (Please first read help guide) 				
					</div>
				</div>
			</div>
		</form>	
    </div>
  </div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#message-reward-<?php echo $language['language_id']; ?>, #message-no-reward-<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>

$('select[name=\'abandoned_cart_reminder_add_coupon\']').on('change', function(){
	if ($(this).val() == 1) {
		$('.acr-coupon-enabled').show();
	} else {
		$('.acr-coupon-enabled').hide();
	}
});

$('select[name=\'abandoned_cart_reminder_add_coupon\']').trigger('change');

$('select[name=\'abandoned_cart_reminder_coupon_type\']').on('change', function(){
	if ($(this).val() == 1) { // percent
		$('.acr-coupon-type').text("%");
	} else {
		$('.acr-coupon-type').text("<?php echo addslashes($currency_symbol)?>");
	}
});

$('select[name=\'abandoned_cart_reminder_coupon_type\']').trigger('change');

$('#languages li:first-child a').tab('show');

$('.date').datetimepicker({
	pickTime: false
});

// Total recoverd since ACR is used
<?php if ($abandoned_cart_reminder_add_coupon) { ?>
getTotalRecovered();
<?php } ?>

// Ajax load abandoned carts + history -- IF SETTINGS ARE DEFINED
<?php if ($abandoned_cart_reminder_secret_code) { ?> 
$('#abandoned-cart-list').load('index.php?route=module/abandoned_cart_reminder/getAbandonedCarts&token=<?php echo $token; ?>');
$('#abandoned-cart-history').load('index.php?route=module/abandoned_cart_reminder/getRemindersHistory&token=<?php echo $token; ?>');
<?php } ?>

function getTotalRecovered() {
	$.ajax({
		url: 'index.php?route=module/abandoned_cart_reminder/getTotalRecovered&token=<?php echo $token; ?>',
		dataType: 'json',
		success: function(json) {
			if (json['total_recovered']) {
				$('#total-recovered').prepend('<div class="alert alert-info" style="display:none;">' + json['total_recovered'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('#total-recovered .alert').fadeIn('slow');
			}			
		}
	})
}
//--></script></div>
<?php echo $footer; ?>
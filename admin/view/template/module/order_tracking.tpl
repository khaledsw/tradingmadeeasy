<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-order_tracking" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($update) { ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i> <?php echo $update; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?> 
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-order_tracking" class="form-horizontal">
			<ul class="nav nav-tabs" id="tabs">
				<li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-fw fa-wrench"></i> <?php echo $tab_setting; ?></a></li>
				<li><a href="#tab-carrier" data-toggle="tab"><i class="fa fa-fw fa-truck"></i> <?php echo $tab_carrier; ?></a></li>
				<li><a href="#tab-order-comment" data-toggle="tab"><i class="fa fa-fw fa-comments"></i> <?php echo $tab_order_comment; ?></a></li>
				<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-fw fa-question"></i> <?php echo $tab_help; ?></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab-setting">  
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<select name="order_tracking_status" id="input-status" class="form-control">
								<?php if ($order_tracking_status) { ?>
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
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_order_status_shipped; ?></label>
						<div class="col-sm-10">
							<select name="order_tracking_shipped" id="input-status" class="form-control">
								<option value=""></option>
								<?php foreach($order_statuses as $order_status) { ?>
								<?php if ($order_status['order_status_id'] == $order_tracking_shipped) { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
							<?php if ($error_order_status_shipped) { ?>
							<div class="text-danger"><?php echo $error_order_status_shipped; ?></div>
							<?php } ?>
						</div>
					</div>	
				</div>
				
				<div class="tab-pane" id="tab-carrier">
					<div class="tab-content">
						<div class="form-group">
							<div class="col-sm-12">	
								<table id="module" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td class="text-left required"><?php echo $entry_carrier_name; ?></td>
											<td class="text-left required"><?php echo $entry_tracking_url; ?> <span data-toggle="tooltip" data-html="true" title="<?php echo $help_tracking_url; ?>"></span></td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<?php $carrier_row = 0; ?>
										<?php foreach ($carriers as $carrier) { ?>
										<tr id="carrier-row<?php echo $carrier_row; ?>">
											<td class="text-left">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-truck"></i></span>
													<input type="text" name="order_tracking_carriers[<?php echo $carrier_row; ?>][name]" value="<?php echo $carrier['name']; ?>" placeholder="<?php echo $entry_carrier_name; ?>" class="form-control" />
												</div>
												<?php if (isset($error_name[$carrier_row])) { ?>
												<div class="text-danger"><?php echo $error_name[$carrier_row]; ?></div>
												<?php } ?>											
											</td>
											<td class="text-left">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-link"></i></span>
													<input type="text" name="order_tracking_carriers[<?php echo $carrier_row; ?>][tracking_url]" value="<?php echo $carrier['tracking_url']; ?>" placeholder="<?php echo $help_tracking_url; ?>" class="form-control" />
												</div>
												<?php if (isset($error_tracking_url[$carrier_row])) { ?>
												<div class="text-danger"><?php echo $error_tracking_url[$carrier_row]; ?></div>
												<?php } ?>											
											</td>											
											<td class="text-left"><button type="button" onclick="$('#carrier-row<?php echo $carrier_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
										</tr>
										<?php $carrier_row++; ?>
										<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td class="text-left"><button type="button" onclick="addModule();" data-toggle="tooltip" title="<?php echo $button_add_carrier; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
										</tr>
									</tfoot>
								</table>
							</div>	
						</div>	
					</div>
				</div>	
				
				<div class="tab-pane" id="tab-order-comment">
					<div id="languages" class="nav nav-tabs">
						<?php foreach ($languages as $language) { ?>
						<li><a data-toggle="tab" href="#language-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</div>
					
					<?php foreach ($languages as $language) { ?>
					<div id="language-<?php echo $language['language_id']; ?>" class="tab-pane">
						<div class="alert alert-info"><i class="fa fa-fw fa-info-circle"></i> <?php echo $help_keywords; ?></div>
						
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-tracking-comment-<?php echo $language['language_id']; ?>"><?php echo $entry_comment_template; ?></label>
							<div class="col-sm-10">
								<textarea name="order_tracking_comment[<?php echo $language['language_id']; ?>][description]" id="input-tracking-comment-<?php echo $language['language_id']; ?>" rows="8" data-toggle="popover" data-html="true" data-title="<?php echo $entry_comment_template; ?>" data-content="<?php echo $help_comment; ?>" data-placement="top" data-trigger="focus" class="form-control"><?php echo isset($order_tracking_comment[$language['language_id']]) ? $order_tracking_comment[$language['language_id']]['description'] : ''; ?></textarea>
								<?php if (isset($error_order_comment[$language['language_id']])) { ?>
								<div class="text-danger"><?php echo $error_order_comment[$language['language_id']]; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>		
				</div>	
				
				<div class="tab-pane" id="tab-help">
					<div class="tab-content">
						Change Log and HELP Guide is available : <a href="http://www.oc-extensions.com/Shipment-Order-Tracking" target="blank">HERE</a><br /><br />
						If you need support email us at <strong>support@oc-extensions.com</strong> (Please first read help guide)				
					</div>
				</div>
			</div>
        </form>
    </div>
  </div>
<script type="text/javascript"><!--
var carrier_row = <?php echo $carrier_row; ?>;

function addModule() {
	html  = '<tr id="carrier-row' + carrier_row + '">';
	html += '  <td class="text-left">';
	html += ' 	   <div class="input-group">';
	html += '          <span class="input-group-addon"><i class="fa fa-truck"></i></span>';	
	html += '          <input type="text" name="order_tracking_carriers[' + carrier_row + '][name]" placeholder="<?php echo addslashes($entry_carrier_name); ?>" value="" class="form-control" />';
	html += '      </div>';
	html += '  </td>';
	html += '  <td class="text-left">';
	html += ' 	   <div class="input-group">';
	html += '          <span class="input-group-addon"><i class="fa fa-link"></i></span>';
	html += '          <input type="text" name="order_tracking_carriers[' + carrier_row + '][tracking_url]" placeholder="<?php echo addslashes($help_tracking_url); ?>" value="" class="form-control" />';
	html += '      </div>';
	html += '  </td>';	
	html += '  <td class="text-left"><button type="button" onclick="$(\'#carrier-row' + carrier_row + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#module tbody').append(html); 
	
	$('.carrier-discount-type-trigger').trigger('change');
	
	carrier_row++;
}

$('#languages li:first-child a').tab('show');

$('[data-toggle=\'popover\']').popover();
//--></script></div>
<?php echo $footer; ?>
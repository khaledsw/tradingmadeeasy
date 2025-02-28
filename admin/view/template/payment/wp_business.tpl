<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-cod" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cod" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_merchant; ?></label>
            <div class="col-sm-10">
			<input type="text" name="wp_business_merchant" value="<?php echo $wp_business_merchant; ?>" class="form-control" id="input-total" />
			<?php if ($error_merchant) { ?>
				<div class="text-danger"><?php echo $error_merchant; ?></div>
			<?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
            <div class="col-sm-10">
			<input type="text" name="wp_business_password" value="<?php echo $wp_business_password; ?>" class="form-control" id="input-password" />
			<?php if ($error_password) { ?>
				<div class="text-danger"><?php echo $error_password; ?></div>
			<?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-callback"><?php echo $entry_callback; ?></label>
            <div class="col-sm-10">
				<textarea cols="40" rows="5" class="form-control" id="input-callback"><?php echo $callback; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-test"><?php echo $entry_test; ?></label>
            <div class="col-sm-10">
              <select name="wp_business_test" id="input-test" class="form-control">
                <?php if ($wp_business_test == '0') { ?>
                <option value="0" selected="selected"><?php echo $text_off; ?></option>
                <?php } else { ?>
                <option value="0"><?php echo $text_off; ?></option>
                <?php } ?>
                <?php if ($wp_business_test == '100') { ?>
                <option value="100" selected="selected"><?php echo $text_successful; ?></option>
                <?php } else { ?>
                <option value="100"><?php echo $text_successful; ?></option>
                <?php } ?>
                <?php if ($wp_business_test == '101') { ?>
                <option value="101" selected="selected"><?php echo $text_declined; ?></option>
                <?php } else { ?>
                <option value="101"><?php echo $text_declined; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_total; ?></label>
            <div class="col-sm-10">
				<input type="text" name="wp_business_total" value="<?php echo $wp_business_total; ?>" class="form-control" id="input-total" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order_status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
              <select name="wp_business_order_status_id" id="input-order_status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $wp_business_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo_zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="wp_business_geo_zone_id" id="input-geo_zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $wp_business_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="wp_business_status" id="input-status" class="form-control">
                <?php if ($wp_business_status) { ?>
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
            <label class="col-sm-2 control-label" for="input-sort_order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
				<input type="text" name="wp_business_sort_order" value="<?php echo $wp_business_sort_order; ?>" size="1" class="form-control" id="input-sort_order"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-logo-status"><?php echo $entry_logoStatus; ?></label>
            <div class="col-sm-10">
              <select name="wp_business_logoStatus" id="input-logo-status" class="form-control">
                <?php if ($wp_business_logoStatus) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </form>


      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 

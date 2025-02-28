<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-qty_based_pricing_breakdown" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-qty_based_pricing_breakdown" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
           </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                </div>
              </div>
 			   
			  
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                  <div id="qty_based_pricing_breakdown-product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($qty_based_pricing_breakdown_product as $qty_based_pricing_breakdown_product) { ?>
                    <div id="qty_based_pricing_breakdown-product<?php echo $qty_based_pricing_breakdown_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $qty_based_pricing_breakdown_product['name']; ?>
                      <input type="hidden" name="qty_based_pricing_breakdown_product[]"  value="<?php echo $qty_based_pricing_breakdown_product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
			  
			  <table id="images" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_qty_from; ?></td>
                <td class="text-left"><?php echo $entry_qty_to; ?></td>
                <td class="text-left"><?php echo $entry_price_per_unit; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $image_row = 0; ?>
              <?php foreach ($qty_data as $data_qty) { ?>
			  <?php $disable = '';if($image_row == 0) { $disable = 'style="pointer-events: none;background:#eee;"';} ?>
              <tr id="image-row<?php echo $image_row; ?>">
                <td class="text-left" style="width: 30%;"><input type="text" name="data_qty[<?php echo $image_row; ?>][qty_from]" value="<?php echo $data_qty['qty_from']; ?>" placeholder="<?php echo $entry_qty_from; ?>" <?php echo $disable;?> class="form-control" />
				<?php if (isset($error_qty_from[$image_row])) { ?>
                  <div class="text-danger"><?php echo $error_qty_from[$image_row]; ?></div>
                  <?php } ?>
				  </td>
				
				<td class="text-left" style="width: 30%;"><input type="text" name="data_qty[<?php echo $image_row; ?>][qty_to]" value="<?php echo $data_qty['qty_to']; ?>" placeholder="<?php echo $entry_qty_to; ?>" <?php echo $disable;?> class="form-control" />
				<?php if (isset($error_qty_to[$image_row])) { ?>
                  <div class="text-danger"><?php echo $error_qty_to[$image_row]; ?></div>
                  <?php } ?>
				  </td>
				
				<td class="text-left" style="width: 30%;"><input type="text" name="data_qty[<?php echo $image_row; ?>][price_per_unit]" value="<?php echo $data_qty['price_per_unit']; ?>" <?php echo $disable;?> placeholder="<?php echo $entry_price_per_unit; ?>" class="form-control" />
				<?php if (isset($error_price_per_unit[$image_row])) { ?>
                  <div class="text-danger"><?php echo $error_price_per_unit[$image_row]; ?></div>
                  <?php } ?>
				  </td>
				
                
                <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $image_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_qty_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
               
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-start"><?php echo $entry_date_start; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="date_start" value="<?php echo $date_start; ?>" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-end"><?php echo $entry_date_end; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="date_end" value="<?php echo $date_end; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
               
               
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
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
           </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><input type="text" name="data_qty[' + image_row + '][qty_from]" value="" placeholder="<?php echo $entry_qty_from; ?>" class="form-control" /></td>';	
	html += '  <td class="text-left"><input type="text" name="data_qty[' + image_row + '][qty_to]" value="" placeholder="<?php echo $entry_qty_to; ?>" class="form-control" /></td>';	
	html += '  <td class="text-left"><input type="text" name="data_qty[' + image_row + '][price_per_unit]" value="" placeholder="<?php echo $entry_price_per_unit; ?>" class="form-control" /></td>';	
 	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}

var myimage_row = image_row;
function addFirstQtyData(price) {//alert(price);
	html  = '<tr id="image-row' + myimage_row + '">';
	html += '  <td class="text-left"><input type="text" name="data_qty[' + myimage_row + '][qty_from]" value="1" style="pointer-events: none;background:#eee;" placeholder="<?php echo $entry_qty_from; ?>" class="form-control" /></td>';	
	html += '  <td class="text-left"><input type="text" name="data_qty[' + myimage_row + '][qty_to]" value="1" style="pointer-events: none;background:#eee;" placeholder="<?php echo $entry_qty_to; ?>" class="form-control" /></td>';	
	html += '  <td class="text-left"><input type="text" name="data_qty[' + myimage_row + '][price_per_unit]" value="'+price+'" style="pointer-events: none;background:#eee;" placeholder="<?php echo $entry_price_per_unit; ?>" class="form-control" /></td>';	
 	html += '</tr>';
	
	$('#images tbody').html(html);
	
	image_row++;
}
//--></script>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/qty_based_pricing_breakdown/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id'],
						price: item['price']
					}
				}));
			}
		});
	},
	'select': function(item) {
		addFirstQtyData(parseFloat(item['price']).toFixed(2) );
		
		$('input[name=\'product\']').val('');
		
		$('#qty_based_pricing_breakdown-product' + item['value']).remove();
		
		$('#qty_based_pricing_breakdown-product').html('<div id="qty_based_pricing_breakdown-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="qty_based_pricing_breakdown_product[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#qty_based_pricing_breakdown-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
 
//--></script>

  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?>
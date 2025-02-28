<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ezweight" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a onclick="saveAndContinue()" data-toggle="tooltip" title="<?php echo $button_save_and_cont; ?>" class="btn btn-default"><i class="fa fa-save"></i></a>
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
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ezweight" name="form-ezweight" class="form-horizontal">
		<input type="hidden" name="destination" value="exit" id="destination"/>
          <div class="row">
            <div class="col-sm-3">
              <ul class="nav nav-pills nav-stacked" id="module">
                <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
				  <?php $module_tab = 1; ?>
				  <?php foreach ($ezweight_module as $module) { ?>
				  <li><a id="tab-module<?php echo $module_tab; ?>" href="#tab-module-<?php echo $module_tab; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('#tab-module<?php echo $module_tab; ?>').parent().remove(); $('#tab-module-<?php echo $module_tab; ?>').remove(); $('#module a:first').tab('show');"></i> <?php if($module['title']) {echo $module['title']; } else {echo $tab_module . ' ' . $module_tab;} ?></a></li>
				  <?php $module_tab++; ?>
				  <?php } ?>
                <li><a onclick="addModule();" class="btn btn-default"><?php echo $button_add_module; ?></a></li>
              </ul>
            </div>
            <div class="col-sm-9">
              <div class="tab-content" id="modules">
			  
                <div class="tab-pane active" id="tab-general">
				
				
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>
                    <div class="col-sm-8">
                      <select name="ezweight_status" class="form-control">
						  <?php if ($ezweight_status) { ?>
						  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						  <option value="0"><?php echo $text_disabled; ?></option>
						  <?php } else { ?>
						  <option value="1"><?php echo $text_enabled; ?></option>
						  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						  <?php } ?>
					  </select>
                    </div>
					<div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_display_weight; ?>"><?php echo $entry_display_weight; ?></span></label>
                    <div class="col-sm-8">
					  <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary <?php if ($ezweight_display_weight) {echo 'active';} ?>">
                        <input type="radio" name="ezweight_display_weight" value="1"  <?php if ($ezweight_display_weight) {echo 'checked="checked"';} ?> />
                        <?php echo $text_yes; ?>
                      </label>
                      <label class="btn btn-primary <?php if (!$ezweight_display_weight) {echo 'active';} ?>">
                        <input type="radio" name="ezweight_display_weight" value="0" <?php if (!$ezweight_display_weight) {echo 'checked="checked"';} ?> />
                        <?php echo $text_no; ?>
                      </label>
					  </div>
                    </div>
 				  <div class="col-sm-1"></div>
                 </div>
				  
				  
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="input-weight-class"><?php echo $entry_weight_class; ?></label>
                    <div class="col-sm-8">
                      <select name="ezweight_weight_class_id" id="input-weight-class" class="form-control">
                        <?php foreach ($weight_classes as $weight_class) { ?>
                        <?php if ($weight_class['weight_class_id'] == $ezweight_weight_class_id) { ?>
                        <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
 				    <div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
                    <div class="col-sm-8">
                      <select name="ezweight_tax_class_id" id="input-tax-class" class="form-control">
                        <option value="0"><?php echo $text_none; ?></option>
                        <?php foreach ($tax_classes as $tax_class) { ?>
                        <?php if ($tax_class['tax_class_id'] == $ezweight_tax_class_id) { ?>
                        <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
 				    <div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="ezweight_sort_order" value="<?php echo $ezweight_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                    </div>
  				    <div class="col-sm-1"></div>
                 </div>
                </div>

				<?php $module_tab = 1; ?>
				<?php $module_row = array(); ?>
				<?php foreach ($ezweight_module as $module) { ?>
				
				<?php // Check if geo_zone_id is set and give it a value if not ?>
				<?php if(!isset($module['geo_zone_id'])) { ?>
				<?php 	$module['geo_zone_id'] = "0"; ?>
				<?php } ?>

				<?php // Check if sort_order is set and give it a value if not ?>
				<?php if(!isset($module['sort_order'])) { ?>
				<?php 	$module['sort_order'] = "0"; ?>
				<?php } ?>
				
                <div class="tab-pane" id="tab-module-<?php echo $module_tab; ?>">
				
				
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_title; ?>"><?php echo $entry_title; ?></span></label>
                    <div class="col-sm-8">
                      <input type="text" name="ezweight_module[<?php echo $module_tab; ?>][title]" id="ezweight_module_title_<?php echo $module_tab; ?>" value="<?php echo $module['title']; ?>" onchange="changeTitle(<?php echo $module_tab; ?>)" class="form-control" />
                    </div>
					<div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>
                    <div class="col-sm-8">
                      <select name="ezweight_module[<?php echo $module_tab; ?>][status]" class="form-control">
						  <?php if ($module['status']) { ?>
						  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						  <option value="0"><?php echo $text_disabled; ?></option>
						  <?php } else { ?>
						  <option value="1"><?php echo $text_enabled; ?></option>
						  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						  <?php } ?>
					  </select>
                    </div>
 				  <div class="col-sm-1"></div>
                 </div>			  
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $entry_geo_zone; ?></label>
                    <div class="col-sm-8">
                      <select name="ezweight_module[<?php echo $module_tab; ?>][geo_zone_id]" class="form-control">
						  <option value="0"><?php echo $text_all_zones; ?></option>
						  <?php foreach ($geo_zones as $geo_zone) { ?>
						  <?php if ($geo_zone['geo_zone_id'] == $module['geo_zone_id']) { ?>
						  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
						  <?php } ?>
						  <?php } ?>
					  </select>
                    </div>
 				    <div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="ezweight_module[<?php echo $module_tab; ?>][sort_order]" id="ezweight_module_sort_order_<?php echo $module_tab; ?>" value="<?php echo $module['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
                    </div>
  				    <div class="col-sm-1"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $entry_rate; ?></label>
                    <div class="col-sm-8">
                     <table id="ezweight_module_<?php echo $module_tab; ?>" class="table table-striped">
						<thead>
							<tr>
								<td class="text-center weight-class">Weight Limit</td>
								<td class="text-center">Price</td>
								<td class="text-center">&nbsp;</td>
							</tr>
						</thead>
						<?php $ctr = 0; ?>
						<?php foreach($module['rates'] as $rate) { ?>
							<tbody id="ezweight_module_rates_<?php echo $module_tab; ?>_<?php echo $ctr; ?>">
								<tr>
									<td class="text-center"><input type="text" value="<?php echo $rate['weight']; ?>" name="ezweight_module[<?php echo $module_tab; ?>][rates][<?php echo $ctr; ?>][weight]" /></td>
									<td class="text-center"><input type="text" value="<?php echo number_format((float)$rate['price'], 2); ?>" name="ezweight_module[<?php echo $module_tab; ?>][rates][<?php echo $ctr; ?>][price]" /></td>
									<td class="text-center"><button type="button" onclick="$(this).tooltip('destroy'); $('#ezweight_module_rates_<?php echo $module_tab; ?>_<?php echo $ctr; ?>').remove();" class="btn btn-danger" data-toggle="tooltip" rel="tooltip" title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button>
									</td>
								</tr>
							<?php $ctr++; ?>
						</tbody>
						<?php } ?>
						<?php $module_row[$module_tab] = $ctr; ?>
						<tfoot>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td class="text-center"><button type="button" onclick="addRow(<?php echo $module_tab; ?>);" data-toggle="tooltip" title="<?php echo $button_add_row; ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i></button></td>
								
							</tr>
						</tfoot>
					  </table>

                    </div>
 				    <div class="col-sm-1"></div>
                  </div>
				</div>
				<?php $module_tab++; ?>
				<?php } ?>
			  </div>
			</div>
		  </div>
		
	  </form>
	</div>
  </div>
  </div>
</div>	
	
<script type="text/javascript"><!--
var module_tab = <?php echo $module_tab; ?>;
var module_row = new Array();
<?php foreach ($module_row as $key => $value) { ?>
	module_row[<?php echo $key; ?>] = <?php echo $value; ?>;
<?php } ?>

function addModule() {	
	module_row[module_tab] = 0;

	html  = '<div class="tab-pane" id="tab-module-' + module_tab + '">';
    html += '             <div class="form-group">';
    html += '		        <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_title; ?>"><?php echo $entry_title; ?></span></label>';
    html += '                <div class="col-sm-8">';
    html += '                  <input type="text" name="ezweight_module[' + module_tab + '][title]" id="ezweight_module_title_' + module_tab + '" value="" onchange="changeTitle(' + module_tab + ')" class="form-control" />';
    html += '                </div>';
	html += '				<div class="col-sm-1"></div>';
    html += '              </div>';
    html += '              <div class="form-group">';
    html += '                <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>';
    html += '                <div class="col-sm-8">';
    html += '                  <select name="ezweight_module[' + module_tab + '][status]" class="form-control">';
	html += '					  <option value="1"><?php echo $text_enabled; ?></option>';
	html += '					  <option value="0"><?php echo $text_disabled; ?></option>';
	html += '				  </select>';
    html += '                </div>';
 	html += '	 			 <div class="col-sm-1"></div>';
    html += '              </div>';
    html += '              <div class="form-group">';
    html += '                <label class="col-sm-3 control-label"><?php echo $entry_geo_zone; ?></label>';
    html += '                <div class="col-sm-8">';
    html += '                  <select name="ezweight_module[' + module_tab + '][geo_zone_id]" class="form-control">';
	html += '					  <option value="0"><?php echo $text_all_zones; ?></option>';
								  <?php foreach ($geo_zones as $geo_zone) { ?>
	html += '					  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>';
								  <?php } ?>
	html += '				  </select>';
    html += '                </div>';
 	html += '			    <div class="col-sm-1"></div>';
    html += '              </div>';
    html += '              <div class="form-group">';
    html += '                <label class="col-sm-3 control-label"><?php echo $entry_sort_order; ?></label>';
    html += '                <div class="col-sm-8">';
    html += '                  <input type="text" name="ezweight_module[' + module_tab + '][sort_order]" id="ezweight_module_sort_order_' + module_tab + '" value="99" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />';
    html += '                </div>';
  	html += '			    <div class="col-sm-1"></div>';
    html += '              </div>';
    html += '              <div class="form-group">';
    html += '                <label class="col-sm-3 control-label"><?php echo $entry_rate; ?></label>';
    html += '                <div class="col-sm-8">';

	html += '					<table id="ezweight_module_' + module_tab + '" class="table table-striped">';
	html += '						<thead>';
	html += '							<tr>';
	html += '								<td class="text-center"><?php echo $entry_weight_limit; ?></td>';
	html += '								<td class="text-center"><?php echo $entry_price; ?></td>';
	html += '								<td>&nbsp;</td>';
	html += '							</tr>';
	html += '						</thead>';
	html += '						<tbody id="ezweight_module_rates_' + module_tab + '_' + module_row[module_tab] + '">';
	html += '							<tr>';
	html += '								<td class="text-center"><input type="text" name="ezweight_module[' + module_tab + '][rates][' + module_row[module_tab] + '][weight]" id="ezweight_module_rates_' + module_tab + '_' + module_row[module_tab] + '_weight" value="" /></td>';
	html += '								<td class="text-center"><input type="text" name="ezweight_module[' + module_tab + '][rates][' + module_row[module_tab] + '][price]" id="ezweight_module_rates_' + module_tab + '_' + module_row[module_tab] + '_price" value="" /></td>';
	html += '								<td class="text-center"><button type="button" onclick="$(this).tooltip(\'destroy\'); $(\'#ezweight_module_rates_' + module_tab + '_' + module_row[module_tab] + '\').remove();" class="btn btn-danger" data-toggle="tooltip" rel="tooltip" title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button></td>';
	html += '		    				</tr>';
	html += '		    			</tbody>';
	html += '						<tfoot>';
	html += '							<tr>';
	html += '								<td colspan="2">&nbsp;</td>';
	html += '								<td class="text-center"><button type="button" onclick="addRow(' + module_tab + ');" data-toggle="tooltip" title="<?php echo $button_add_row; ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i></button></td>';




	html += ' 		   				</tr>';
	html += ' 		   			</tfoot>';
	html += '					</table>';  
	html += '				</td>';
	html += '		    </tr>';
	html += '		  </table>'; 
	html += '		</div>';
	
	$('#modules').append(html);
	
	$('#module > li:last-child').before('<li><a id="tab-module' + module_tab + '" href="#tab-module-' + module_tab + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#tab-module' + module_tab + '\').parent().remove(); $(\'#tab-module-' + module_tab + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> Module ' + module_tab + '</a></li>');
		
	$('#module a[href=\'#tab-module-' + module_tab + '\']').tab('show');
			
	module_row[module_tab]++;
	module_tab++;
}

//--></script> 
<script type="text/javascript"><!--
function addRow(tab) {
	html  = '				<tbody id="ezweight_module_rates_' + tab + '_' + module_row[tab] + '">';
	html += '					<tr>';
	html += '						<td class="text-center"><input type="text" name="ezweight_module[' + tab + '][rates][' + module_row[tab] + '][weight]" id="ezweight_module_rates_' + tab + '_' + module_row[tab] + '_weight" value="" /></td>';
	html += '						<td class="text-center"><input type="text" name="ezweight_module[' + tab + '][rates][' + module_row[tab] + '][price]" id="ezweight_module_rates_' + tab + '_' + module_row[tab] + '_price" value="" /></td>';
	html += '						<td class="text-center"><button type="button" onclick="$(this).tooltip(\'destroy\'); $(\'#ezweight_module_rates_' + tab + '_' + module_row[tab] + '\').remove();" class="btn btn-danger" data-toggle="tooltip" rel="tooltip" title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button></td>';
	html += '    				</tr>';
	html += '    			</tbody>';
	
	$('#ezweight_module_' + tab + ' tfoot').before(html);
		
	module_row[tab]++;
	
}
//--></script> 
<?php if($current_tab != '0') { ?>
<script type="text/javascript"><!--
$(document).ready(function(){
	$('#module a[href=\'#tab-module-<?php echo $current_tab; ?>\']').tab('show');	
});
//--></script> 
<?php } ?>
<script type="text/javascript"><!--
function saveAndContinue() {

	for(var i=1;i<module_tab; i++) {
		var tab = '#tab-module' + i;
		if($(tab).parent().hasClass('active')) {

			break;
		}
	}

	el2 = document.getElementById('destination');
	el2.value = i;
	$('#form-ezweight').submit();
}
//--></script> 
<script type="text/javascript"><!--
function changeTitle(row) {
	var title = 'ezweight_module_title_' + row;
	eltitle = document.getElementById(title);
		elvalue = eltitle.value;
		if(elvalue != '') {
			var html = '<a id="tab-module' + row + '" href="#tab-module-' + row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\'#tab-module' + row + '\']\').parent().remove(); $(\'#tab-module' + row + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> ' + elvalue + '</a>';	
		} else {
			var html = '<a id="tab-module' + row + '" href="#tab-module-' + row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\'#tab-module' + row + '\']\').parent().remove(); $(\'#tab-module' + row + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> Module ' + row + '</a>';	

		}
		elmodule = '#tab-module' + row;

		$(elmodule).replaceWith (html);		
}
//--></script> 
<script type="text/javascript"><!--
function changeWeightUnit() {
	var weight_units = new Array();
	<?php foreach ($weight_classes as $weight_class) { ?>
	weight_units[<?php echo $weight_class['weight_class_id']; ?>] = '<?php echo $weight_class['unit']; ?>';
	<?php } ?>
	el = document.getElementById("input-weight-class");
	weight_class_id = el.value;
	html = '<td class="text-center weight-class">Weight Limit (' + weight_units[weight_class_id] + ')</td>';
	
	$('.weight-class').replaceWith(html);
		
}

changeWeightUnit();
//--></script> 
<?php echo $footer; ?>	 
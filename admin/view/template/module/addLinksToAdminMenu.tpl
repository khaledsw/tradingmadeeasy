<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-addLinks" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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

            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-addLinks">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-links">Links</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-categories">Categories</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-links" class="tab-pane active">

                            <div class="table-responsive">
                                    
                                  <table id="route" class="table table-striped table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <td class="text-left">Link (with http://)</td>
                                      <td class="text-left">Menu link title</td>
                                      <td class="text-left">Category</td>
                                      <td class="text-left">Open in new window</td>
                                      <td></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $route_row = 0; ?>
                                    <?php foreach ($existing_links as $existing_link) { ?>
                                    <tr id="route-row<?php echo $route_row; ?>">
                                      <td class="text-left"><input type="text" name="existing_link[<?php echo $route_row; ?>][link_href]" value="<?php echo $existing_link['link_href']; ?>" /></td>
                                      <td class="text-left"><input type="text" name="existing_link[<?php echo $route_row; ?>][link_title]" value="<?php echo $existing_link['link_title']; ?>" /></td>
                                      <td class="text-left">
                                        <select name="existing_link[<?php echo $route_row; ?>][category_id]">
                                            <option value="0"></option>
                                            <?php foreach ($existing_categories as $existing_cat) { ?>
                                                <option <?php if ($existing_cat['id']==$existing_link['category_id']) { echo ' selected '; } ?> value="<?php echo $existing_cat['id']; ?>"><?php echo $existing_cat['category_title']; ?></option>
                                            <?php } ?>
                                        </select>
                                      </td>
                                      <td class="text-left"><input type="checkbox" name="existing_link[<?php echo $route_row; ?>][new_window]" value="1"
                                        <?php if ( (isset($existing_link['new_window'])) && ($existing_link['new_window']==1) ) { echo ' checked '; } ?> /></td>
                                      <td class="text-left"><button type="button" onclick="$('#route-row<?php echo $route_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                    <?php $route_row++; ?>
                                    <?php } ?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="4"></td>
                                      <td class="text-left"><button type="button" onclick="addRoute();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                  </tfoot>
                                </table>  

                              <script type="text/javascript"><!--
                              var route_row = <?php echo $route_row; ?>;

                              function addRoute() {
                                html  = '<tr id="route-row' + route_row + '">';
                                html += '  <td class="text-left"><input type="text" name="existing_link[' + route_row + '][link_href]" /></td>';
                                html += '  <td class="text-left"><input type="text" name="existing_link[' + route_row + '][link_title]" /></td>';
                                html += '    <td class="left"><select name="existing_link[' + route_row + '][category_id]"><option value="0"></option><?php foreach ($existing_categories as $existing_cat) { echo "<option value=".$existing_cat['id'].">".$existing_cat['category_title']."</option>";  } ?></select></td>';
                                html += '  <td class="text-left"><input type="checkbox" name="existing_link[' + route_row + '][new_window]" value="1"></td>';
                                html += '  <td class="text-left"><button type="button" onclick="$(\'#route-row' + route_row + '\').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                                html += '</tr>';
                                
                                $('#route tbody').append(html);
                                
                                route_row++;
                              }   
                          //--></script>  



                            </div>           
                        </div>

                       
                        <div id="tab-categories" class="tab-pane">
                            <div class="table-responsive">

                                  <table id="routeCat" class="table table-striped table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <td class="text-left">Category Title</td>
                                      <td></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $routeCat_row = 0; ?>
                                    <?php foreach ($existing_categories as $existing_category) { ?>
                                    <tr id="routeCat-row<?php echo $routeCat_row; ?>">
                                      <td class="text-left"><input type="text" name="existing_category[<?php echo $routeCat_row; ?>][category_title]" value="<?php echo $existing_category['category_title']; ?>" />
                                        <input type="hidden" name="existing_category[<?php echo $routeCat_row; ?>][category_id]" value="<?php echo $existing_category['id']; ?>" /></td>
                                      <td class="text-left"><button type="button" onclick="$('#routeCat-row<?php echo $routeCat_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                    <?php $routeCat_row++; ?>
                                    <?php } ?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td></td>
                                      <td class="text-left"><button type="button" onclick="addRouteCat();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                  </tfoot>
                                </table>  

                              <script type="text/javascript"><!--
                              var routeCat_row = <?php echo $routeCat_row; ?>;

                              function addRouteCat() {
                                html  = '<tr id="routeCat-row' + routeCat_row + '">';
                                html += '  <td class="text-left"><input type="text" name="existing_category[' + routeCat_row + '][category_title]" /></td>';
                                html += '  <td class="text-left"><button type="button" onclick="$(\'#routeCat-row' + routeCat_row + '\').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                                html += '</tr>';
                                
                                $('#routeCat tbody').append(html);
                                
                                routeCat_row++;
                              }   
                          //--></script> 


                            </div>
                        </div>
                        
            </div>
          </form>
        </div>
    </div>
  </div>
</div>



  <script type="text/javascript"><!--
$('#tabs a:first').tab('show');
//--></script>
<?php echo $footer; ?>
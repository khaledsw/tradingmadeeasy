<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_nothing; ?></div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $copy; ?>" method="post" enctype="multipart/form-data" id="form-pod-copy" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_product_source; ?></label>
            <div class="col-sm-10">
              <select id="product-category" class="form-control">
                <option value="http://"><?php echo $text_select; ?></option>
                <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php } ?>
              </select>
              <select id="source-product" name="source_product" class="form-control"><option value="0"><?php echo $text_select; ?></option>
              </select>
              <?php if ($error_source_product) { ?>
              <div class="text-danger"><?php echo $error_source_product; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_product_target; ?></label>
            <div class="col-sm-10">
              <input type="text" name="product" value="" placeholder="<?php echo $entry_product_target; ?>" id="input-product" class="form-control" />
              <div id="target-product" class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_category_target; ?></label>
            <div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($categories as $category) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="target_categories[]" value="<?php echo $category['category_id']; ?>" />
                    <?php echo $category['name']; ?>
                  </label>
                </div>
                <?php } ?>
              </div>
              <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <button type="button" data-toggle="tooltip" title="<?php echo $text_copy_warning; ?>" class="btn btn-primary" onclick="confirm('<?php echo $text_copy_warning; ?>') ? $('#form-pod-copy').submit() : false;"><i class="fa fa-copy"></i> <?php echo $button_copy; ?></a>
            </div>
          </div>
        </form>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12 text-left"><?php echo $myoc_copyright; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var category_products = [];
    <?php foreach ($category_products as $category_id => $products) { ?>
    category_products[<?php echo $category_id; ?>] = [];
    <?php foreach ($products as $product_id => $product) { ?>
    category_products[<?php echo $category_id; ?>][<?php echo $product_id; ?>] = "<?php echo $product; ?>";
    <?php } ?>
    <?php } ?>
    $("select#product-category").change(function() {
      $("select#source-product option").remove();
      $('<option value="http://"><?php echo $text_select; ?></option>').appendTo($("select#source-product"));
      for(var product_id in category_products[$(this).val()])
      {
        $('<option value="' + product_id + '">' + category_products[$(this).val()][product_id] + '</option>').appendTo($("select#source-product"));
      }
    });
});
$('input[name=\'product\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'product\']').val('');
    
    $('#target-product' + item['value']).remove();
    
    $('#target-product').append('<div id="target-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="target_products[]" value="' + item['value'] + '" /></div>');  
  } 
});

$('#target-product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
</script>
<?php echo $footer; ?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-speedup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-speedup" class="form-horizontal">
			<input type="hidden" name="speedup_index_status" value="<?php echo isset($speedup_index_status) ? $speedup_index_status : 0; ?>" />
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="speedup_status" id="input-status" class="form-control">
                <?php if ($speedup_status) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_imglazyload_status; ?></label>
            <div class="col-sm-10">
              <select name="speedup_imglazyload_status" id="input-speedup_imglazyload_status" class="form-control">
                <?php if ($speedup_imglazyload_status) { ?>
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
			<label class="col-sm-2 control-label" for="input-imglazyload_placeholder"><?php echo $entry_imglazyload_placeholder; ?></label>
			<div class="col-sm-10">
			<a href="" id="thumb-imglazyload_placeholder" data-toggle="image" class="img-thumbnail"><img src="<?php echo $imglazyload_placeholder_thmb; ?>"  data-placeholder="<?php echo $placeholder; ?>" /></a>
            <input type="hidden" name="speedup_imglazyload_placeholder" value="<?php echo $speedup_imglazyload_placeholder ?>" id="input-imglazyload_placeholder" /> 
			</div>
		  </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-imglazyload_delaytime"><?php echo $entry_imglazyload_delaytime; ?></label>
            <div class="col-sm-10">
              <input type="text" name="speedup_imglazyload_delaytime" value="<?php echo $speedup_imglazyload_delaytime; ?>" placeholder="<?php echo $entry_imglazyload_delaytime; ?>" id="input-imglazyload_delaytime" class="form-control" />
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_speedup_compresscss; ?></label>
            <div class="col-sm-10">
              <select name="speedup_compresscss" id="input-speedup_compresscss" class="form-control">
                <?php if ($speedup_compresscss) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_speedup_compressjs; ?></label>
            <div class="col-sm-10">
              <select name="speedup_compressjs" id="input-speedup_compressjs" class="form-control">
                <?php if ($speedup_compressjs) { ?>
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
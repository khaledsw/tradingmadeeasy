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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
		<ul class="nav nav-tabs">
          <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          <li><a href="#tab-about" data-toggle="tab"><i class="fa fa-question-circle"></i> About</a></li>
        </ul>
		<div class="tab-content">
		  <div class="tab-pane active" id="tab-general">
		    <div class="alert alert-success">
		      <h3 style="margin:0"><i class="fa fa-thumbs-up"></i> <?php echo $text_congratulations; ?></h3>
			</div>
			<p><?php echo $text_message; ?></p>
			<p><?php echo $text_step_1; ?></p>
			<p><code><?php echo $search; ?></code></p>
			<p><?php echo $text_step_2; ?></p>
			<p><code><?php echo $add; ?></code></p>
			<p><?php echo $text_step_3; ?></p>
		  </div>
		  <?php require_once(substr_replace(DIR_SYSTEM, '', -7) . 'vendor/equotix/' . $code . '/equotix.tpl'); ?>
		</div>
      </div>
    </div>
	{version}
  </div>
</div>
<?php echo $footer; ?>
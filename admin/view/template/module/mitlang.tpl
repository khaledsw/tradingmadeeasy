<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-mitlang" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mitlang" class="form-horizontal">
          

          <div class="form-group">
            <div class="col-sm-10">
            <h3><u>Language Based Currency Selection</u></h3>
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-10">
              <table class="table table-bordered">
                <tbody>
                  <?php foreach ($languages AS $lang) { ?>  
                  <tr>
                    <td width="20%"><?php echo $lang['name']; ?></td>
                    <td width="1%">:</td>
                    <td>
                      <select name="mitlang[lang][<?php echo $lang['code']; ?>]" class="form-control">
                        <option value="">--Choose Currency--</option>
                        <?php foreach ($currencies as $key => $value) { ?>
                          <option value="<?php echo $value['code']; ?>" <?php if($value['code'] == $mitlang[$lang['code']]) echo 'selected="selected"';?>><?php echo $value['title']; ?></option>  
                        <?php } ?>
                        
                      </select>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
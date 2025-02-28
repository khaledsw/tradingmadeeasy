<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">

            <?php
            $check_updates=true;

            //***** uncomment the following line if you want to disable automatic update checks: *****
            //$check_updates=false;

            if ($check_updates) {

                //load version number from XML file
                $fil=@file_get_contents('../vqmod/xml/oc_deduplicator_2.0.x.xml');
                $ver=@preg_match('@<version>(.*)</version>@Ui', $fil, $vmatch);

                $product='DEDUPE';
                $version=@$vmatch[1];

                if ($version && function_exists('curl_init')) {
                    $ch = @curl_init("http://www.forlent.com/checkupgrade.php?product=".$product."&version=".$version);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                    $res=@curl_exec($ch);
                    curl_close($ch);

                    if ($res) {
                        $res=@unserialize($res);
                        if (!empty($res['upgrade_url'])) {
                            ?>
                            <div>There is a new version of OpenCart SEO Link Deduplicator available. Latest version is <?php echo $res['upgrade_ver'] ?>, you're running <?php echo $version ?>. <a href="<?php echo htmlentities($res['upgrade_url']) ?>">Download it now</a></div><br>
                            <?php
                        }
                    }

                }

            }
            ?>

           
    <?php if ($error_install) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_install; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $order; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $sale; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $customer; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $online; ?></div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sx-12 col-sm-12"><?php echo $map; ?></div>
      <div class="col-lg-6 col-md-12 col-sx-12 col-sm-12"><?php echo $chart; ?></div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-sx-12"><?php echo $activity; ?></div>
      <div class="col-lg-8 col-md-12 col-sm-12 col-sx-12"> <?php echo $recent; ?> </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
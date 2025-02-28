</div>

<footer>
  <div id="footer" class="container">
      <div class="row">
	  <div class="content_footer_top"><?php echo $footertop; ?> </div>
	
	 <div class="copyright-container">
     <div class="footer_line"></div>    
      <div class="bottomfooter">
       
        <ul>
		  <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		  <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
		  <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
         <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>

   
        </ul>
      </div>
    </div>
   
    <div class="powered"><?php echo $powered; ?></div> 
	</div>
  </div>
</footer>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//--> 
<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->
</body></html>
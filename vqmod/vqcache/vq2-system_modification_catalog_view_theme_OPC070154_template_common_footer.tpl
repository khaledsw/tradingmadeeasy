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




				<?php if($lazyload == 1) {  ?>
					 <script language="javascript" src="catalog/view/javascript/lazyload/lazyload.js"> </script>
				<?php } ?> 
			

				<?php if (!isset($this->request->get['route']) || (isset($this->request->get['route']) && $this->request->get['route'] != 'product/product')) { ?>
				<script type="text/javascript"><!--
				function trigger_overlay(text, image) {					
					var html = '<div id="cart-overlay" style="display:none;"><div class="cart-overlay-container">';
					html += '<img src="' + image + '" />';
					html += '<div class="cart-message">' + text + '</div>';
					html += '<div class="cart-clear"></div>';
					html += '<a class="button" id="cart-overlay-continue">&laquo; <?php echo $text_continue_shopping; ?></a>';
					html += '<a class="button" id="cart-overlay-checkout" href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?> &raquo;</a>';
					html += '</div></div>';

					add_to_cart_notification(html);
				}
				//--></script>
				<?php } ?>
			
<?php echo $speedup;?>
</body></html>
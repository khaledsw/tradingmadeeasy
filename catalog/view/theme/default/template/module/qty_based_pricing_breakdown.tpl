<div class="well"> 	
<style>
.tblqtybreakdown th {background:#6699cc;color:#ffffff}
</style>

<div class="content">
  <h2> <?php echo $heading_title;?> </h2>
  <table class="table table-bordered tblqtybreakdown">
    <thead>
      <tr>
        <th><?php echo $col_qty_from;?></th>
		<!--<th><?php echo $col_qty_to;?></th>-->
		<th><?php echo $col_price_per_unit;?></th>
        <th><?php echo $col_yousave;?></th>        
      </tr>
    </thead>
    <tbody>
	<?php foreach($qty_data as $data_qty) { ?>
      <tr>
        <td><?php echo $data_qty['qty_from'];?></td>
		<!--<td><?php echo $data_qty['qty_to'];?></td>-->
		<td><?php echo $data_qty['price_per_unit'];?></td>
        <td><?php echo $data_qty['yousave'];?></td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
</div>
  
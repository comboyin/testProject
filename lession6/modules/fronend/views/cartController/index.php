<div class="page-title">
	<div class="pull-left">
		<h1>List View</h1>
	</div>
</div>
<br/>
<div class="page-title">
	<div class="pull-left">

	</div>
</div>
<section class="box">
	<header class="panel_header">
		<h2 class="title pull-left">ORDER LIST</h2>

		<!-- <select class="form-control pull-right select-numberpage">
		    <option>5</option>
		    <option>10</option>
		    <option>20</option>
 		</select> -->

	</header>
	<div class="content-body">
		<div class="content-table">
		<table class="table">
		   <thead>
		      <tr>
		         <th style="display: none;">Id</th>
		         <th>Id Order</th>
		         <th>Name</th>
		         <th>Phone</th>
		         <th>Email</th>
		         <th>Total price</th>
		         <th>Create time</th>
		      </tr>
		   </thead>
		   <tbody>
		   		<?php foreach ($listOrder as $order):?>
					<tr>
						<td style="display: none;"><?php echo $order->getId()?></td>
						<td><?php echo $order->getIdorder()?></td>
						<td><?php echo $order->getName()?></td>
						<td><?php echo $order->getPhone()?></td>
						<td><?php echo $order->getEmail()?></td>
						<td><?php echo utility::product_price($order->getTotalPriceCurrent()) ?></td>
						<td><?php echo $order->getCreatetime()?></td>
		      		</tr>
		   		<?php endforeach;?>
		   </tbody>
		</table>
		</div>

		<div class="pagination" id="menu-outer">
			<?php echo $pagination->html()?>
		</div>


		<!--=============================BEGIN DIALOG LIST ORDER PRODUCT================================================-->
		<div id="dialog-list-orderproduct" title="List product">
			  <div class="border-style">
			  	   <table class="form_table">
				      <tbody>
				         <tr>
							<td>Name: </td>
							<td>Tran Minh Nhut</td>
						 </tr>

						 <tr>
							<td>Phone: </td>
							<td>01886222209</td>
						 </tr>

						 <tr>
							<td>Total price: </td>
							<td>2.500.000 </td>
						 </tr>

						 <tr>
							<td>Create time: </td>
							<td>2015-10-09 15:15:00 </td>
						 </tr>
				      </tbody>
				   </table>
				   <table class="form_table">
				   		<thead>
				   			<tr>
				   				<th>Id product</th>
				   				<th>Image</th>
				   				<th>Product name</th>
				   				<th>Quality</th>
				   				<th>Total price</th>
				   			</tr>
				   		</thead>
				      <tbody>
				         <tr>
							<td>20</td>
							<td></td>
							<td>Giay dep</td>
							<td>15</td>
							<td>25000000</td>
						 </tr>

						 <tr>
							<td>20</td>
							<td></td>
							<td>Giay dep</td>
							<td>15</td>
							<td>25000000</td>
						 </tr>

						 <tr>
							<td>20</td>
							<td></td>
							<td>Giay dep</td>
							<td>15</td>
							<td>25000000</td>
						 </tr>

						 <tr>
							<td>20</td>
							<td></td>
							<td>Giay dep</td>
							<td>15</td>
							<td>25000000</td>
						 </tr>
				      </tbody>
				   </table>
				   <table class="form_table">
				      <tbody>


						 <tr>
							<td>Total price: </td>
							<td>2.500.000 </td>
						 </tr>

						 <tr>
							<td>Create time: </td>
							<td>2015-10-09 15:15:00 </td>
						 </tr>
				      </tbody>
				   </table>
			</div>
		</div>
		<!--=============================END DIALOG LIST ORDER PRODUCT================================================-->
	</div>
</section>
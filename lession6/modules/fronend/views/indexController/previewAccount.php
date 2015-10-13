		<form action="" method="post">
<div class="title">
			<a href="#">Preview Account info</a>

</div>
			<div class="border-style">
				<form action="">
					<table class="form_table preview">
					    <tr>
							<td class="error" colspan="2">

							<?php
							 echo isset($error)?$error:''

							?>


							</td>

						</tr>
						<tr>
							<td>First Name :</td>
							<td>
							<?php echo htmlspecialchars($_SESSION['first_name'])?>

							</td>
						</tr>



						<tr>
							<td>Last Name :</td>
							<td><?php echo htmlspecialchars($_SESSION['last_name'])?></td>
						</tr>


						<tr>
							<td>User Name :</td>
							<td><?php echo htmlspecialchars($_SESSION['user_name']) ?></td>
						</tr>



						<tr>
							<td>Birthday :</td>
							<td>
							<?php
							$month = strlen($_SESSION['month'])==1?"0".$_SESSION['month']:$_SESSION['month'];
							$day = strlen($_SESSION['day'])==1?"0".$_SESSION['day']:$_SESSION['day'];
							?>
									<?php echo $_SESSION['year'].'-'.$month.'-'.$day?>

							</td>
						<tr>
							<td>Gender :</td>
							<td>
							<?php echo $_SESSION['sex']==1?"Male":"Female"?>

								</td>
						<tr>
							<td>Address :</td>
							<td><?php echo htmlspecialchars($_SESSION['address'])?></td>
						<tr>
							<td>Avatar :</td>
							<td><img alt="" src="<?php echo $_SESSION['file']?>"></td>
						</tr>

						<tr>
							<td class="form-button" colspan="2">
							<input type="submit" name="back" value="Back" class="btn btn-def">
							<input type="submit" name="save" value="Save" class="btn btn-success">
							</td>
						</tr>
			</form>
					</table>



				</form>
			</div>


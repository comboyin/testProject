<form action="" method="post">
	<div class="title">
		<a href="#">Account detail</a>
	</div>
	<div class="border-style">

		<table class="form_table preview">
			<tr>
				<td>First Name :</td>
				<td>
				<?php echo htmlspecialchars($arUser!=null?$arUser['firstname']:'')?>

				</td>
			</tr>

			<tr>
				<td>Last Name :</td>
				<td><?php echo htmlspecialchars($arUser!=null?$arUser['lastname']:'')?></td>
			</tr>

			<tr>
				<td>User Name :</td>
				<td><?php echo htmlspecialchars($arUser!=null?$arUser['username']:'') ?></td>
			</tr>

			<tr>
				<td>Birthday :</td>
				<td>
						<?php echo $arUser!=null?$arUser['birthday']:''?>

				</td>
			<tr>
				<td>Gender :</td>
				<td>
				<?php echo $arUser!=null?($arUser['gender']==1?'Male':'Famale'):''?>

					</td>
			<tr>
				<td>Address :</td>
				<td><?php echo htmlspecialchars($arUser!=null?$arUser['address']:'')?></td>
			<tr>
				<td>Avatar :</td>
				<td><img alt="" src="<?php echo $arUser!=null?"uploads/".$arUser['avatar']:''?>"></td>
			</tr>

			<tr>
				<td class="form-button" colspan="2">
				<input type="submit" name="back" value="Back" class="btn btn-def">

				</td>
			</tr>

		</table>
</div>
</form>
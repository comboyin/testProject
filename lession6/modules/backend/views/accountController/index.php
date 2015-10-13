<?php
/* @var $listAccount account */
/* @var $pagination pagination */
$listAccount = $listAccount;
$pagination = $pagination;

?>
<div class="page-title">
	<div class="pull-left">
		<h1>ACCOUNT MANAGER</h1>
	</div>
</div>
<br/>
<div class="page-title">
	<div class="pull-left">
		<button class="btn btn-success add-account"><span aria-hidden="true" class="icon-play"></span> &nbsp;ADD</button>
		<button style="display: none" class="btn btn-danger"><span aria-hidden="true" class="icon-play"></span> &nbsp;DELETE SELECTED</button>
	</div>
</div>
<section class="box">
	<header class="panel_header">
		<h2 class="title pull-left">ACCOUNT LIST</h2>

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
		         <th>Id</th>
		         <th>User Name</th>
		         <th>First Name</th>
		         <th>Last Name</th>
		         <th>Birthday</th>
		         <th>Gender</th>
		         <th>Address</th>
		         <th>Avatar</th>
		         <th>Type Account</th>

		         <th>Change Password</th>
		         <th>Edit</th>
		         <th>Delete</th>
		      </tr>
		   </thead>
		   <tbody>
		   <?php /* @var $account account */ ?>
		   		<?php foreach ($listAccount as $account):?>
					<tr>
				         <td><?php echo $account->id?></td>
				         <td><?php echo htmlspecialchars( $account->username )?></td>
				         <td><?php echo htmlspecialchars( $account->firstname )?></td>
				         <td><?php echo htmlspecialchars( $account->lastname )?></td>
				         <td><?php echo $account->birthday?></td>
				         <td><?php
				                  echo $account->getStringGenger();
			                 ?>
		                 </td>
				         <td><?php echo htmlspecialchars( $account->address )?></td>

				         <td><img src="<?php echo __FOLDER.__FOLDER_UPLOADS.'/'.$account->avatar?>"></td>
				         <td>
    				         <?php
    				            if($account->type == 0)
    				                echo 'user';
    				            else{
    				                echo "N/A";
    				            }
    				         ?>
				         </td>
				         <td><button class="btn btn-primary change-pass"><span aria-hidden="true" class="icon-play"></span> &nbsp;CHANGE PASSWORD</button></td>
				         <td><button class="btn btn-primary edit-account"><span aria-hidden="true" class="icon-play"></span> &nbsp;EDIT</button></td>
						 <td><button class="btn btn-danger delete-account"><span aria-hidden="true" class="icon-play"></span> &nbsp;DELETE</button></td>
		      		</tr>
		   		<?php endforeach;?>
		   </tbody>
		</table>
		</div>
		<div class="pagination" id="menu-outer">
			<?php echo $pagination->html()?>
		</div>
<!--=============================BEGIN DIALOG ADD NEW PRODUCT================================================-->
		<div id="dialog-add-account" title="Add new account">
			<div class="error_account">
			</div>
			  <div class="border-style">
				   <table class="form_table">
				      <tbody>

				         <tr>
				            <td>User name <span class="error">(*)</span></td>
				            <td><input name="username" type="text" value="">
				            </td>
				         </tr>

				         <tr class="password">
				            <td>Password <span class="error">(*)</span></td>
				            <td><input name="password" type="password" value="">
				            </td>
				         </tr>

				         <tr class="repassword">
				            <td>Re Password <span class="error">(*)</span></td>
				            <td><input name="repassword" type="password" value="">
				            </td>
				         </tr>

				         <tr>
				            <td>First Name <span class="error">(*)</span></td>
				            <td><input name="firstname" type="text" value="">
				            </td>
				         </tr>

				         <tr>
				            <td>Last Name <span class="error">(*)</span></td>
				            <td><input name="lastname" type="text" value=""></td>
				         </tr>

				         <tr>
				            <td>Birthday <span class="error">(*)</span></td>
				            <td><input name="birthday" type="text" value=""> (yyyy-mm-dd)</td>
				         </tr>

				         <tr>
							<td>Gender <span class="error">(*)</span></td>
							<td>
							    <input id="gender_m" type="radio" name="gender" value="1">
								<label for="gender_m">Male</label>
								<input id="gender_y" type="radio" name="gender" value="0" >
								<label for="gender_y">Female</label>
							</td>
                         </tr>

				         <tr>
				            <td>Address <span class="error">(*)</span></td>
				            <td><input name="address" type="text" value=""></td>
				         </tr>

				          <tr>
							<td>Image <span class="error">(*)</span></td>
				            <td>
								<input maxlength="1" type="file" accept="gif|jpg|png" name="avatar" class="form-control multi with-preview"/>
								<br/>
								<img class="avatar" style="max-height: 100px;display: none" src="">
						 	</td>
						 </tr>

				         <tr>
				            <td colspan="2" class="form-button">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_addaccount" value="Create">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_updateaccount" value="Update">
				            	<span class="progress-loading"><img src="<?php echo __FOLDER . 'public/image/ajax-loader.gif'?>"></span>
				            </td>
				         </tr>


				      </tbody>
				   </table>
			</div>
		</div>
<!--=============================END DIALOG ADD NEW ACCOUNT================================================-->


<!--=============================BEGIN DIALOG ADD NEW PRODUCT================================================-->
		<div id="dialog-change-password" title="Change password account">
			<div class="error_account">
			</div>
			  <div class="border-style">
				   <table class="form_table">
				      <tbody>
				         <tr>
				            <td>Username <span class="error">(*)</span></td>
				            <td><span class="change-username"></span> </td>
				         </tr>
				         <tr>
				            <td>New password <span class="error">(*)</span></td>
				            <td><input name="newpassword" type="password" value=""> </td>
				         </tr>
				         <tr>
				            <td>Re New password <span class="error">(*)</span></td>
				            <td><input name="renewpassword" type="password" value=""> </td>
				         </tr>
				         <tr>
				            <td colspan="2" class="form-button">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_changepass" value="Change">
				            </td>
				         </tr>
				      </tbody>
				   </table>
			</div>
		</div>
<!--=============================END DIALOG ADD NEW ACCOUNT================================================-->


	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function () {
		accountmanager.init();
	});
</script>


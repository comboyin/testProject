<?php

$fistDay = ( int ) (date ( 'Y' ) - 70);
$lastDay = ( int ) (date ( 'Y' ) - 5);
/**
 * Trả về số ngày trong tháng.
 * @param int $month
 * @param int $year
 * @return int
 * */
function get_days_in_month($month, $year) {
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}
?>
			<div class="title">
				<a href="#">Create account</a>
			</div>

			<!-- BEGIN alert  -->
		      <?php if(isset($error)):?>
		      <div class="alert alert-error">
						<strong>Error! </strong>

		        <?php if(isset($error[ 'first_name']) && count($error[ 'first_name'])> 0):?>
		        <div class="item">
							<p>
								<strong>First name: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'first_name'] as $value):?>
		            <li>
		              <?php echo $value ?>
		            </li>
		            <?php endforeach;?>
		          </ul>
				</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'last_name']) && count($error[ 'last_name'])> 0):?>
		        <div class="item">
							<p>
								<strong>Last name: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'last_name'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'last_name']) && count($error[ 'last_name'])> 0):?>
		        <div class="item">
							<p>
								<strong>Last name: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'last_name'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'user_name']) && count($error[ 'user_name'])> 0):?>
		        <div class="item">
							<p>
								<strong>User name: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'user_name'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'password']) && count($error[ 'password'])> 0):?>
		        <div class="item">
							<p>
								<strong>Password: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'password'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'sex']) && count($error[ 'sex'])> 0):?>
		        <div class="item">
							<p>
								<strong>Gender: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'sex'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
				</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'address']) && count($error[ 'address'])> 0):?>
		        <div class="item">
							<p>
								<strong>Address: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'address'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'date']) && count($error[ 'date'])> 0):?>
		        <div class="item">
							<p>
								<strong>Date: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'date'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>

		        <?php if(isset($error[ 'avatar']) && count($error[ 'avatar'])> 0):?>
		        <div class="item">
							<p>
								<strong>Avatar: </strong>
							</p>
							<ul>
		            <?php foreach ($error[ 'avatar'] as $value):?>
		            <li>
		              <?php echo $value?>
		            </li>
		            <?php endforeach;?>
		          </ul>
						</div>
		        <?php endif;?>
		      </div>
		      <?php endif;?>

		      <!-- BEGIN alert  -->


			<div class="border-style">
				<form action="" method="post" enctype="multipart/form-data">
					<table class="form_table">
						<tr>
							<td>First Name <span class="error">(*)</span></td>
							<td><input name="first_name" type="text"
								value="<?php echo isset($_SESSION['first_name'])?htmlspecialchars($_SESSION['first_name']):'' ?>" />

							</td>
						</tr>
						<tr>
							<td>Last Name <span class="error">(*)</span></td>
							<td><input name="last_name" type="text"
								value="<?php echo isset($_SESSION['last_name'])?htmlspecialchars($_SESSION['last_name']):'' ?>" />

							</td>
						</tr>

						<tr>
							<td>User Name <span class="error">(*)</span></td>
							<td><input name="user_name" type="text"
								value="<?php echo isset($_SESSION['user_name'])?htmlspecialchars($_SESSION['user_name']):'' ?>" />
								<div name="username" class="user-wrong"></div></td>
						</tr>

						<tr>
							<td>Password <span class="error">(*)</span></td>
							<td><input name="password" type="password" value="" /></td>
						</tr>

						<tr>
							<td>Re-Password <span class="error">(*)</span></td>
							<td><input name="re_password" type="password" value="" /></td>
						</tr>

						<tr>
							<td>Birthday <span class="error">(*)</span></td>
							<td><select name="year" class="year">

									<option style="display: none;">Year</option>
                  <?php for($i=$fistDay;$i<=$lastDay;$i++):?>
                  <?php if(isset($_SESSION[ 'year']) && $_SESSION[ 'year']==$i):?>
                  <option selected="true" value="<?php echo $i?>">
                    <?php echo $i?>
                  </option>

                  <?php else :?>

                  <option value="<?php echo $i?>">
                    <?php echo $i?>
                  </option>
                  <?php endif;?>
                  <?php endfor;?>
                </select> <select name="month" class="month">
									<option selected="true" style="display: none;">Month</option>

                  <?php for($i=1;$i<=12;$i++):?>
                  <?php if (isset ( $_SESSION [ 'month'] ) && $_SESSION [ 'month']==$i) echo '<option selected="true"  value="' . $i . '">' . $i . '</option>'; else { echo '<option value="' . $i . '">' . $i . '</option>'; } ?>
                  <?php endfor;?>
                </select>
                <?php if (isset ( $_SESSION [ 'month'] ) && isset ( $_SESSION [ 'year'] )) { $days=get_days_in_month ( $_SESSION [ 'month'], $_SESSION [ 'year'] ); } ?>
                <select name="day" class="day">
									<option selected="true" style="display: none;">Day</option>
                  <?php if(isset($days)){ for($i=1 ; $i <=$days; $i ++) { if (isset ( $_SESSION [ 'day'] ) && $_SESSION [ 'day']==$i) { echo '<option selected="true"   value="' . $i . '">' . $i . '</option>'; } else { echo '<option  value="' . $i . '">' . $i . '</option>'; } } } ?>
                </select> <br /> <span class="tuoi">
							<?php if(isset($_SESSION['year'])):?>
										<?php
								$yearC = date ( "Y" );

								if (is_numeric ( $_SESSION ['year'] )) {
									$tuoi = $yearC - $_SESSION ['year'];
									echo "Your age is $tuoi";
								}
								?>

									<?php endif;?>

							</span></td>


						<tr>
							<td>Gender <span class="error">(*)</span></td>

							<td><input id="gender_m" type="radio" name="sex" value="1"
								<?php if (isset ( $_SESSION [ 'sex'] ) && $_SESSION [ 'sex']=="1" ) { echo 'checked'; } else if (! isset ( $_SESSION [ 'sex'] )) { echo 'checked'; } ?>>
								<label for="gender_m">Male</label> <input id="gender_y"
								type="radio" name="sex" value="0"
								<?php if (isset ( $_SESSION [ 'sex'] ) && $_SESSION [ 'sex']==0 ) { echo 'checked'; } ?>>
								<label for="gender_y">Female</label>
							</td>
                        </tr>

						<tr>
							<td>Address <span class="error">(*)</span></td>
							<td><input name="address" type="text"
								value="<?php echo isset($_SESSION['address'])?htmlspecialchars($_SESSION['address']):'' ?>" />
						</td>


						<tr>
							<td>Avatar <span class="error">(*)</span></td>
							<td><input accept="image/*" name="avatar" type="file" /></td>
						</tr>
						<tr>
							<td colspan="2" class="form-button"><input type="submit"
								class="btn btn-success hvr-pulse-grow" name="account"
								value="Create" /></td>

						</tr>
					</table>

				</form>
			</div>
<div class="widget widget_popular_entries">
	<h3 class="widget-title">Friend Request List</h3>
	<div class="row list-friend">
			<table class="table table-hover">
			      <thead>
			        <tr>
			          <th>Full name</th>
			          <th>Sex</th>
			          <th>Birthday</th>
			          <th>Address</th>
			          <th></th>
			          <th></th>
			        </tr>
			      </thead>
			      <tbody>
			      	<?php foreach ( $listFriendRequest as $FriendRequest ):?>
			      	<?php /* @var $FriendRequest Friend_request */ ?>
			      		<tr id_friend_request="<?php echo $FriendRequest->getId()?>" >
				          <td><?php echo htmlspecialchars( $FriendRequest->getUser()->getFullname() )?></td>
				          <td><?php echo htmlspecialchars( $FriendRequest->getUser()->getStringSex() )?></td>
				          <td><?php echo htmlspecialchars( $FriendRequest->getUser()->getBirthday() )?></td>
				          <td><?php echo htmlspecialchars( $FriendRequest->getUser()->getAddress() )?></td>
				          <td><button class="btn accept-request">Accept</button></td>
				          <td><button class="btn delete-request">Delete</button></td>
			        	</tr>
			      	<?php endforeach;?>
			      </tbody>
			</table>
			
	</div>
</div>

<html>
<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/friendRequest.js'?>"></script>
</html>
<?php 
	$listFollow = $listFollow;
?>
<div class="widget widget_popular_entries">
	<h3 class="widget-title">Follow list</h3>
	<div class="row list-friend">

		<table class="table table-follow-list" >
			<tbody>
				<?php /* @var $followlog Follow_log */?>
				<?php foreach ( $listFollow as $followlog ):?>
					<tr>
						<td style="width: 140px"><a href="<?php echo __FOLDER . 'user/action/profile/' . $followlog->getFollow()->getUserto()->getUsername()?>"><?php echo htmlspecialchars( $followlog->getFollow()->getUserto()->getFullname() )?></a></td>
						<td style="width: 180px"><span><?php echo $followlog->getAction()?></span></td>
						<td style="width: 190px"><a href="<?php echo __FOLDER . 'user/action/profile/' . $followlog->getUseridTo()->getUsername()?>"><?php echo htmlspecialchars($followlog->getUseridTo()->getFullname())?></a>
						</td>
						
						<td style="width: 190px"> <?php echo htmlspecialchars( $followlog->getRegistDatetime() )?> </td>
						
						<td>
							<?php if( $followlog->getStatus() == 0 ):?>
										<img class="img-new" src="<?php echo __FOLDER . "public/img/new.png"?>">
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
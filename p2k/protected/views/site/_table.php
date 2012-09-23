<? if( isset( $sGameName ) ){ ?>
	<p><b><?=$sGameName?></b></p>
<? } ?>

<table class="tabel table-bordered table-striped">
	<tr>
		<th>Имя</th>
		<th>Угадано</th>
	</tr>
	<?php foreach( $aStat as $aItem ) {?>
		<tr>
			<td><a href="/user/<?=$aItem['userid']?>"><?=$aItem['username']?></a></td>
			<td><?=$aItem['win']?></td>
		</tr>
	<?php }?>
</table>
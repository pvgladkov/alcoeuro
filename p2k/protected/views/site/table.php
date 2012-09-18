<?php $this->pageTitle=Yii::app()->name; ?>

<br />
<br />
<br />
<div class="page-header">
	<h2>Алкорейтинг</h2>
</div>

<?php if( !empty($aStat) ) { ?>

	<table class="tabel table-bordered table-striped">
		<tr>
			<th>Имя</th>
			<th>Угадано</th>
		</tr>
		<?php foreach( $aStat as $aItem ) {?>
			<tr>
				<td><?=$aItem['username']?></td>
				<td><?=$aItem['win']?></td>
			</tr>
		<?php }?>
	</table>
<?php } ?>
<br />


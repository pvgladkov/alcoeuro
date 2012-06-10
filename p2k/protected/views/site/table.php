<?php $this->pageTitle=Yii::app()->name; ?>

<br />
<br />
<br />
<h2>Алкорейтинг</h2>

<table class="tabel table-bordered table-striped">

	<?php foreach( $aSt as $st ) {?>
	<tr>
		
			<td class="ar"><?php echo UserIdentity::getUserName($st['id'])?></td>
			<td class="ar"><?= $st['score']?></td>
		
	</tr>
	<?php }?>

</table>

<br />


<?php $this->pageTitle=Yii::app()->name; ?>

<br />
<br />
<br />
<div class="page-header">
	<h2>Алкорейтинг</h2>
</div>

<?php if( !empty($aStat) ) { 
	$this->renderPartial(
		'_table',
		array(
			'aStat' => $aStat
		)
	);
 } ?>
<br />


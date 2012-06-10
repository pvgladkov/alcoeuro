<?php $this->pageTitle=Yii::app()->name; ?>

<br />
<br />
<br />
<h2>Алкорейтинг</h2>

<table class="table">
	<tr>
		<th>Имя</th>
		<th>Литры</th>
	</tr>
	<tr>
		<th>Дима</th>
		<th><?= $aStat[1]?></th>
	<tr>
		<th>Павел</th>
		<th><?= $aStat[2]?></th>
	</tr>
	<tr>
		<th>Матвей</th>
		<th><?= $aStat[3]?></th>
	</tr>
	<tr>
		<th>Жора</th>
		<th><?= $aStat[4]?></th>
	</tr>

<?php 
/*
$this->widget('bootstrap.widgets.BootThumbs', array(
    'dataProvider'=>$oUserList,
    'template'=>'{items}<tr><td colspan="10">{pager}</td></tr>',
    'itemView'=>'_item',
    // Remove the existing tooltips and rebind the plugin after each ajax-call.
    'afterAjaxUpdate'=>"js:function() {
        jQuery('.tooltip').remove();
        jQuery('a[rel=tooltip]').tooltip();
    }",
)); 
*/
?>
</table>

<br />


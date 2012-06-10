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


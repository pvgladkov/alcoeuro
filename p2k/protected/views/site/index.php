<?php $this->pageTitle=Yii::app()->name; ?>

<br/>
<br/>
<br/>

<h2>Групповой этап</h2>
<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="75%"> 
		<table class="table table-bordered" >

		<?php 

		$this->widget('bootstrap.widgets.BootThumbs', array(
			'dataProvider'=>$oMatchList,
			'template'=>'{items}<tr><td colspan="10">{pager}</td></tr>',
			'itemView'=>'_match',
			// Remove the existing tooltips and rebind the plugin after each ajax-call.
			'afterAjaxUpdate'=>"js:function() {
				jQuery('.tooltip').remove();
				jQuery('a[rel=tooltip]').tooltip();
			}",
		)); 

		?>
		</table>
		
		</td>
		
	</tr>
</table>

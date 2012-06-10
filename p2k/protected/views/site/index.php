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
		<td width="25%"> 
	
			<table class="tabel table-bordered" style="position: fixed; width: 20%; top: 103px">

				<?php foreach( $aSt as $st ) {?>
				<tr>

						<td class="ar"><?php echo UserIdentity::getUserName($st['id'])?></td>
						<td class="ar"><?= $st['score']?></td>

				</tr>
				<?php }?>

			</table>
		</td>
	</tr>
</table>

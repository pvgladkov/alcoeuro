<?php

/**
 * Класс, расширяющий CActiveForm
 * 
 * @author Zagirov Rustam <rustam@zagirov.name>
 */

class IDPActiveForm extends CActiveForm
{
	
	private $_autoError = null;
	private $_bNotError = false;
	private $_bNotLabel = false;
	
	public function errorSummary( $models, $header=null, $footer=null, $htmlOptions=array() ){
		
		// ничего не выводить, если ошибок нет
		
		$models = ( is_array($models) )? $models: array($models);
		$bExistErrors = false;
		foreach( $models as $m ){
			if( $m->getErrors() ){
				$bExistErrors = true;
			}
		}
		
		if( !$bExistErrors ){
			return '';
		}
		
		return parent::errorSummary($models,$header,$footer,$htmlOptions);
		
	}
	
	public function imageField( $model, $attribute, $options ){
		
		$bEditDisable = ( !empty( $options['disabled'] ) );
		
		if( $model->$attribute ){
			
			$sFilePath = Yii::app()->params['image_dir'] . $model->$attribute;
			if( file_exists( $sFilePath ) ){
				$aSize = getimagesize( $sFilePath );
				if( $aSize ){
					
					$sPreviewStr = '';
					if( $aSize[1] > 100 ){
						$sPreviewStr = 'height="80"';
					}elseif( $aSize[0] > 300 ){
						$sPreviewStr = 'width="250"';
					}
					
					?>
					<div style="width: 300; float: left;">
						<?
						$src = Yii::app()->url->getImagesAbs( $model->$attribute );
						if( $sPreviewStr ) echo '<a href="' . $src . '" class="uselightbox">';
							?><img src="<?= $src ?>" <?= $sPreviewStr ?> /><?
						if( $sPreviewStr ) echo '</a>';
						?>
					</div>
					<?
					
				}
			}else{
				echo 'ошибка. файл на сервере не найден<br />'.$sFilePath;
			}
			
			?>
			<div style="float: right; width: 20px;">
				<a href="#" onclick="return false;" class="remove-image-option" data-sOption="<?=$attribute?>" data-iModelId="<?= $model->id ?>" data-sModelName="<?= get_class( $model ) ?>">уд</a>
			</div>
			<?
			
		}else{
			echo 'файл не загружен';
		}
		
		if( !$bEditDisable ){
			?><div style="width: 500px; float: right;"><?= $this->fileField( $model, $attribute, $options ) ?></div><?
		}
				
		?><div style="clear: both;"></div><?
		
		
	}
	
	public function swfField( $model, $attribute, $options ){
		
		$bEditDisable = ( !empty( $options['disabled'] ) );
		
		if( $model->$attribute ){
			
			$sFilePath = Yii::app()->params['image_dir'] . $model->$attribute;
			if( file_exists( $sFilePath ) ){
				?><a href="<?= Yii::app()->url->getImagesAbs( $model->$attribute ) ?>" target="_blank">см</a><?
			}else{
				echo 'ошибка. файл на сервере не найден<br />'.$sFilePath;
			}
			
			?>
			<div style="float: right; width: 20px;">
				<a href="#" onclick="return false;" class="remove-image-option" data-sOption="<?=$attribute?>" data-iModelId="<?= $model->id ?>" data-sModelName="<?= get_class( $model ) ?>">уд</a>
			</div>
			<?
			
		}else{
			echo 'файл не загружен';
		}
		
		if( !$bEditDisable ){
			?><div style="width: 500px; float: right;"><?= $this->fileField( $model, $attribute, $options ) ?></div><?
		}
				
		?><div style="clear: both;"></div><?
		
		
	}
	
	public function checkbox( $model, $attribute, $options = array() ){
		
		if( !isset( $options['style'] ) ){
			$options['style'] = 'vertical-align: middle;';
		}
		return parent::checkbox( $model, $attribute, $options );
		
	}
	
	public function birthday( $model, $attribute, $options = array(), $sDelimiter = '&nbsp;' ){
		
		$sFieldHtml = '';
		
		$aDayList = array( '' => 'День' );
		for( $i = 1; $i <= 31; $i++ ){
			$aDayList[ $i ] = $i;
		}
		$sFieldHtml .= $this->dropDownList( $model, 'bday', $aDayList );
		
		$sFieldHtml .= $sDelimiter;
		
		$aMonthList = array( '' => 'Месяц' ); 
		for( $i = 1; $i <= 12; $i++ ){
			$aMonthList[ $i ] = idsTransData::getMonthName( 60*60*24*28*$i );
		}		
		$sFieldHtml .= $this->dropDownList( $model, 'bmonth', $aMonthList );
		
		$sFieldHtml .= $sDelimiter;
		
		$iYearFrom = ( isset( $options['year']['from'] ) )? $options['year']['from']: 101;
		$iYserTo	= ( isset( $options['year']['to'] ) )? $options['year']['to']: 13;
		$iYearStart = date('Y') - $iYearFrom; 
		$iYearEnd = date('Y') - $iYserTo;
		$aYearList = array( '' => 'Год' );
		for( $i = $iYearEnd; $i >= $iYearStart; $i-- ){
			$aYearList[ $i ] = $i;
		}
		$sFieldHtml .= $this->dropDownList( $model, 'byear', $aYearList ); 
		
		return $sFieldHtml;
		
	}
	
	public function phoneField( $model, $attribute, $options, $sNextField = 'user_wish', $sDelimiter = '&nbsp;' ){
		
		$sFieldHtml = '';
		
		$sFieldHtml .= '+7' . $sDelimiter;
		
		foreach(array(3,3,2,2) as $key=>$value){
			 
			$sFieldHtml .= $this->textField(
				$model,
				$attribute . ( $key + 1 ),
				array(
					'maxlength'	=> $value,
					'class'		=> 'i-text di' . $value . ' i-tel-'.$value)
			) . $sDelimiter;
			
			if( $key == 1 || $key == 2 ){
				$sFieldHtml .= '-' . $sDelimiter;
			}
			
		}
		
		ob_start();
        ?>
		<script type="text/javascript">
			$(function(){
				$('#<?= $model->getName() ?>_<?=$attribute?>1').keyup(function() {
					if ( $(this).val().length==3) {
						$('#<?= $model->getName() ?>_<?=$attribute?>2').focus();
					}
				});
				$('#<?= $model->getName() ?>_<?=$attribute?>2').keyup(function() {
					if ( $(this).val().length==3) {
						$('#<?= $model->getName() ?>_<?=$attribute?>3').focus();
					}
				});
				$('#<?= $model->getName() ?>_<?=$attribute?>3').keyup(function() {
					if ( $(this).val().length==2) {
						$('#<?= $model->getName() ?>_<?=$attribute?>4').focus();
					}
				});
				$('#<?= $model->getName() ?>_<?=$attribute?>4').keyup(function() {
					if ( $(this).val().length==2) {
						$('#<?= $model->getName() ?>_<?=$sNextField?>>').focus();
					}
				});
			});
		</script>
        <?
        
        $sFieldHtml .= ob_get_clean();
        
        return $sFieldHtml;
	
	}
	
	public function password( $model, $attribute, $options = array() ){
		
		ob_start();
		
		$sPass2			= $attribute.'2';
		$sPassDiv		= $attribute.'Div';
		$sPass2Div		= $attribute.'2Div';
		$sPassFieldID	= $this->getId() . '_' . $attribute;
		$sPass3FieldID	= $this->getId() . '_' . $attribute.'3';
		$sPassEm		= $this->getId() . '_' . $attribute.'_em_';
		
		?>
				<div class="field">
					<?= $this->textField( $model, $attribute, $options ); ?>
					&nbsp;
					&nbsp;
					<a href="#" onclick="return _hidePass_<?= $attribute ?>();" class="<?=$sPassDiv?> dashed-link">скрыть текст пароля</a>
					<a href="#" onclick="return _showPass_<?= $attribute ?>();" class="<?=$sPass2Div?> dashed-link" style="display: none;">Показать пароль</a>
				</div>
				<?= $this->hiddenField( $model, $attribute.'3' ); ?>
				
			</div>
			
			<div class="row <?=$sPass2Div?> required-field" style="display: none;">
				<div class="label"><?= $this->labelEx($model,'password2'); ?></div>
				<div class="field"><?= $this->passwordField( $model, $attribute.'2', $options ); ?></div>
			
			<script type="text/javascript">
				function _hidePass_<?= $attribute ?>(){
					$('.<?=$sPassDiv?>').hide();
					$('.<?=$sPass2Div?>').show();
					_toggleText2Password('<?=$sPassFieldID?>');
					return false;
				}
				function _showPass_<?= $attribute ?>(){
					$('.<?=$sPassDiv?>').show();
					$('.<?=$sPass2Div?>').hide();
					_toggleText2Password('<?=$sPassFieldID?>');
					return false;
				}
				function _toggleText2Password(id){
					ob = $('#'+id);
					var name	= ob.attr('name');
					var value	= ob.attr('value');
					var style	= ob.attr('style');
					var sclass	= ob.attr('class');
					var size	= ob.attr('size');
					var iid	= ob.attr('id');
					newType		= ( ob.attr('type') == 'text' )? 'password': 'text';
					$('#<?=$sPass3FieldID?>').val(newType);
					$('#<?=$sPassEm?>').html('').hide();
					ob.parents('div.error').removeClass('error');
					ob.parents('div.error').removeClass('success');
					var html = '<input type="' + newType + '" name="' + name + '" value="' + value + '" class="' + sclass + '" id="' + iid + '" style="' + style + '" size="' + size + '" />';
					ob.after(html).remove();
				}
			</script>
			
		<?
		$sFieldHtml = ob_get_clean();
		
		return $sFieldHtml;
		
	}
	
	
	/**
	* собственный вывод списка чекбоксов (упрощенный)
	* 
	* @param CModel $model
	* @param string $attribute
	* @param array $aOptions
	* @param array $htmlOptions
	*/
	public function checkBoxListMy( $model, $attribute, $aOptions, $htmlOptions = array() ){
		
		$aSelected = $model->$attribute;
		
		CHtml::resolveNameID($model,$attribute,$htmlOptions);
		
		foreach( $aOptions as $value => $label ){
			
			$sIsChecked = ( in_array( $value, $aSelected ) )
				? 'checked="Y"'
				: '';
			
			?>
			<input value="<?= $value ?>" type="checkbox" name="<?= $htmlOptions['name'] ?>[]" id="<?= $htmlOptions['id'] ?>_<?= $value ?>" <?=$sIsChecked?> />
			&nbsp;
			<label for="<?= $htmlOptions['id'] ?>_<?= $value ?>"><?= $label ?></label>
			<?
			
			if( $value !== end( array_keys($aOptions) ) ){
				echo '<br />';
			}
			
		}
		
	}
	
	
	/**
	* хелперы
	*/
	
	
	/**
	* собрать верстку поля формы
	* 
	* @param string $sFieldType
	* @param CActiveRecord $model
	* @param mixed $attribute
	*/
	public function autoField( $sFieldType, $model, $attribute ){
		
		$sRowClass = 'row';
		
		if( $model->isAttributeRequired( $attribute ) ){
			$sRowClass .= ' required-field';
		}
			
		$args = func_get_args();
		
		?>
		<div class="<?=$sRowClass?>">
		
			<? if( !$this->_bNotLabel ){ ?>
				<div class="label">
					<?= $this->labelEx($model,$attribute); ?>
				</div>
			<? } ?>
			
			<div class="field">
			<?
			
			$sFieldHtml = '';
			$sHint = '';
			
			switch( $sFieldType ){
				
				case 'textField':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					if( empty($args[3]) ) $args[3] = array();
					if( empty($args[3]['class'] ) ) $args[3]['class'] = 'i-text';
					$sFieldHtml = $this->textField( $model, $attribute, $args[3] );
					break;
				
				case 'mailruLogin':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					$sFieldHtml = $this->textField( $model, $attribute, $args[3] );
					$sFieldHtml .= '&nbsp;&nbsp;@&nbsp;&nbsp;' . $this->dropDownList( $model, 'domain', $model->getDomains(true), array( 'class' => 'i-text') );
					break;
				
				case 'passwordField':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					if( empty($args[3]) ) $args[3] = array();
					if( empty($args[3]['class'] ) ) $args[3]['class'] = 'i-text';
					$sFieldHtml = $this->passwordField( $model, $attribute, $args[3] );
					break;
				
				case 'checkbox':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					$sFieldHtml = $this->checkbox( $model, $attribute, @$args[3] );
					break;
					
				case 'textarea':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					if( empty($args[3]) ) $args[3] = array();
					if( empty($args[3]['class'] ) ) $args[3]['class'] = 'i-text';
					$sFieldHtml = $this->textarea( $model, $attribute, $args[3] );
					break;
				
				case 'dropDownList':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					if( empty($args[3]) ) $args[3] = array();
					$sFieldHtml = $this->dropDownList( $model, $attribute, $args[3] );
					break;
				
				case 'birthday':
					if( !empty( $args[3] ) ) $sHint = $args[3];
					$sFieldHtml = $this->birthday( $model, $attribute );
					break;
				
				case 'phoneField':
					if( !empty( $args[3] ) ) $sHint = $args[3];
					if( empty($args[4]) ) $args[4] = array();
					if( empty($args[4]['class'] ) ) $args[4]['class'] = 'i-text';
					$sFieldHtml = $this->phoneField( $model, $attribute, $args[4] );
					break;
				
				case 'radioButtonList':
					if( !empty( $args[5] ) ) $sHint = $args[5];
					$sFieldHtml = $this->radioButtonList( $model, $attribute, $args[3], $args[4] );
					break;
				
				case 'checkBoxList':
					if( !empty( $args[6] ) ) $sHint = $args[6];
					if( empty( $args[5] ) ) $args[5] = false;
					if( empty( $args[4] ) ) $args[4] = false;
					$sFieldHtml = $this->checkBoxList( $model, $attribute, $args[3], $args[4], $args[5] );
					break;
				
				case 'checkBoxListMy':
					$sFieldHtml = $this->checkBoxListMy( $model, $attribute, $args[3] );
					break;
				
				case 'password':
					if( !empty( $args[4] ) ) $sHint = $args[4];
					if( empty($args[3]) ) $args[3] = array();
					if( empty($args[3]['class'] ) ) $args[3]['class'] = 'i-text';
					$sFieldHtml = $this->password( $model, $attribute, $args[3] );
					break;
				
			}
			
			
			if( $sHint ){
				?>
				<div class="aside-field">
					<?= $sFieldHtml ?>
				</div>
				<div class="aside-hint">
					<div class="hint"><?= $sHint ?></div>
				</div>
				<?
			}else{
				echo $sFieldHtml;
			}
			
			?>
			</div>
			
			<? if( !$this->_bNotError ){ ?>
				<div class="errorMessage">
					<?= ( $this->_autoError )? $this->_autoError: $this->error( $model, $attribute ); ?>
				</div>
			<? } ?>
			
		</div>
		<?
		
		
		$this->_autoError = null;
		
		
	}
	
	/**
	* параметры для вывода поля ошибки
	* 
	* @param CModel $model
	* @param string $attribute
	* @param array $htmlOptions
	* @param boolean $enableAjaxValidation
	* @param boolean $enableClientValidation
	*/
	public function setAutoErrorParams( $model, $attribute, $htmlOptions = array(), $enableAjaxValidation = true, $enableClientValidation = false ){
		
		$this->_autoError = $this->error( $model, $attribute, $htmlOptions, $enableAjaxValidation, $enableClientValidation );
		
	}
	
	/**
	* убрать поля ошибок под полями
	* 
	*/
	public function doNotErrors(){
		
		$this->_bNotError = true;
		
	}
	
	/**
	* убрать labels
	* 
	*/
	public function doNotLabels(){
		
		$this->_bNotLabel = true;
		
	}
	
}

?>
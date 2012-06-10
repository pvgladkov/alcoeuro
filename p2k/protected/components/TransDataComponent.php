<?php


class TransDataComponent
{


	/**
	 * разбить по строкам в массив
	 * многострочный текст
	 * все тримится
	 * 
	 * @example
	 * 
	 * 		$aDenyEmails = ( isset( $_POST['deny'] ) )
	 * 			? self::getStringArrayFromText($_POST['deny'])
	 * 			: false;
	 * 
	 * @param string $sText
	 * @return array
	 */
	public static function getStringArrayFromText( $sText ){
		
		$sText = trim( $sText );
		
		$aList = explode( "\n", $sText );
		
		$aResultList = array();
		
		foreach ( $aList as $item ){
			$item = trim( $item );
			if( $item ){
				$aResultList[] = $item;
			}
		}
		
		return $aResultList;
		
	}

	/**
	 * генерация пароля
	 *
	 * @param integer $iPassSize
	 * @return unknown
	 */
	public static function getRandomPass( $iStartPassSize = 10, $bLettersOnly = false ){
		
		if( $iStartPassSize <= 6 ){
			$iStartPassSize = 10;
		}
		$iStartPassSize -= 4;
		
		$iPassSize = $iStartPassSize + mt_rand(4, 8);
		
		$arr = array(
			'g','h','i','j','k','l',
			'g','h','i','j','k','l',
			'a','b','c','d','e','f',
			'a','b','c','d','e','f',
			'g','h','i','j','k','l',
			'g','h','i','j','k','l',
			't','u','v','x','y','z',
			't','u','v','x','y','z',
			't','u','v','x','y','z',
			'A','B','C','D','E','F',
			'7','8','9','0',
			'M','N','O','P','R','S',
			'M','N','O','P','R','S',
			'T','U','V','X','Y','Z',
			'T','U','V','X','Y','Z',
			'G','H','I','J','K','L',
			'G','H','I','J','K','L',
			'1','2','3','4','5','6',
			'1','2','3','4','5','6',
			'1','2','3','4','5','6',
			'a','b','c','d','e','f',
			'1','2','3','4','5','6',
			'T','U','V','X','Y','Z',
			'T','U','V','X','Y','Z',
			'7','8','9','0',
			'7','8','9','0',
			'7','8','9','0',
			'A','B','C','D','E','F',
			'M','N','O','P','R','S',
			'm','n','o','p','r','s',
		);
		
		
		if( !$bLettersOnly ){
			
			$arr = array_merge( $arr, array(
				'&','^','%','@','*','$',
				'(',')','[',']','!','?',
				'|','+','-',
				'{','}',
			));
			
		}

		$pass = "";
		
		for($i = 0; $i < $iPassSize; $i++){
			$index = mt_rand(1, count($arr) - 2);
			$pass .= $arr[$index];
		}
		
		return $pass;

	}

	/**
	* конвертация массива в stdClass объект
	* 
	* @param array $array
	* @return stdClass
	*/
	public static function arrayToObject($array) {
	    if(!is_array($array)) {
	        return $array;
	    }
	    
	    $object = new stdClass();
	    if (is_array($array) && count($array) > 0) {
	      foreach ($array as $name=>$value) {
	         $name = strtolower(trim($name));
	         if (!empty($name)) {
	            $object->$name = self::arrayToObject($value);
	         }
	      }
	      return $object; 
	    }
	    else {
	      return FALSE;
	    }
	}

	/**
	* Склонение слов
	* 
	* @param $iNum Количество
	* @param $aDeclensions
	* 	Массив склонений, три значения,
	* 	например, array('(5) штук', '(1) штука', '(2) штуки')
	*/
	static public function numDeclension($iNum, $aDeclensions){
	    $sRet = "";
	    $iNum = intval($iNum);
	    $iTen=0; //десяток
	    $iOne=0; //единицы      
	    if($iNum < 10){
	        $iOne = $iNum;
	    } else{
	        $iOne = $iNum - floor($iNum/10)*10;
	        if($iNum>9){
	            $iTen = floor(($iNum-floor( $iNum / 100 )*100)/10);
	        }
	    }       
	    if($iTen == 1){
	        $sRet = $aDeclensions[0];
	    }
	    elseif(in_array($iOne, array(2,3,4))){ 
	        $sRet = $aDeclensions[2];
	    }
	    elseif($iOne==1){
	        $sRet = $aDeclensions[1];
	    } else {
	        $sRet = $aDeclensions[0];
	    }
	    return $sRet;
	}
	
	
	
	
	/**
	* 
	* дата и время
	* 
	*/

	/**
	 * возвращает название месяца на русском языке
	 * @param int $iTs
	 * @return str
	 */
	public static function getMonthName( $iTs ) {
		if( !is_numeric($iTs) ){
			$iTs = strtotime($iTs);
		}
		$aMonths = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
		return $aMonths[ date( 'n', $iTs ) ];
	}

	/**
	 * возвращает название месяца на русском языке
	 * в предложном падеже (январе, феврале и т.п.)
	 * 
	 * @param int $iTs
	 * @return str
	 */
	public static function getMonthNamePrepositional( $iTs ) {
		if( !is_numeric($iTs) ){
			$iTs = strtotime($iTs);
		}
		$aMonths = array('', 'январе', 'феврале', 'марте', 'апреле', 'мае', 'июне', 'июле', 'августе', 'сентябре', 'октябре', 'ноябре', 'декабре');
		return $aMonths[ date( 'n', $iTs ) ];
	}
	
	/**
	 * возвращает название дня недели на русском языке
	 * @param int $iTs
	 * @return str
	 */
	public static function getWeekDayName( $iTs ) {
		$aWeekDays = array('', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье' );
		return $aWeekDays[ date( 'N', $iTs ) ];
	}

	/**
	 * возвращает название дня недели на русском языке
	 * в винительном падеже
	 * @param int $iTs
	 * @return str
	 */
	public static function getWeekDayNameAccusative( $iTs ) {
		$aWeekDays = array('', 'понедельник', 'вторник', 'среду', 'четверг', 'пятницу', 'субботу', 'воскресенье' );
		return $aWeekDays[ (int) date( 'N', $iTs ) ];
	}

	/**
	 * возвращает название дня недели на русском языке
	 * в родительном падеже
	 * @param int $iTs
	 * @return str
	 */
	public static function getWeekDayNameGenitive( $iTs ) {
		$aWeekDays = array('', 'понедельника', 'вторника', 'среды', 'четверга', 'пятницы', 'субботы', 'воскресенья' );
		return $aWeekDays[ (int) date( 'N', $iTs ) ];
	}

	/**
	 * возвращает int дату по строке формата "2010-11-11"
	 * @param str $sDate
	 * @return int
	 */
	public static function getTsByMysqlDate( $sDate ) {
		
		$sDate = current( explode( " ", $sDate) );
		
		// получаем месяц и день
		list($y, $m, $d) = explode("-", $sDate);
		
		return mktime( null, null, null, $m, $d, $y);
	}

	/**
	 * возвращает int дату по строке формата "11.11.2010"
	 * @param str $sDate
	 * @return int
	 */
	public static function getTsByHumDate( $sDate ) {
		
		$sDate = current( explode( " ", $sDate) );
		
		// получаем месяц и день
		list($d, $m, $y) = explode(".", $sDate);
		
		return mktime( null, null, null, $m, $d, $y);	
	}

	/**
	 * превращает дату int в дату формата "11 октября"
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getDayMonthStringByTimestamp( $iTs, $sDelimiter = ' ' ) {
		
		return date("j", $iTs) . $sDelimiter . self::getMonthName( $iTs );
	}

	/**
	 * превращает дату формата "2010-11-11" в дату формата "11 октября"
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function  getDayMonthStringByMysqlDate( $sDate, $sDelimiter = ' ' ) {
		
		if( !is_numeric( $sDate ) ){
			$iTs = self::getTsByMysqlDate( $sDate );
		}else{
			$iTs = $sDate;
		}
		
		return self::getDayMonthStringByTimestamp( $iTs, $sDelimiter );
	}

	/**
	 * превращает дату формата int в дату формата "11 октября" если 2010 год сейчас
	 * и "2010-11-11" в дату "11 октября 2009"
	 *
	 * @param int $iTs
	 * @return string
	 */
	public static function getDayMonthYearStringByTimestamp( $iTs, $sDelimiter = ' ' ) {
		
		if( $iTs <= 0 || strpos( $iTs, '00') === 0 ){
			return false;
		}
		
		if( !is_numeric( $iTs ) ){
			$iTs = strtotime( $iTs );
		}
		
		$iYear = date( 'Y', $iTs );
		
		return self::getDayMonthStringByTimestamp( $iTs, $sDelimiter ) .
			( date( 'Y' ) != $iYear ? ' ' . $iYear : '' )
		;
	}
	
	/**
	 * превращает дату формата "2010-11-11" в дату формата "11 октября" если 2010 год сейчас
	 * и "2010-11-11" в дату "11 октября 2009"
	 *
	 * @param str $sDate
	 * @return string
	 */
	public static function getDayMonthYearStringByMysqlDate( $sDate, $sDelimiter = ' ' ) {
		
		$iTs = ids_getTsByMysqlDate( $sDate );
		
		return self::getDayMonthYearStringByTimestamp( $iTs, $sDelimiter );
	}
	
	/**
	 * превращает дату формата "2010-11-11" в дату формата "вторник, 11 октября"
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getDayMonthWeekDayStringByMysqlDate( $sDate, $sDelimiter = ' ' ){
		
		$iTs = self::getTsByMysqlDate( $sDate );
		
		return self::getWeekDayName( $iTs ) . ', ' . date("j", $iTs) . $sDelimiter . self::getMonthName( $iTs );
	}

	/**
	 * превращает дату формата "2010-11-11" в дату формата "вторник, 11 октября" в винительном падеже
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getDayMonthWeekDayStringByMysqlDateAccusative( $sDate, $sDelimiter = ' ' ){
		
		$iTs = self::getTsByMysqlDate( $sDate );
		
		return self::getWeekDayNameAccusative( $iTs ) . ', ' . date("j", $iTs) . $sDelimiter . self::getMonthName( $iTs );
	}

	/**
	 * по дате формата 2010-01-01 находит предлог в или во, в зависимости от дня недели
	 * вторник во, остальные случаи в
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getPreWeekDayAccusative( $sDate ){
		
		$iTs = self::getTsByMysqlDate( $sDate );
		
		return date( 'N', $iTs ) == 2 ? 'во' : 'в';
	}

	/**
	 * по дате формата 2010-01-01 находит предлог в или во, в зависимости от дня недели
	 * вторник во, остальные случаи в
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getHumDayRelByTimestamp( $iTs ){
		
		switch( date( 'Y-m-d', $iTs ) ) {
			case date( 'Y-m-d' ):
				return 'сегодня';
			break;
			case date( 'Y-m-d', strtotime( '+1 day' ) ):
				return 'завтра';
			break;
			case date( 'Y-m-d', strtotime( '+2 day' ) ):
				return 'послезавтра';
			break;
			case date( 'Y-m-d', strtotime( '-1 day' ) ):
				return 'вчера';
			break;
			case date( 'Y-m-d', strtotime( '-2 day' ) ):
				return 'позавчера';
			break;
		}
		
		return '';
	}

	/**
	 * превращает дату формата "11.11.2010" в дату формата "11 октября"
	 *
	 * @param string $sDate
	 * @return string
	 */
	public static function getDayMonthStringByHumDate( $sDate, $sDelimiter = ' ' ){
		
		$iTs = self::getTsByHumDate( $sDate );
		
		return self::getDayMonthStringByTimestamp( $iTs, $sDelimiter );
	}
	
	/**
	* возвращает время-дату формата 12 апреля 9:34 
	* 
	* @param int $mDt время строкой или timestamp
	* @param strging $sDelimiter
	*/
	public static function getHumanDateTime( $mDt, $sDelimiter = ' ' ){
		
		if( $mDt <= 0 || strpos( $mDt, '00') === 0 ){
			return false;
		}
		if( !is_numeric($mDt) ){
			$mDt = strtotime( $mDt );
		}
		return self::getDayMonthYearStringByTimestamp( $mDt ) . $sDelimiter . date('G:i', $mDt );
		
	}
	
	
	/**
	* превращение набора из 10 цифр в
	* читаемый номер телефона
	* 
	* @param string $sPhone
	* @param string $sDelimiter
	*/
	public static function getHumanPhone( $sPhone, $sDelimiter = '&nbsp;' ){
		
		$sPhone = trim($sPhone);
		$sPhone = preg_replace( '/[^\d]+/', '', $sPhone );
		
		if( strlen( $sPhone ) != 10 ){
			return $sPhone;
		}
		
		return '+7'
			. $sDelimiter 
			. $sPhone[0] . $sPhone[1] . $sPhone[2]
			. $sDelimiter
			. $sPhone[3] . $sPhone[4] . $sPhone[5]
			. '-'
			. $sPhone[6] . $sPhone[7]
			. '-'
			. $sPhone[8] . $sPhone[9];
		
	}
	
	
	/**
	* Представление суммы в более красивом виде
	* 
	* @param Int $summ Число
	* @param Bool $nbsp Менять на &nbsp; вместо пробела?
	*/
	public static function getPriceFormat($summ, $nbsp=false){
		( $nbsp ) ? $nbsp = '&nbsp;' : $nbsp = ' ';
		$summ = number_format($summ,0,'.',' ');
		$summ = str_replace(' ', $nbsp, $summ);
		return $summ;
	}
	
	
	/**
 	* Обрезает строку $string до количества символов, равного $length с учетом слов
 	*
	* @param string $string - строка, которую нужно ограничить по длине
 	* @param integer $length - длина строки на выходе
 	* @param string $etc - добавочная строка, которая показывается в конце, если строка прошла резку
 	* @param bool $break_words - если параметр установлен в false, то строка будет обрезана с учетом слов
 	* @param bool $middle
 	* @return string
 	* 
 	* @example 
 	* 
 	* ids_truncateStr($text, 150);
 	* 
 	*/
	public static function truncateStr($string, $length = 80, $etc = '...', $break_words = false, $middle = false){
		$string = htmlspecialchars_decode($string);
		$string = strip_tags($string);
	
		if ($length == 0){
			return '';
		}
		if (mb_strlen($string) > $length) {   
		
			if (!$break_words && !$middle) {
			
				$sstr = mb_substr( $string, 0, $length+1 );       
				$astr = explode( " ", $sstr );   
				if( count($astr) > 1 ){
					array_pop( $astr );
				}
				$string = implode(" ", $astr);
			}
			if(!$middle) {
				return mb_substr($string, 0, $length) . $etc;
			} else {
				return mb_substr($string, 0, $length/2) . $etc . mb_substr($string, -$length/2);
			}
		} else {
		return $string;
		}
	}
	
	
	
	/**
 	* автоматический контроль слешей
 	* @param string $iActionId идентификатор акции
 	* @return string
 	*/
	public static function ss($sStr) {
		if (get_magic_quotes_gpc()==1) return stripslashes($sStr);
		else return $sStr;
	}
	   

}
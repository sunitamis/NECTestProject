<?php
class Validate
{
	/* Validators - Regex */
    public static $allowPasswordChars = "/^(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/";
	public static $allowedUserNameChars = '/^[a-zA-Z][a-zA-Z0-9_.]{4,10}$/';
	public static $emailPattern = '/^[a-zA-Z][a-zA-Z0-9_.]+@[a-zA-Z0-9_.]+\.[a-z]{2,4}$/';	

    private static $_errorMessages = array (
        'ADM_001' => '{CUSTOM-VALUE-1} is required.',
        'ADM_002' => '{CUSTOM-VALUE-1} value is invalid. Password can contain a character, a number and a special character (!@#$%). Valid length is of 8 to 12 characters.',
        'ADM_003' => '{CUSTOM-VALUE-1} is invalid. Only Alphanumeric and  _ is allowed, name should not start with numbers and _. Valid length is of 4 to 10 characters.',
		'ADM_005' => '{CUSTOM-VALUE-1} is invalid.',
    );
    /**
     * This function applies the dynamic value in error message text based on the error code passed
     * @param $errorCode
     * @param $customData
     * @return array|string|string[]
     */
    public static function getErrorText ($errorCode = "", $customData = array ( ) )
    {
        $errorMsg = self::$_errorMessages [$errorCode];
        if( is_array($customData) && !empty ( $customData ) ) {
            for ( $i = 1; $i <= count ( $customData ); $i++ ) {
                $customPlaceHolders [] = "{CUSTOM-VALUE-".$i."}";
            }
        }else{
            $customPlaceHolders [] = "{CUSTOM-VALUE-1}";
        }
        $errorMsg = str_replace ( $customPlaceHolders, $customData, $errorMsg );
        return $errorMsg;
    }
    /*
     * Checks for empty string
     * @param String - $value
     * @return false on validation failure
     */
    public static function isEmpty($value = null)
    { 
        if (!isset ($value) || empty ($value)) return true;
        return false;
    }
	/*
     * Checks for empty string
     * @param String - $value
     * @return false on validation failure
     */
    public static function isEmptyCheck($value = null, $field = null)
    {
        if (!isset ($value) || empty ($value)){
            $validationErrors = array($field);
            return self::getErrorText('ADM_001', $validationErrors);
        }else{
            return true;
        }
    }
	
	/*
     * Checks for alphaNumeric string
     * @param String - $value
     * @return false on validation failure
     */
    public static function isAlphaNumeric($value = '', $field = null)
    {
        if (!preg_match(self::$allowedUserNameChars, $value)) {
            $validationErrors = array($field, 'Alphanumeric');
            return self::getErrorText('ADM_003', $validationErrors);
        }
        return true;
    }
	
	/*
     * Checks for valid password string
     * @param string - $value
     * @return false on validation failure
     */
    public static function isValidPassword($value = '', $field = null)
    {
        if (!preg_match(self::$allowPasswordChars, $value)) {
            $validationErrors = array($field, 'Alphanumeric');
            return self::getErrorText('ADM_002', $validationErrors);
        }
        return true;
    }
	
	/*
     * Checks for valid email
     * @param string - $value
     * @return false on validation failure
     */
    public static function isValidEmail($value = '', $field = null)
    {
        if (!preg_match(self::$emailPattern, $value)) {
            $validationErrors = array($field);
            return self::getErrorText('ADM_005', $validationErrors);
        }
        return true;
    }
}//Class end

?>

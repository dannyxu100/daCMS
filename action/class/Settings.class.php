<?php  
class Settings {  
    public $_settings = array ();  
	
    public function get( $var = "" ) {  
        $var = explode ( '.', $var );
        $result = $this->_settings;
		
        foreach ( $var as $key ) {
            if (! isset ( $result [$key] )) {  
                return false;  
            }         
            $result = $result [$key];  
        }         
        return $result;  
    }
      
    public function load( $file ) {  
        trigger_error ( '接口未被实现', E_USER_ERROR );  
    }
}

/**  
* 针对PHP的配置,如有配置文件  
*config.php  
<?php  
$db = array();  
 
// Enter your database name here:  
$db['name'] = 'test';  
 
// Enter the hostname of your MySQL server:  
$db['host'] = 'localhost';  
?>  
 
//具体调用:  
include ('settings.php'); //原始环境假设每个类为单独的一个类名.php文件  
// Load settings (PHP)  
$settings = new Settings_PHP;  
$settings->load('config.php');  
echo 'PHP: ' . $settings->get('db.host') . '';  
*  
*/
class Settings_PHP extends Settings {
    function load( $file ) {
        if (file_exists ( $file ) == false) {
            return false;  
        }  
          
        // Include file  
        include ($file);
        unset ( $file );  
          
        // Get declared variables  
        $vars = get_defined_vars ();  
          
        // Add to settings array  
        foreach ( $vars as $key => $val ) {
            if ($key == 'this')  
                continue;             
            $this->_settings [$key] = $val;  
        }  
      
    }
}  

/**
* ini例子:config.ini
* 
[db]
name = test
host = localhost

//调用例子:
$settings = new Settings_INI;
$settings->load('config.ini');
echo 'INI: ' . $settings->get('db.host') . '';
*/
class Settings_INI extends Settings {  
    function load( $file ) {
        if (file_exists ( $file ) == false) {  
            return false;  
        }  
        $this->_settings = parse_ini_file ( $file, true );  
    }  
}  

?>
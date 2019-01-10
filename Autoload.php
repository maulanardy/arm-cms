<?php
    include "system/php-activerecord/ActiveRecord.php";
    include "system/php-mailer/PHPMailerAutoload.php";
    // include "facebook-php-sdk/autoload.php";

    function autoloader($class) {
        $directory = array( 
            __DIR__.'/vendor/', 
            __DIR__.'/system/config/', 
            __DIR__.'/system/facebook/src/', 
            __DIR__.'/system/core/Controller/', 
            __DIR__.'/system/core/Model/', 
            __DIR__.'/system/helper/', 
            __DIR__.'/system/helper/lang/', 
            __DIR__.'/cms/Controller/', 
            __DIR__.'/cms/Model/', 
            __DIR__.'/', 
        );
     
        $filenameformat = array(
            '%s.php',
            '%s.class.php',
            'class.%s.php',
            '%s.inc.php'
        );
        $class = str_replace('Ar\\', 'cms/', $class);
        $class = str_replace('Ma\\', 'system/core/', $class);
        $class = str_replace('\\', '/', $class);
        $path = str_replace('_', '/', $class);
         
        foreach($directory as $dir) {
            foreach($filenameformat as $format) {
                $path = $dir.sprintf($format, $class);
                // echo "<pre>".$path."</pre>";
                if (file_exists($path)) {
                    include_once $path;
                    return;
                }
            }
        }
    }

    if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
        //SPL autoloading was introduced in PHP 5.1.2
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            spl_autoload_register('autoloader', true, true);
        } else {
            spl_autoload_register('autoloader');
        }
    } else {
        /**
         * Fall back to traditional autoload for old PHP versions
         * @param string $classname The name of the class to load
         */
        function __autoload($classname)
        {
            autoloader($classname);
        }
    }
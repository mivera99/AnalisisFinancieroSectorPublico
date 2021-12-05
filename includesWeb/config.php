<?php
    //require_once __DIR__.'/Aplicacion.php';
    
    define('BD_HOST', 'localhost'); // 
    define('BD_NAME', 'dbs_01');// 
    define('BD_USER', 'root');// 
    define('BD_PASS', ''); // 
    date_default_timezone_set('Europe/Madrid');
    
    /*spl_autoload_register(function ($class) {
    
        // project-specific namespace prefix
        $prefix = 'includes\\';

        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/';
        
        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }
        
        // get the relative class name
        $relative_class = substr($class, $len);
        
        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    });*/

    function getConexionBD() {
        global $BD;
        if (!$BD) {
            $BD = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
            if ( $BD->connect_errno ) {
                echo "Error de conexión a la BD: (" . $BD->connect_errno . ") " . $BD->connect_error;
                exit();
            }
            if ( ! $BD->set_charset("utf8mb4")) {
                echo "Error al configurar la codificación de la BD: (" . $BD->errno . ") " . $BD->error;
                exit();
            }
        }
        return $BD;
    }

    function cierraConexion() {
        // Sólo hacer uso de global para cerrar la conexion !!
        global $BD;
        if ( isset($BD) && ! $BD->connect_errno ) {
          $BD->close();
        }
    }
    // Inicializa la aplicación
/*$app = Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));
register_shutdown_function(array($app, 'shutdown'));
*/
?>
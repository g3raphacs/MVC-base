<?php
require_once '../vendor/autoload.php';

use App\Twig;

// Constants_____________________________________
define("BASE_PATH","/") ;

//ROUTER
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();
$router->setBasePath('');

//Home Page __________________________________
$router->map('GET', BASE_PATH, function () {
    echo "Page d'Accueil";

    // render template
    $twig = new Twig('base.html.twig');
    $twig->render([
            'variable1' => "test variable"
        ]);
});

//404 Page __________________________________
$router->map('GET', '/[*]', function () {
    echo "Cette page n'existe pas";
});



// Launch Routing
$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
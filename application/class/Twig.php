<?php
namespace App;


class Twig{
    private $template;

    public function __construct($template_name)
    {
        $path_current = dirname( __DIR__ );
        $loader = new \Twig\Loader\FilesystemLoader($path_current.DIRECTORY_SEPARATOR.'view');
        $twig = new \Twig\Environment($loader, [
            'cache' => $path_current.DIRECTORY_SEPARATOR."cache",
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->template = $twig->load($template_name);
    }

    public function render($arr=[]){
        echo $this->template->render($arr);
    }
}
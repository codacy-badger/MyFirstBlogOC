<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 19/03/2018
 * Time: 19:44
 */

namespace App\controller;

use App\services\AppFactory;

use App\services\LinkBuilder;
use App\services\Sessions\Flash;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;
use Twig_Loader_Filesystem;

class AppController
{
    private $config;
    private $http;
    private $session;


    public function __construct(AppFactory $app, Request $http, Session $session)
    {
        $this->config = $app->getConfig();
        $this->http = $http;
        $this->session = $session;
    }

    public function render($path, $var = null)
    {
        $templatesFolder = $this->config->getTwigTemplates();

        $loader = new Twig_Loader_Filesystem($this->config->getRootPath() . $templatesFolder);

        $cache = false;
        if ($this->config->getTwigCache()) {
            $cache = $this->config->getRootPath() . $this->config->getTwigCache();
        }


        $twig = new Twig_Environment($loader, array(
            'cache' => $cache,
        ));

        // Add Global Objet LinkBuilder
        $twig->addGlobal('LinkBuilder', new LinkBuilder());
        $twig->addGlobal('Flash', new Flash($this->session));

        $prefix = $this->config->getPrefix();
        if ($this->config->getPrefix() !== '/') {
            $prefix = $this->config->getPrefix().'/';
        }

        $request = $this->http->createFromGlobals();
        $httpHost = $request->server->get('HTTP_HOST');

        // DEFAULT VARIABLES
        $variables  = array(
            'publicFolder' => 'http://' . $httpHost  . $prefix . "public",
            'rootPath' => $this->config->getPrefix()
        );

        // MERGE VAR IF NOT EMPTY $VAR
        if ($var) {
            $variables = array_merge($variables, $var);
        }

        return $twig->render($path, $variables);
    }
}

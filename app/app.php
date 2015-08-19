<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/myClass.php";


    $server = 'mysql:host=localhost;dbname=BRiT';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app = new Silex\Application();
    $app['debug']  = true;
    $app->register(new Silex\Provider\TwigServiceProvider(),array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app){
      $mystring = "Data from the app display in twig";
            return $app['twig']->render('template.html.twig', array('data' => $mystring));
    });

    return $app;
    ?>

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

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisine' => Cuisine::getAll()));
    });

    $app->get("/restaurants/{id}", function($id) use ($app) {
        //shows a certain restaurant based on id

        return $app['twig']->render('index.html.twig', array('cuisine' => Cuisine::getAll()));
    });

    $app->patch("/update_restaurant", function($id) use ($app) {
        //shows a certain restaurant based on id
        
        return $app['twig']->render('index.html.twig', array('cuisine' => Cuisine::getAll()));
    });

    return $app;
    ?>

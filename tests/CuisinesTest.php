
<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Cuisine.php";


    $server = 'mysql:host=localhost;dbname=BRiT_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
      {
          Cuisine::deleteAll();
      }

      function test_getStyle()
     {
         //Arrange
         $style =  "Thai";
         $test_cuisine = new Cuisine($style);
         //Act
         $result = $test_cuisine->getStyle();
         //Assert
         $this->assertEquals($style, $result);
     }


      }

      ?>


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
     }//end test

     function test_getId()
     {
         //Arrange
         $style = "Thai";
         $id = 1;
         $test_cuisine = new Cuisine($style, $id);
         //Act
         $result = $test_cuisine->getId();
         //Assert
         $this->assertEquals(true, is_numeric($result));
     }

     function test_save()
     {
         //arrange
         $style = "Thai";
         $test_cuisine = new Cuisine($style);

         //act
         $test_cuisine->save();

         //assert
         $result = Cuisine::getAll();
         $this->assertEquals($test_cuisine,$result[0]);


     }

      }

      ?>

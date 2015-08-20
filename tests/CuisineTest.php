
<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";


    $server = 'mysql:host=localhost;dbname=BRiT_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
      {
          Cuisine::deleteAll();
          Restaurant::deleteAll();
      }

    function test_cuisine_getStyle()
    {
         //Arrange
         $style =  "Thai";
         $test_cuisine = new Cuisine($style);
         //Act
         $result = $test_cuisine->getStyle();
         //Assert
         $this->assertEquals($style, $result);
    }//end test

    function test_cuisine_getId()
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

    function test_cuisine_save()
    {
         //Arrange
         $style = "Thai";
         $test_cuisine = new Cuisine($style);

         //Act
         $test_cuisine->save();

         //Assert
         $result = Cuisine::getAll();
         $this->assertEquals($test_cuisine,$result[0]);
    }

    function test_cuisine_getAll()
    {
        //Arrange
        $style = "Thai";
        $id = null;
        $test_cuisine = new Cuisine($style, $id);
        $test_cuisine->save();

        $name= "pok pok";
        $cuisine_id = $test_cuisine->getId();
        $test_restaurant = new Restaurant($name, $cuisine_id, $id);
        $test_restaurant->save();

        $name2= "New Thai Blues";
        $test_restaurant2 = new Restaurant($name2, $cuisine_id, $id);
        $test_restaurant2->save();

        //Act
        $result = Restaurant::getAll();

        //Assert
        $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
    }

    function test_cuisine_find()
    {
        //Arrange
        $cuisine1 = new Cuisine("Thai");
        $cuisine1->save();
        $cuisine2 = new Cuisine("Dogfood");
        $cuisine2->save();

        //Act
        $id = $cuisine1->getId();
        $result = Cuisine::find($id);

        //Assert
        $this->assertEquals($cuisine1, $result);
    }

    function test_cuisine_update()
    {

        //Arrange
        $style = "Thai";
        $id = null;
        $test_cuisine = new Cuisine($style, $id);
        $test_cuisine->save();

        $new_style = "Asian";

        //Act
        $test_cuisine->update($new_style);

        //Assert
        $this->assertEquals("Asian", $test_cuisine->getStyle());

     }

     function test_cuisine_delete()
     {

         //Arrange
         $cuisine1 = new Cuisine("Thai");
         $cuisine1->save();
         $cuisine2 = new Cuisine("Dogfood");
         $cuisine2->save();
         
         //Act
         $cuisine1->delete();

         //Assert
         $this->assertEquals([$cuisine2],Cuisine::getAll());

     }

}
?>

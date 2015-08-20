
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


    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }//end function

        function test_restaurant_save()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();
            $name = "Pok-Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            //Act
            $test_restaurant->save();
            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_restaurant_getAll()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();

            $name2 = "Mai Thai";
            $category_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $category_id);
            $test_restaurant2->save();
            //Act
            $result = Restaurant::getAll();
            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_restaurant_deleteAll()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();

            $name2 = "Mai Thai";
            $category_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $category_id);
            $test_restaurant2->save();
            //Act
            Restaurant::deleteAll();
            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_restaurant_getId()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();
            //Act
            $result = $test_restaurant->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_restaurant_getCategoryId()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();
            //Act
            $result = $test_restaurant->getCuisineId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_restaurant_find()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $style2 = "asian fusion";
            $test_cuisine2 = new Cuisine($style2);
            $test_cuisine2->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();

            $name2 = "Mai Thai";
            $category_id2 = $test_cuisine2->getId();
            $test_restaurant2 = new Restaurant($name2, $category_id2);
            $test_restaurant2->save();

            //Act
            $id = $test_restaurant->getId();
            $result = Restaurant::find($id);

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }

        function test_restaurant_update()
        {

            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $cuisine_id = $test_cuisine->getId();
            $stars = 4;
            $website = "www.pokpokpdx.com";
            $phone = "503 232 1387";
            $tr = new Restaurant($name, $cuisine_id, $stars, $website, $phone);
            $tr ->save();

            $new_name = "Pok Pok Noi";
            $new_cuisine_id = $test_cuisine->getId();
            $new_id =
            $new_stars = 7;
            $new_website = "balls";
            $new_phone ="503 555 5555";

            //Act
            $tr->updateRestaurant($new_name,$tr->getCuisineId(), $tr->getID(),$new_stars, $new_website, $new_phone);

            //Assert
            $this->assertEquals(7, $tr->getStars(), "OH NO");

         }

        function test_restaurant_delete()
        {

            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $category_id);
            $test_restaurant->save();
            $name2 = "Dicks";
            $category_id2 = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $category_id);
            $test_restaurant2->save();


            //Act
            $test_restaurant->delete();

            //Assert
            $this->assertEquals([$test_restaurant2], Restaurant::getAll());


        }

        //testing that when we feed the restaurant a star number it returns
        function test_restaurant_getStars()
        {
            //Arrange
            $style = "Thai";
            $test_cuisine = new Cuisine($style);
            $test_cuisine->save();

            $name = "Pok Pok";
            $category_id = $test_cuisine->getId();
            $stars = 5;
            $test_restaurant = new Restaurant($name, $category_id,null,$stars);
            $test_restaurant->save();
            $name2 = "Dicks";
            $stars2 = 3;
            $category_id2 = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $category_id,null,$stars2);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();
            //Assert
            $this->assertEquals(5,$result[0]->getStars());

        }

    } //end class




?>

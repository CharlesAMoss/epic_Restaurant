<?php
class Restaurant
{

    private $name;
    private $cuisine_id;
    private $id;

    function __construct($name,$cuisine_id,$id = null)
    {

        $this->name = $name;
        $this->cuisine_id = $cuisine_id;
        $this->id = $id;

    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getName()
    {
        return $this->name;
    }
    function getId()
    {
        return $this->id;
    }

    function getCuisineId()
    {
        return $this->cuisine_id;
    }

    function save()
    {
        $statement = $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id) VALUES ('{$this->getName()}', {$this->getCuisineId()})");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteRestaurants($cuisine_id)
    {
        $restaurants = Restaurant::getAll();
        foreach($restaurants as $restaurant)
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id=$cuisune_id;");
        }
    }

    static function find($search_id)
    {
        $found_restaurant = null;
        $restaurants = Restaurant::getAll();
        foreach($restaurants as $restaurant) {
            $restaurant_id = $restaurant->getId();
            if ($restaurant_id == $search_id) {
                $found_restaurant = $restaurant;
            }
        }
        return $found_restaurant;
    }

    static function getAll()
    {
        $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
        $restaurants = array();
        foreach($returned_restaurants as $restaurant) {
            $name = $restaurant['name'];
            $id = $restaurant['id'];
            $cuisine_id = $restaurant['cuisine_id'];
            $new_restaurant = new Restaurant($name, $cuisine_id, $id);
            array_push($restaurants, $new_restaurant);
        }
        return $restaurants;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaurants;");
    }
}

 ?>

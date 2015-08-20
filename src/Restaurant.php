<?php
class Restaurant
{

    private $name;
    private $cuisine_id;
    private $id;
    private $stars;
    private $website;
    private $phone;

    function __construct($name,$cuisine_id,$id = null, $stars = 0, $website = "", $phone = "")
    {

        $this->name = $name;
        $this->cuisine_id = $cuisine_id;
        $this->id = $id;
        $this->stars = $stars;
        $this->website = $website;
        $this->phone = $phone;

    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setStars($new_stars)
    {
        $this->stars = $new_stars;
    }

    function getStars()
    {
        return $this->stars;
    }

    function setWebsite($new_website)
    {
        $this->website = (string) $new_website;
    }

    function getWebsite()
    {
        return $this->website;
    }

    function setPhone($new_phone)
    {
        $this->phone = (string) $new_phone;
    }

    function getPhone()
    {
        return $this->phone;
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
        $statement = $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, stars, website, phone) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getStars()},'{$this->getWebsite()}', '{$this->getPhone()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function updateRestaurant($new_name, $new_cuisine_id, $new_id, $new_stars, $new_website, $new_phone)
    {
        $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$new_name}', stars = {$new_stars}, website = '{$new_website}', phone = '{$new_phone}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
        $this->setStars($new_stars);
        $this->setWebsite($new_website);
        $this->setPhone($new_phone);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
    }

    static function deleteRestaurants($cuisine_id)
    {
        $restaurants = Restaurant::getAll();
        foreach($restaurants as $restaurant)
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id=$cuisine_id;");
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
            $stars = $restaurant['stars'];
            $website = $restaurant['website'];
            $phone = $restaurant['phone'];
            $new_restaurant = new Restaurant($name, $cuisine_id, $id,$stars,$website,$phone);
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

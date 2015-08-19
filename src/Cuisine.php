<?php

class Cuisine {

    private $id;
    private $style;

        function __construct($style, $id=null)
        {
            $this->style = $style;
            $this->id = $id;
        }
        function setstyle($new_style)
        {
            $this->style = (string) $new_style;
        }
        function getstyle()
        {
            return $this->style;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (style) VALUES ('{$this->getstyle()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }
        function getrestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()} ORDER BY due_date;");
            foreach($returned_restaurants as $restaurant) {
                $description = $restaurant['description'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $due_date = $restaurant['due_date'];
                $new_restaurant = new restaurant($description, $id, $cuisine_id, $due_date);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }
        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $style = $cuisine['style'];
                $id = $cuisine['id'];
                $new_cuisine = new cuisine($style, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }
        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }
        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
    }
?>

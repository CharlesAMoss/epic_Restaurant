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

}

 ?>

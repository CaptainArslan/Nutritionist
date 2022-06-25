<?php
    //Print data function to print array    
    function print_data($array)
    {
        echo "<div align='left'><pre>";
        if (is_array($array))
            print_r($array);
        else
            echo $array;
        echo "</pre></div>";
    }

    //Formate date
    function formate_date($date, $format)
    {
        $formateddate = date($format, strtotime($date));
        return $formateddate;
    }
?>
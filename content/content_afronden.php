<?php 
    {
        include 'connect.php';

    	$username = $_SESSION['user_name'];
        $klant_id = $_SESSION['klant_id'];
        $totaalprijs = 0;
        $totaalproducten = 0;

        $datum = date("Y-m-d H:i:s");

        // bestellingen
        $query = "INSERT INTO bestellingen (klant_id, best_datum) VALUES ('$klant_id', '$datum')"; 
        mysql_query($query) or die (mysql_error());

        // het verkrijgen van het bestelling_id
        $bestelling_id = mysql_insert_id();

        /*$query = "SELECT * FROM bestellingen WHERE best_datum = '$datum'";
        $resultaat = mysql_query($query) or die (mysql_error());

        while ($row = mysql_fetch_array($resultaat)) 
            {
                $bestelling_id = $row['bestelling_id'];
            }*/

        $cookie = $_COOKIE["wkwebshop_$username"];
        $vars = explode(";", $cookie);
        $counter = 0;
        
        while (count($vars) > $counter) 
        {
            $query = "SELECT * FROM artikelen WHERE artikel_id = ".$vars[$counter];
            $counter++;
            $resultaat = mysql_query($query) or die (mysql_error());
            echo $query;
            echo $resultaat;
            
            while ($row = mysql_fetch_array($resultaat)) 
            {
                $artikel_id = $row['artikel_id'];
                $artikel_aantal = $vars[$counter];
                $artikel_prijs = $row['artikel_prijs'];

                $totaalprijs += $vars[$counter] * $row['artikel_prijs'];
                $totaalproducten += $vars[$counter];

                // bestelling regel
                $query = "INSERT INTO bestelling_regel(bestelling_id, artikel_id, bestreg_artikel_prijs, bestreg_aantal) VALUES ($bestelling_id,$artikel_id, $artikel_prijs, $artikel_aantal)";
                $resultaat = mysql_query($query) or die (mysql_error());
            }
            $counter++;
        }       
    }
 ?>

Gefeliciteerd u heeft succesvol betaald.
U krijgt een email met daarin de gegevens over uw bestelling.
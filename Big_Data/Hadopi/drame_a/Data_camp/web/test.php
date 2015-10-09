<?php

	if (isset($_POST['film'])){
		$xml = simplexml_load_file('Data_camp/bdd.xml');
		$debut_film = 4047;
		$fin_film = 4900;

		for ($i = $debut_film; $i < $fin_film; ++$i){
			$film_search = $xml->Video[$i]->Title;

			if($film_search == $_POST['film']){
				echo $film_search."<br />";
				echo "<a href='".$xml->Video[$i]->URL."' target='blank'>";
				echo "<img src='".$xml->Video[$i]->URLPhoto."' /></a><br />";
				echo $xml->Video[$i]->Categories->Category."<br />";
				echo $xml->Video[$i]->Plot."<br />";
		}
	}
}
<?php
class Weather{

	public function __construct(){

		

	}

	public function display_weather($coordinates){//current day weather
		$url='api.openweathermap.org/data/2.5/weather?lat='.$coordinates[0].'&lon='.$coordinates[1].'&appid=3b22f93cc4fda62995cf79e838809a65';
		//Curl Request
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		$info = curl_exec($ch); //Curl exec
		$weather_info = json_decode($info);
		curl_close($ch); //Curl Close
		
		$img_url = "http://openweathermap.org/img/w/".$weather_info->weather['0']->icon.".png";
		
		echo '<h2>Weather Details</h2>';
		echo '<h4>Todays Weather Details</h4>';
		echo "<table border='1'>";
		echo '<tr><td>Current Minimum Temperature : '.$weather_info->main->temp_min.'</td></tr>';
		echo '<tr><td>Current Maximum Temperature : '.$weather_info->main->temp_max.'</td></tr>';
		echo '<tr><td>Humidity : '.$weather_info->main->humidity .'%'.'</td></tr>';
		echo '<tr><td>Wind Speed : '.$weather_info->wind->speed.'</td></tr>';
		echo '<tr><td>Weather : '.$weather_info->weather['0']->description;
		echo '<img src='.$img_url.'>';
		echo '</td></tr></table>';

	}

	public function future_weather($coordinates){//next day weather
		
		$url='api.openweathermap.org/data/2.5/forecast/daily?lat='.$coordinates[0].'&lon='.$coordinates[1].'&cnt=1&appid=3b22f93cc4fda62995cf79e838809a65';
		//Curl Request
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		$info = curl_exec($ch); //Curl exec
		$weather_info = json_decode($info);
		curl_close($ch); //Curl Close
		$img_url = "http://openweathermap.org/img/w/".$weather_info->list['0']->weather['0']->icon.".png";
		
		echo '<h2>Next Day Weather Details: '.date('d/m/Y', $weather_info->list['0']->dt + 86400).'</h2>';
		echo "<table border='1'>";
		echo '<tr><td>Current Minimum Temperature : '.$weather_info->list['0']->temp->min.'</td></tr>';
		echo '<tr><td>Current Maximum Temperature : '.$weather_info->list['0']->temp->max.'</td></tr>';
		echo '<tr><td>Humidity : '.$weather_info->list['0']->humidity .'%'.'</td></tr>';
		echo '<tr><td>Wind Speed : '.$weather_info->list['0']->speed.'</td></tr>';
		echo '<tr><td>Weather : '.$weather_info->list['0']->weather['0']->description;
		echo '<img src='.$img_url.'>';
		echo '</td></tr></table>';

	}

	public function display_weather_zip_code($location){ //Weather by zipcode
		
		$url='api.openweathermap.org/data/2.5/weather?zip='.$location.',in&appid=3b22f93cc4fda62995cf79e838809a65';
		//Curl Request
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		$info = curl_exec($ch); //Curl exec
		$weather_info = json_decode($info);
		curl_close($ch); //Curl Close
		$img_url = "http://openweathermap.org/img/w/".$weather_info->weather['0']->icon.".png";
		
		echo '<h2>You Have Searched for '.$weather_info->name;
		echo "<table border='1'>";
		echo '<tr><td>Searched City : '.$weather_info->name.'</td></tr>';
		echo '<tr><td>Current Minimum Temperature : '.$weather_info->main->temp_min.'</td></tr>';
		echo '<tr><td>Current Maximum Temperature : '.$weather_info->main->temp_max.'</td></tr>';
		echo '<tr><td>Humidity : '.$weather_info->main->humidity .'%'.'</td></tr>';
		echo '<tr><td>Wind Speed : '.$weather_info->wind->speed.'</td></tr>';
		echo '<tr><td>Weather : '.$weather_info->weather['0']->description;
		echo '<img src='.$img_url.'>';
		echo '</td></tr></table>';
	}
}
?>
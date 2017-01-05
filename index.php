<?php

require_once './Weather.php';

//to find co-ordinates 
$getloc = json_decode(file_get_contents("http://ipinfo.io/"));
		$coordinates = explode(",", $getloc->loc); //

		$weather = new Weather(); //Weather Class	
		$weather->display_weather($coordinates); //To display current day Weather
		$weather->future_weather($coordinates);	//To display future day Weather

		if (isset($_GET['location']) && $_GET['location'] !='') { // if zip code is set
			$weather->display_weather_zip_code($_GET['location']);
		}

		?>
		<!--code for zip code search -->
		<div class="weather_location">
			<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="get" name="geolocation" id="geolocation">
				<p><lable> Enter Zip : </lable><label for="location"><input type="text" id="location" name="location" placeholder="Search By Zip Code" maxlength="6" required/></label></p>
				<input type="submit" value="Submit" name="submit" id="submit" />
			</form>
			<hr/>
		</div>
<html>
<head>

</head>

<body>


<?php echo file_get_contents("header.html"); ?>
<h2>Set heating</h2>
<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
  <button class="tablinks" onclick="openRoom(event, 'Room 1')">Room 1</button>
  <button class="tablinks" onclick="openRoom(event, 'Room 2')">Room 2</button>
  <button class="tablinks" onclick="openRoom(event, 'Room 3')">Room 3</button>
	<button class="tablinks" onclick="openRoom(event, 'Room 4')">Room 4</button>
	<button class="tablinks" onclick="openRoom(event, 'Room 5')">Room 5</button>
	<button class="tablinks" onclick="openRoom(event, 'Room 6')">Room 6</button>
	<button class="tablinks" onclick="openRoom(event, 'Room 7')">Room 7</button>
</div>

<div id="Room 1" class="tabcontent">
  <h3>Room 1</h3>
  <p>
		<?php
		if (isset($_POST['func']) && !empty($_POST['func'])) {
			switch ($_POST['func']) {
				case 'getCalendar':
					getCalendar($_POST['year'],$_POST['month']);
					break;

				default:
					break;
			}
		}

		function getCalendar($year !='',$month = '')
		{
			$dateYear = ($year != '')?$year:date("Y");
			$dateMonth = ($month != '')?$month:date("m");
			$date = $dateYear.'-'.$dateMonth.'-01';
			$currentMonthFirstDay = date("N",strtotime($date));
			$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
			$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
			$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
		}
		 ?>

		 <div id="calender_section">
				<h2>
		        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
		            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
					<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
		            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
		        </h2>
				<div id="event_list" class="none"></div>
				<div id="calender_section_top">
					<ul>
						<li>Sun</li>
						<li>Mon</li>
						<li>Tue</li>
						<li>Wed</li>
						<li>Thu</li>
						<li>Fri</li>
						<li>Sat</li>
					</ul>
				</div>
				<div id="calender_section_bot">
					<ul>
					<?php
						$dayCount = 1;
						for($cb=1;$cb<=$boxDisplay;$cb++){
							if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
								//Current date
								$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
								$eventNum = 0;
								//Include db configuration file
								include 'dbConfig.php';
								//Get number of events based on the current date
								$result = $db->query("SELECT title FROM events WHERE date = '".$currentDate."' AND status = 1");
								$eventNum = $result->num_rows;
								//Define date cell color
								if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
									echo '<li date="'.$currentDate.'" class="grey date_cell">';
								}elseif($eventNum > 0){
									echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
								}else{
									echo '<li date="'.$currentDate.'" class="date_cell">';
								}
								//Date cell
								echo '<span>';
								echo $dayCount;
								echo '</span>';

								//Hover event popup
								echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
								echo '<div class="date_window">';
								echo '<div class="popup_event">Events ('.$eventNum.')</div>';
								echo ($eventNum > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">view events</a>':'';
								echo '</div></div>';

								echo '</li>';
								$dayCount++;
					?>
					<?php }else{ ?>
						<li><span>&nbsp;</span></li>
					<?php } } ?>
					</ul>
				</div>
			</div>

			<script type="text/javascript">
				function getCalendar(target_div,year,month){
					$.ajax({
						type:'POST',
						url:'functions.php',
						data:'func=getCalender&year='+year+'&month='+month,
						success:function(html){
							$('#'+target_div).html(html);
						}
					});
				}

				function getEvents(date){
					$.ajax({
						type:'POST',
						url:'functions.php',
						data:'func=getEvents&date='+date,
						success:function(html){
							$('#event_list').html(html);
							$('#event_list').slideDown('slow');
						}
					});
				}

				function addEvent(date){
					$.ajax({
						type:'POST',
						url:'functions.php',
						data:'func=addEvent&date='+date,
						success:function(html){
							$('#event_list').html(html);
							$('#event_list').slideDown('slow');
						}
					});
				}

				$(document).ready(function(){
					$('.date_cell').mouseenter(function(){
						date = $(this).attr('date');
						$(".date_popup_wrap").fadeOut();
						$("#date_popup_"+date).fadeIn();
					});
					$('.date_cell').mouseleave(function(){
						$(".date_popup_wrap").fadeOut();
					});
					$('.month_dropdown').on('change',function(){
						getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
					});
					$('.year_dropdown').on('change',function(){
						getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
					});
					$(document).click(function(){
						$('#event_list').slideUp('slow');
					});
				});
			</script>
		<?php
		}

		/*
		 * Get months options list.
		 */
		function getAllMonths($selected = ''){
			$options = '';
			for($i=1;$i<=12;$i++)
			{
				$value = ($i < 10)?'0'.$i:$i;
				$selectedOpt = ($value == $selected)?'selected':'';
				$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
			}
			return $options;
		}

		/*
		 * Get years options list.
		 */
		function getYearList($selected = ''){
			$options = '';
			for($i=2015;$i<=2025;$i++)
			{
				$selectedOpt = ($i == $selected)?'selected':'';
				$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
			}
			return $options;
		}

		/*
		 * Get events by date
		 */
		function getEvents($date = ''){
			//Include db configuration file
			include 'dbConfig.php';
			$eventListHTML = '';
			$date = $date?$date:date("Y-m-d");
			//Get events based on the current date
			$result = $db->query("SELECT title FROM events WHERE date = '".$date."' AND status = 1");
			if($result->num_rows > 0){
				$eventListHTML = '<h2>Events on '.date("l, d M Y",strtotime($date)).'</h2>';
				$eventListHTML .= '<ul>';
				while($row = $result->fetch_assoc()){
		            $eventListHTML .= '<li>'.$row['title'].'</li>';
		        }
				$eventListHTML .= '</ul>';
			}
			echo $eventListHTML;
		}
		?>
<?php echo getCalendar(); ?></p>
</div>

<div id="Room 2" class="tabcontent">
  <h3>Room 2</h3>
  <p>Paris is the capital of France.</p>
</div>

<div id="Room 3" class="tabcontent">
  <h3>Room 3</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Room 4" class="tabcontent">
  <h3>Room 4</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Room 5" class="tabcontent">
  <h3>Room 5</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Room 6" class="tabcontent">
  <h3>Room 6</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Room 7" class="tabcontent">
  <h3>Room 7</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<script>
function openRoom(evt, RoomName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(RoomName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<?php echo file_get_contents("footer.html"); ?>

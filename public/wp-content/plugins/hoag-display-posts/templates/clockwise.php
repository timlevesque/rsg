<script type='application/javascript'>
	function waitTimeMessage(rawWait){
		var numericWait = parseInt(rawWait);
		if (rawWait === 'Closed' || isNaN(numericWait) ) { return 'Currently closed.' };
		var waitRangeEnd = numericWait + 10;
		return 'Current Wait: ' + numericWait + ' - ' + waitRangeEnd + ' min';
	};
    var WAIT_FETCH_OBJECTS = [
  		{ 
			hospitalId: 1400,
    		timeType:   'hospitalPatientsInLine',
			selector:   '#current_patients_1400' 		
		},{ 
			hospitalId: 1400,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1400',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1401,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1401'
		},{ 
			hospitalId: 1401,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1401',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1402,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1402'
		},{ 
			hospitalId: 1402,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1402',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1403,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1403'
		},{ 
			hospitalId: 1403,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1403',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1404,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1404'
		},{ 
			hospitalId: 1404,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1404',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1405,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1405'
		},{ 
			hospitalId: 1405,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1405',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1406,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1406'
		},{ 
			hospitalId: 1406,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1406',
    		formatFunction: waitTimeMessage 
		},{ 
			hospitalId: 2625,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2625'
		},{ 
			hospitalId: 2625,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2625',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 2626,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2626'
		},{ 
			hospitalId: 2626,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2626',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 2627,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2627'
		},{ 
			hospitalId: 2627,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2627',
    		formatFunction: waitTimeMessage 
		},{ 
			hospitalId: 2628,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_2628'
		},{ 
			hospitalId: 2628,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2628',
    		formatFunction: waitTimeMessage  
	  	}
		// to add more, copy the braces and everything in it,
		// paste it above this comment, and change the numbers
		// to match the Clockwise MD number. Make sure there is a comma
		// after each internal brace like this {}, <-- like that
	];
	beginWaitTimeQuerying(WAIT_FETCH_OBJECTS);
	</script>
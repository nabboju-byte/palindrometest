
<script>

var json_server_url ="app_config.json";
//function for read json data by javascript ajax and pars from json to js array
function fetchJSONFile(path, callback) {
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                var data = httpRequest.responseText;
                if (callback) callback(data);
            }
        }
    };
    httpRequest.open('GET', path);
    httpRequest.send(); 
}

//pass file url and get response
fetchJSONFile(json_server_url, function(jsdata){
    // do something with your data
  
	 try
	{  
		var json_toarray = JSON.parse(jsdata); //set json data into variable
		var palindrom_array = new Array(); //create new array for displaying result
		palindrom_array.push('strings'); //set main array index
		
		
		//loop to read json data string and check string is Palindrome or not a palindrome
		for (var i=0; i< json_toarray['strings'].length; i++) {
		
		 //pass string into function for check Palindrome to not
		 var pali_res = check_Palindrome(json_toarray['strings'][i]['str']);
		 
		 
		 //Push string and result in palindrom_array Array
			palindrom_array.push({
				str: json_toarray['strings'][i]['str'],
				resilt:pali_res
			});
		 
		}
		//convert js Array to Json string and display on screen
		var output_json = JSON.stringify(palindrom_array);
		document.write(output_json);
	}
    catch (error){
        document.write('Invalid Json File');
    }

});


function check_Palindrome(str_entry){
// Change the string into lower case and remove  all non-alphanumeric characters
   var cstr = str_entry.toLowerCase().replace(/[^a-zA-Z0-9]+/g,'');
	var ccount = 0;
// Check whether the string is empty or not
	if(cstr==="") {
		//return "Nothing found!";
		return false;
	}
// Check if the length of the string is even or odd 
	if ((cstr.length) % 2 === 0) {
		ccount = (cstr.length) / 2;
	} else {
// If the length of the string is 1 then it becomes a palindrome
		if (cstr.length === 1) {
			//console.log("Entry is a palindrome.");
			return true;
		} else {
// If the length of the string is odd ignore middle character
			ccount = (cstr.length - 1) / 2;
		}
	}
// Loop through to check the first character to the last character and then move next
	for (var x = 0; x < ccount; x++) {
// Compare characters and drop them if they do not match 
		if (cstr[x] != cstr.slice(-1-x)[0]) {
			//console.log("Entry is not a palindrome.");
			return false;
		}
	}
	//console.log("The entry is a palindrome.");
	return true;
}
</script>


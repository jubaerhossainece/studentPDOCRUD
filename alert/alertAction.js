const element =	document.querySelector('#wrapper');

if(element){
	function showMessage(){
	displayAlert();
	}
	displayAlert();
	function displayAlert(){
		element.classList.remove("hide-message");
		element.classList.add("show-message");
	}


	setTimeout(hideMessage, 5000);	

	function hideMessage(){
		element.classList.remove("show-message");
		element.classList.add("hide-message");	
		setTimeout(displayNone, 500);
	}		

	function displayNone(){
		element.style.display = "none";
	}
}

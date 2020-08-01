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

	var clearHideEvent = 0;

	clearHideEvent = setTimeout(hideMessage, 3000);

	element.addEventListener("mouseover", function(){
		clearTimeout(clearHideEvent);
		// console.log('hello mouseover');
	});

	element.addEventListener("mouseout", function(){
		clearHideEvent = setTimeout(hideMessage, 3000);
		// console.log('hello leave');
	});

	function hideMessage(){
		element.classList.remove("show-message");
		element.classList.add("hide-message");	
		setTimeout(displayNone, 500);
	}		

	function displayNone(){
		element.style.display = "none";
	}
}

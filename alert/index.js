

addCSS('alert/alert.css');
// addCSS('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

// Include CSS file
function addCSS(filename){
 var head = document.getElementsByTagName('head')[0];

 var style = document.createElement('link');
 style.href = filename;
 style.type = 'text/css';
 style.rel = 'stylesheet';
 head.append(style);
}
//End of adding css files



//ALERT TEMPLATE 
function alertIcon(type){
	if (type === 'message-success'){
		return `fa-check-circle`;
	} else if(type === 'message-warning'){
		return `fa-exclamation-circle`;
	} else if(type === 'message-danger'){
		return `fa-exclamation-triangle`;
	} 
}

function alertTemplate(data) {
	return `
		<div id="wrapper" class="${data.type}" onclick="hideMessage()">
			<div class="message">
	           	<div class="alert-symbol">
					<i class="fa ${alertIcon(data.type)}" aria-hidden="true"></i>

	           	</div>
	           	<div class="content">
	           		<div class="top">
		           		<span class="title">${data.title}</span> 
		           		<span class="close-btn" onclick="hideMessage()">&times;</span> 
	           		</div>
	           		<div class="bottom">
						<span class="body">${data.desc}</span>
	           		</div>

	           	</div>
			</div>
		   </div>
	`;
}


function alertJS(alertMessage){
	document.body.innerHTML  = document.body.innerHTML + `${alertTemplate(alertMessage)}`;
}



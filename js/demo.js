var name = prompt("enter your name:", "guest");

//default name is 'guest'
if(!name || name === ''){
	name = "guest";
}

//strip tags
name = name.replace(/([^>]+)/ig,"");

//display name on page
$("#user-name").html("User: <strong>" + name + "</strong>");

var chat = new Chat();

$(function(){
	
	chat.getState();

	//define function when key presses
	$('#posttext').keydown(function(event){

		var key = event.which;

		/*if key including return.*/
		if(key >= 33){
			var maxLength = $(this).attr("maxlength");
			var length = this.value.length;

			/*define limit of new content*/
			if(length >= maxLength){
				event.preventDefault();
			}
		}
	});

	/*define function when key release*/
	$('#posttext').keyup(function(e){
		if(e.keyCode == 13){
			var text = $(this).val();
			var maxLength = $(this).attr("maxlength");
			var length = text.length;

			//send
			if(length <= maxLength + 1){
				chat.send(text, name);
				$(this).val("");
			}else{
				$(this).val(text.substring(0, maxLength));
			}
		}
	});
});
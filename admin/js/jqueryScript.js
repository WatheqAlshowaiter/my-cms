
// just for test jquery 

// $(document).ready(function(){

//  alert('ddddd'); 

// });


////////////////////////




$(document).ready(function(){
  
$('#selectAllBoxes').click(function(event){

if (this.checked) {
  $('.checkBox').each(function(){

    this.checked = true; 
  });
}else {
    $('.checkBox').each(function(){

    this.checked = false; 
  });
}



}); 

 // $("body").prepend("hhsldkjfslkdjflskdjflskdjf");  // just for test (it works!)

// IT DOES NOT WORK 
var div_box = "<div id='load-screen'<div id='loading></div></div>"; 
 $("body").prepend(div_box); 


 $('#load-screen').delay(700).fadeOut(800, function(){
$(this).remove(); 
 }); 


 }); 



function loadUsersOnline()
{
    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}

setInterval(function(){
    loadUsersOnline();
}, 500);






window.onload = function(){
myClock.time();
setInterval("myClock.time()", 1000);
}
var myClock = {
time : function(){
var dateObj = new Date();
var yyyy = dateObj.getFullYear();
var mm = dateObj.getMonth() + 1;
var dd = dateObj.getDate();
var h = dateObj.getHours();
var m = dateObj.getMinutes();
var s = dateObj.getSeconds();
document.getElementById("currentTime").innerHTML = yyyy+"/"+mm+"/"+dd+"  "+h+":"+m;
}
}
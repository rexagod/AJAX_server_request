function myGenerator(){
	
var idgen = Math.round(Math.random() * 1000000);
document.getElementById("sid").value = idgen;

}

function myInit(){	//onclick
	myFun();
}

function myFun(){	//implicit

var name = document.getElementById("name").value;

var marks = array(document.getElementById("physics").value,
				  document.getElementById("chemistry").value,
				  document.getElementById("maths").value,
				  document.getElementById("english").value,
				  document.getElementById("computer").value);

var fname = document.getElementById("fname").value;
var mname = document.getElementById("mname").value;
var addr = document.getElementById("homeaddr").value;
var cdet = document.getElementById("cdet").value;
var fpay = document.getElementById("fpay").value;


//attendance use document.getElementById("absent").checked
//finally add a submit button to initiate whole this js ie only one event listener on submit
var xhttpr = new XMLHttpRequest();
var xobj;
xhttpr.onreadystatechange = function() {
	if(this.readyState == 4 && this.status == 200) {

		xobj = JSON.parse(this.responseText);

		xobj.students.push( {"name":name,
							 "id":idgen,
							 //"marks":marks,
							 "fname":fname,
							 "mname":mname,
							 "addr":addr,
							 "cdet":cdet,
							 "fpay":fpay
							 //"pres":
							 });

		document.getElementById('info').innerHTML = "<em>Information added to records!</em>";
	}
}
xhttpr.open("GET","dbentry.json",true);
xhttpr.send();

}
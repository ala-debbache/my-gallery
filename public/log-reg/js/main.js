const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("focus", hide);
	input.addEventListener("blur", remcl);
});


const inp=document.querySelector(".one");
if(inp.value!=""){
	inp.classList.add("focus");
}


const span=document.querySelectorAll(".error");

function hide(){
	span.forEach(spn=>{
		spn.style.display = "none";
	});
}


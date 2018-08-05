function validateLoginForm()
{
	var email=document.forms["login"]["username"].value;
	var pass=document.forms["login"]["password"].value;

	if(email== "")
    {
        document.getElementById("message").className="";
        document.getElementById("message").className="error";
        document.getElementById("message").innerHTML="PLEASE ENTER YOUR EMAIL";
        return false;
    }
    else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
    {
        document.getElementById("message").className="";
        document.getElementById("message").className="error";
        document.getElementById("message").innerHTML="PLEASE ENTER CORRECT EMAIL";
        return false;
    }
    else if(pass=="")
    {
    	document.getElementById("message").className="";
    	document.getElementById("message").className="error";
        document.getElementById("message").innerHTML="PLEASE ENTER A PASSWORD";
        return false;
    }
}

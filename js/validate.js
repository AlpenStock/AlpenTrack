function validate() {
	var b = validateCod() 
	b = validateSis() && b;
	b = validateDesc() && b;
	return b;
}

function validateCod() {
	var cod = document.getElementById("CodiceReq").value;
	if (cod == "" || cod == null) {
		setError("divCodice");
		return false;
	}
	return true;
}

function validateSis() {
	var radio = document.getElementsByName("Sistema");
	
	for(var i=0; i < radio.length; i++) {
        if(radio[i].checked) 
            return true;
    }

    setError("divSistema");
    return false;
}

function validateDesc() {
	var desc = document.getElementById("Descrizione").value;
	if (desc == "" || desc == null) {
		setError("divDesc");
		return false;
	}
	return true;
}

function setError(id) {
	document.getElementById(id).className = "form-group has-error";
}

function removeError(id) {
	document.getElementById(id).className = "form-group";
}

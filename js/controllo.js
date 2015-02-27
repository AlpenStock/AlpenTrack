function controllo() {
	if (document.getElementsByName("CodiceReq").value == "") {
		document.getElementById("divCodice").className = "form-group has-error";
		alert("ci sono");
		return false;
	}
	return true;
}
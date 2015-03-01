function showForm() {
	document.getElementById("btnAdd").style.display = "none";
	document.getElementById("visibility").style.display = "block"
}

function addOption() {
	if (validateFonti() == false)
		return;
	var name = document.getElementById("NomeFonte").value;
	var desc = document.getElementById("DescrizioneFonte").value;
	var optionText = name;
	if (desc != null && desc != "")
		optionText = optionText + " - " + desc;
	var select = document.getElementById("Fonti");
	select.options[select.options.length] = new Option(optionText, name);
	document.getElementById("NomeFonte").value = null;
	document.getElementById("DescrizioneFonte").value = null;
}

function validateFonti() {
	var name = document.getElementById("NomeFonte").value;
	if (name == null || name == "") {
		document.getElementById("divNomeFonte").className = "form-group has-error";
		return false;
	}
	return true;
}
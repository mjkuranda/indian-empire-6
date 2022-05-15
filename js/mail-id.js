window.onload = function () {
	document.getElementById('button-delete').onclick = deleteMail;
}

function deleteMail() {
	return (confirm("Are you sure that you want to delete this message?"));
}
function voter(vote) {
	$.ajax({
		url : "admin/ajouter_etudiant/" + vote,
		type: "GET",
		dataType: "json",
		success: function(json)
		{
			//var reponse = document.querySelector('#reponse');

			if (json.reponse === 'erreur')
			{
				$("#message").addClass("container alert alter-dismissible alert-danger text-center");
				$("#message").html(json.message);
			}
			else
			{
				$("#message").removeClass("container alert alter-dismissible alert-danger text-center");
				$("#message").addClass("container alert alter-dismissible alert-success text-center");
				$("#message").html(json.message);
				//console.log(json);
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
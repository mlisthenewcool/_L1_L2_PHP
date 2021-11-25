$(document).ready(function() {
	/* Liste de tous les étudiants */
	$.ajax({
		url : 'admin/table_etudiants',
		dataType : 'json',
		success : function (json)
		{
			var HTML = '';
			$.each(json, function (index, item)
			{
				HTML +=
					'<tr>' +
					'<td>' + item.id + '</td>' +
					'<td>' + item.prenom + '</td>' +
					'<td>' + item.nom + '</td>' +
					'<td>' + item.situation + '</td>' +
					'<td>' + item.decisions + '</td>' +
					'<td>' + item.ajouter + '</td>' +
					'<td>' + item.supprimer + '</td>' +
					'</tr>';
			});
			$('#table_etudiants').append(HTML);
		}
	});

	/* Liste de toutes les décisions */
	$.ajax({
		url : 'admin/decisions',
		dataType : 'json',
		success : function (json) {
			$('#decisions').append(json);
		}
	});

	/* Ajouter une commission */
	$('#form_commission').on('submit', function(e)
	{
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url : $this.attr('action'),
			type : $this.attr('method'),
			data : $this.serialize(),
			dataType : 'json',
			success : function(json)
			{
				//var reponse = document.querySelector('#reponse');

				if (json.reponse !== 'ok')
				{
					$("#message").addClass("container alert alter-dismissible alert-danger text-center");
					$("#message").html(json.reponse);
				}
				else
				{
					$("#message").removeClass("container alert alter-dismissible alert-danger text-center");
					$("#message").html("");
				}
			}
		});
	});
});

function ajouter_etudiant(id) {
	$.ajax({
		url : "admin/ajouter_etudiant/" + id,
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
/* On attend que la page HTML soit chargée avant les scripts JS qui suivent */
$(document).ready(function()
{/* Login professeur */
	$('#form_prof').on('submit', function(e)
    {
	    e.preventDefault();

	    var $this = $(this);

	    $.ajax({
		    url : $this.attr('action'),
		    type : $this.attr('method'),
		    data : $this.serialize(),
		    dataType : 'json',
		    success : function (json)
		    {
			    var reponse = document.querySelector('#reponse');
			    var redirect = document.querySelector('#redirect');

			    if (json.reponse !== 'ok')
			    {
				    $("#message_prof").addClass("container alert alter-dismissible alert-danger text-center");
				    $("#message_prof").html(json.reponse);
			    }
			    else
			    {
				    $("#message_prof").removeClass("container alert alter-dismissible alert-danger text-center");
				    $("#message_prof").html("");

                    window.location.replace(json.redirect);
                }
            }
        });
    });

    $('#form_admin').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url : $this.attr('action'),
            type : $this.attr('method'),
            data : $this.serialize(),
            dataType : 'json',
            success : function (json) {
                var reponse = document.querySelector('#reponse');
                var redirect = document.querySelector('#redirect');

                if (json.reponse !== 'ok') {
                    $("#message_admin").addClass("container alert alter-dismissible alert-danger text-center");
                    $("#message_admin").html(json.reponse);
                }
                else {
                    $("#message_admin").removeClass("container alert alter-dismissible alert-danger text-center");
                    $("#message_admin").html("");

                    window.location.replace(json.redirect);
                }
            }
        });
    });
});
$(document).ready(function(){

    async function getParameter() {
		//Ajax Load data from ajax
		$.ajax({
			url: SITE_URL + "data/getParameter",
			//data: { id: id },
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				alert("sukses");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				swal({
					title: "Failed to Getting Data",
					text: errorThrown,
					type: "warning"
				});
			}
		});
	}

    });
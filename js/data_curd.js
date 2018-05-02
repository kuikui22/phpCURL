$(document).ready(function() {
	
	var nowEdit_element;
	
	/**
	* 編輯資料
	**/
	$('body').on('click', '.edit-btn', function() {
		var id = $(this).parent('td').prev("td").prev("td").prev("td").prev("td").text();
		var name = $(this).parent("td").prev("td").prev("td").prev("td").text();
		var username = $(this).parent("td").prev("td").prev("td").text();
		var email = $(this).parent("td").prev("td").text();
		
		$('#EditModal').find('input[name="id"]').val(id);
		$('#EditModal').find('input[name="name"]').val(name);
		$('#EditModal').find('input[name="username"]').val(username);
		$('#EditModal').find('input[name="email"]').val(email);
		
		nowEdit_element = $(this);
	});
	
	/**
	 * 儲存編輯資料
	 **/
	 $('#save_edit').on('click', function(e) {
		 e.preventDefault();
		 var form_action = $('#EditModal').find('form').attr('action');
		 var id = $('#EditModal').find('input[name="id"]').val();
		 var name = $('#EditModal').find('input[name="name"]').val();
		 var username = $('#EditModal').find('input[name="username"]').val();
		 var email = $('#EditModal').find('input[name="email"]').val();
		 
		 if(id != '' && name != '' && username != '' && email != '') {
			$.ajax({
				type: 'POST',
				url: 'updata.php',
				data: {id: id, name: name, username: username, email: email},
				success: function(result) {
					alert('Success Save.');
					console.log(nowEdit_element);
					nowEdit_element.parent("td").prev("td").prev("td").prev("td").text(name);
					nowEdit_element.parent("td").prev("td").prev("td").text(username);
					nowEdit_element.parent("td").prev("td").text(email);
				}
			}).done(function(data) {
				$(".modal").modal('hide');
			});
		}else {
			alert('You are missing value.');
		}
	
		 
		 
	 });
	
});



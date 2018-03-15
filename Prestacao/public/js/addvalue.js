//initialize with 3
	var startingNo = 0;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++){
		var displayCount = varCount+1;
		$node = '<tr id="linha'+varCount+'">\
					<td><input type="text" name="var[]" id="var[]"></td> \
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><a href="#" name="delete" class="alert button" id="'+varCount+'">X</a></td>\
				</tr>';
	}
	$('#Produtos').prepend($node);
	
	$('form').on('click', '[name="delete"]', function(){
		
		var bid = this.id;
		var trid = $(this).attr('id');
		$('#linha'+trid).remove();
		//varCount--;
	});

	$('[name="addVar"]').on('click', function(){
		//new node
		$node = '<tr id="linha'+varCount+'">\
					<td><input type="text" name="var[]" id="var[]"></td> \
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><input type="text" name="var[]" id="var[]"></td>\
					<td><a href="#" name="delete" class="alert button" id="'+varCount+'">X</a></td>\
				</tr>';
		$('#Produtos').append($node);
		varCount++;
	});
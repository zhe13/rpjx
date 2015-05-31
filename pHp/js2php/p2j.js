$(document).ready(function(){
	$("#query").click(function(){
		console.log('press');
		var Id = $('input[name=contentid]').val();
		var data = 'action=getlink&id='+Id;

		$.getJSON('http://2.iriswithmayday.sinaapp.com/jserver.php',data,function(json){
			console.log('get');
			var table=$('.table tbody');
			table.html('')
			var trEl =
			$('<tr><td>'
			+ json.wx
			+ '</td></tr>');
			table.append(trEl);
		});
	});
})
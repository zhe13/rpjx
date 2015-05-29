//data	:	2015-5-27
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	Parse_Talk2U_SaveTest
//
var ParseApplicationID = "DPwW3VlJOJn7Cz2H2H1uJOCzA6PUrYHPmzMRUz2u";
var ParseRESTKey	   = "oB6ABoyY7m7Jb7vsY0i6pjH3ScjTgRiUYlDzGQvz";

$(document).ready(function(){
	setInterval(function(){
		getMessage();
		console.log('can？');
	},2000);

	$("#send").click(function(){
		var username = $('input[name=username]').val();
		var message  = $('input[name=message]').val();
		console.log(username);
		console.log('!');
		//当提交消息时，ajax发送了一个POST请求
		$.ajax({
			url : 'https://api.parse.com/1/classes/MessageBoard',
			headers : {
				'X-Parse-Application-Id' : ParseApplicationID,
				'X-Parse-REST-API-Key'	 : ParseRESTKey

			},
			contentType : 'application/json',
			dataType	: 'json',
			processData : false,
			data 		: JSON.stringify({
				'username': username,
				'message' : message
			}),
			type 		: 'POST',
			success		: function(){
				console.log('sent');
				getMessage();
			},
			error 		: function(){
				console.log('error');
			}
		});	 
	});

	$("#delete").click(function(){
		var objectid  = $('input[name=objectId]').val();
		console.log('Delete!');
		console.log(objectid);
		$.ajax({
			url : 'https://api.parse.com/1/classes/MessageBoard/'+objectid,
			headers : {
				'X-Parse-Application-Id' : ParseApplicationID,
				'X-Parse-REST-API-Key'	 : ParseRESTKey

			},
			contentType : 'application/json',
			dataType	: 'json',
			data 		: JSON.stringify({
				
			}),
			type 		: 'DELETE',
			success 	: function(){
				getMessage();
			},
			error 		: function(){
				console.log('error');
			}
		});
	});
})
//使用同样的ajax方法获取远程REST API的消息列表
function getMessage(){
	$.ajax({
		url : 'https://api.parse.com/1/classes/MessageBoard',
		headers:{
			'X-Parse-Application-Id' : ParseApplicationID,
			'X-Parse-REST-API-Key'	 : ParseRESTKey
		},
		contentType : 'application/json',
		dataType 	: 'json',
		type 		: 'GET',
		//如果请求成功（返回200OK的消息）调用updateView
		success 	: function(data){
			console.log('get');
			updateView(data);
		},
		error 		: function(){
			console.log('error');
		}
	});
}
//显示得到的消息
function updateView(message){
	var table=$('.table tbody');//使用选择器选中元素并且创建一个引用
	table.html('');//清空这个元素的inner HTML
	//使用jQuery.each便利消息
	$.each(message.results,function (index,value){
		var trEl = 
		$('<tr><td>'
			+ value.username
			+ '</td><td>'
			+ value.message
			+ '</td><td>'
			+ value.objectId
			+ '</td></tr>');
		//追加表格
		table.append(trEl);
	});
	console.log(message);
}
//data	:	2015-5-27
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	Parse_Talk2U_SaveTest
//
$(document).ready(function(){
	var ParseApplicationID = "DPwW3VlJOJn7Cz2H2H1uJOCzA6PUrYHPmzMRUz2u";
	var ParseJavaScriptKey = "BmelB6gyaqa6Z0JJemMsIN3LFpybzGGGKd2E7pbX";
	//create a parse
	Parse.initialize(ParseApplicationID,ParseJavaScriptKey);
	var Test = Parse.Object.extend("Test");
	var test = new Test();
	test.save({
		name : "Zhe13",
		text : "hello"
	},{
		success : function(object){
			console.log("Parse.com object is saved:" + object);
			//or you can use alert
			//alert("Parse.com object is saved");
		},
		error 	: function(object){
			console.log("Error!Parse.com object is not saved:" + object);
		}
	});

})
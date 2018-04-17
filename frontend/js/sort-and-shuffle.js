$(document).ready(function(){
	function getArr(){
		var arr = new Array();
		$('.myitem').each(function(){
			arr.push($( this ).html());
		});
		return arr;
	}
	function shuffleArray(array) {
	    for (var i = array.length - 1; i > 0; i--) {
	        var j = Math.floor(Math.random() * (i + 1));
	        var temp = array[i];
	        array[i] = array[j];
	        array[j] = temp;
	    }
	    return array;
	}
	$('#sort').click(function(){
		var arr = getArr();
		arr.sort();
		$('.myitem').each(function(index){
			($( this ).html(arr[index]));
		});
	});
	$('#shuffle').click(function(){
		var arr = getArr();
		arr = shuffleArray(arr);
		$('.myitem').each(function(index){
			($( this ).html(arr[index]));
		});
	});
});
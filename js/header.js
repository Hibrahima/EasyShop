function getOnlineUsers(){
	$.ajax({
		url: "api/online_users/read.php",
		type: "GET",
		dataType: "json",
		success: function(result){
			showOnlineUsers(result);
		},
		error: function(e){
			console.log("Error while getting online users "+e);
		}
	});
}

function showOnlineUsers(onlineUsers){
	var online_users_div = $("#online_users_div");
	var ul = document.createElement("ul");
	for(i=0; i<onlineUsers.length; i++){
		var li = document.createElement("li");
		li.innerHTML = onlineUsers[i].name;
		ul.append(li);
	}

	online_users_div.html("");
	online_users_div.append(ul);
}
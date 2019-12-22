function search_result1 (user,name) {
    $.ajax({
        url:"../SearchResult.php",
        type:"POST",
        async:false,
        data: {
            user:user,
            name:name    
        },
        success: function(data) {
            $("#search-results").html(data);
        }
    });
}

function send_request1 (user,id,name) {
    $.ajax({
        url:"../search_frq.php",
        type:"POST",
        data: {
            user:user,
            name:id,  
        },
        success: function(data) {
            //alert(user + " "+ name);
            search_result1 (user,name);
            result1_count (user,name);		
        }
    });
}

function result1_count (user,name) {
    $.ajax({
        url:"result1_count.php",
        type:"POST",
        async:false,
        data: {
            user:user,
            name:name    
        },
        success: function(data) {
            $("#lists").html(data);
        }
    });
}
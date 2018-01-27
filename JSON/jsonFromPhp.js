<script>
/*
These codes below ...
*/
</script>


<?php
// json.php
$json = '[{"Language":"jQuery","ID":"1"},{"Language":"C#","ID":"2"},
                           {"Language":"PHP","ID":"3"},{"Language":"Java","ID":"4"},
                           {"Language":"Python","ID":"5"},{"Language":"Perl","ID":"6"},
                           {"Language":"C++","ID":"7"},{"Language":"ASP","ID":"8"},
                           {"Language":"Ruby","ID":"9"}]';
echo json_encode($json);
?>

<script>
// json.js
var url = "json.php";

function myFunction() {
    getJson(function(j) {
        //processing the data
        // console.log(j);
        var json_obj = $.parseJSON(j);//parse JSON
        for (var i in json_obj) 
            {

                console.log(json_obj[i].classes + ",  " + json_obj[i].id + ",  " + json_obj[i].ext);
                var id = json_obj[i].id;
                var ext = json_obj[i].ext;

		        var imageUrl = 'cases/case_'+id+'/case_'+id+'_bg.'+ext+'';
				var id_div = "#case_"+id;
		        $(id_div).css('background-image', 'url(' + imageUrl + ')');

            }

    });
}


function getJson(callback) {
    var data;
    $.ajax({
        url: url,
        dataType: "json", //set to JSON
        success: function (resp) {
            data = resp;
            callback(data);
        },
        error: function () {}
    }); // ajax asynchronus request 
    //the following line wouldn't work, since the function returns immediately
    //return data; // return data from the ajax request
}

myFunction_DES(); // if you want to use response in external function


$.ajax({
        type: "GET", 
        url: url, 
        // data: form_data,
        dataType: "json", //set to JSON 
        success: function(response)
        {
            /*response = '[{"Language":"jQuery","ID":"1"},{"Language":"C#","ID":"2"},
                           {"Language":"PHP","ID":"3"},{"Language":"Java","ID":"4"},
                           {"Language":"Python","ID":"5"},{"Language":"Perl","ID":"6"},
                           {"Language":"C++","ID":"7"},{"Language":"ASP","ID":"8"},
                           {"Language":"Ruby","ID":"9"}]'
            console.log(response);
            */
	    var json_obj = $.parseJSON(response);//parse JSON
            var output="<ul>";
            for (var i in json_obj) 
            {
                output+="<li>" + json_obj[i].Language + ",  " + json_obj[i].ID + "</li>";
                console.log(json_obj[i].Language + ",  " + json_obj[i].ID);
            }
            output+="</ul>";
            
            $('span').html(output);
        }   
}) 
</script>

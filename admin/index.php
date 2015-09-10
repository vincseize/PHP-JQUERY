<?php
include("../inc_links.php");


$thisyear = date("Y");
$thisyearPlus1 =$thisyear+1;

?>

<script src="<?php echo HOMEPATH;?>/js/jquery-2.1.3.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?php echo HOMEPATH;?>/js/jquery.form.min.js"></script>


<script language="javascript" type="text/javascript" src="<?php echo HOMEPATH;?>/js/datetimepicker.js"></script>





<script type="text/javascript">
$(document).ready(function() { 




/*$('#endDate').load('admin/getDate.php');*/


/*	var date = $.post('admin/getDate.php');
	$('#endDate').val(date);*/




$.get( 
                  "admin/getDate.php",
                  function(data) {
                  	tmpD = data;
/*                  	res = tmp.split(" ");
                  	res = res[1]+res[2];
                  	res = res.replace("\"", ""); 
                  	res = res.replace("\"", ""); 
                  	res = res.replace("}", ""); */
                  	date = tmpD.slice(13,33);
                     $('#endDate').val(date);
                  }
               );



$.get( 
                  "admin/getName.php",
                  function(data) {
                  	tmpN = data;
                  	resN = tmpN.split(":");
                  	resN = resN[1];
                  	resN = resN.replace("\"", ""); 
                  	resN = resN.replace("\"", ""); 
                  	resN = resN.replace("}", ""); 
                  	name = resN.replace("]", ""); 
                     $('#clanName').val(name);
                     $('#clanName2').val(name);

                  }
               );

/*$.get( 
                  "admin/getTimeleft.php",
                  function(data) {
                    tmpT = data;
                    resT = tmpT.split(":");
                    resT = resT[1];
                    resT = resT.replace("\"", ""); 
                    resT = resT.replace("\"", ""); 
                    resT = resT.replace("}", ""); 
                    resT = resT.replace("]", ""); 
                    dateT = resT.split(";");
                    dayT = dateT[0];
                    hourT = dateT[1];
                    minuteT = dateT[2];
                    secondT = dateT[3];
/*                    tempDay2 = tempDay.split("=");
                     dayT= tempDay[1];
                      $('#clanName').val(name);*/

                     // $('#clanName').val(hourT);
                     //$("#thisday").val(dayT);
                     //$("#thishour").val(hourT);
                     //$("#thismin").val(minuteT);
                  //}
               //);


//callback handler for form submit
$("#validDate").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    console.log(postData);
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            //data: return data from server
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });
    e.preventDefault(); //STOP default action
    // e.unbind(); //unbind. to stop multiple form submit.
    // location.reload();
});
 
// $("#validDate").submit(); //Submit  the FORM


//callback handler for form submit
$("#validName").submit(function(e)
{
    var CN = $("#clanName").val();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    // console.log(postData);
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            //data: return data from server
            //location.reload();
            $( "#clanName2" ).val( CN );
            $( "#clanName" ).val( CN );
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });
    e.preventDefault(); //STOP default action
    // e.unbind(); //unbind. to stop multiple form submit.
    // location.reload();
});
 






$("#timeleftX").submit(function(e)
{

    console.log(postData);


});
 

$("#timeleft").submit(function(e)
{
    // var DAY = $("#thisday").val();
    $( "#thisday option:selected" ).text();
/*    var HOUR = $("#thishour").val();
    var MINUTE = $("#thismin").val();*/
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    // console.log(postData);
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {

/*                     $("#thisday").val(DAY);
                     $("#thishour").val(HOUR);
                     $("#thismin").val(MINUTE);*/
                     $("#navbarGDC").load('navbarGDC.php');
/*                     var CN = $("#clanName").val();
                     $( "#clanName2" ).val( CN );*/





        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });
    e.preventDefault(); 



/*$.get( 
                  "admin/getName.php",
                  function(data) {
                    tmpN = data;
                    resN = tmpN.split(":");
                    resN = resN[1];
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("}", ""); 
                    name = resN.replace("]", ""); 
                     // $('#clanName').val(name);
                     $('#clanName2').val(name);

                  }
               );
*/


});











//callback handler for form submit
$("#clearAll").submit(function(e)
{
  console.log('postData');
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    console.log(postData);
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            //data: return data from server
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });
    e.preventDefault(); //STOP default action
    // e.unbind(); //unbind. to stop multiple form submit.
});
 
// $("#clearAll").submit(); //Submit  the FORM









	var options = { 
			target: '#output',   // target element(s) to be updated with server response 
			beforeSubmit: beforeSubmit,  // pre-submit callback 
			success: afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
}); 

function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg': 
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}


window.scrollTo(0, 0);


</script>



<link href="<?php echo HOMEPATH;?>/style/style.css" rel="stylesheet" type="text/css">



<br><br><br>
<font color=grey>ADMIN enemy villages |</font>
<hr>




<table width="700" cellspacing=0 border="0" cellpadding="0" align="center" summary="">

	  <tr>
	  	<td>
	  		<div id="ennemy_clan_name" class="subtitle"> 

<form name="validName" id="validName" action="admin/writeName.php" method="POST">
	  		ENNEMY CLAN NAME : 
	  		<input type="text" id="clanName" name="clanName" size="35">
	  		<button type="submit" style="width:100;">Submit</button>
	  		<br>
</form>
	  		</div>	
	  	
      <hr>

<div>
<?php
$folder = 'upload/server/php/files/thumbnail/';
$folderBig = 'upload/server/php/files/';
$filetype = '*.*';
$files = glob($folder.$filetype);
$filesBig = glob($folderBig.$filetype);
$count = count($files);
echo '<table>';
    echo '<tr><td>';
for ($i = 0; $i < $count; $i++) {
    //echo '<tr><td>';
    //echo $filesBig[$i];
    echo '<a name="'.$i.'" alt="'.$i.'" title="'.substr($files[$i],strlen($folder),strpos($files[$i], '.')-strlen($folder)).'" href="admin/'.$filesBig[$i].'" target="blank"><img src="admin/'.$files[$i].'" /></a>';
    echo '&nbsp';
    if($i==4 or $i==9 or $i==14 or $i==19){echo "<br><br>";}
    // echo '<img src="admin/'.$files[$i].'" />';
    // echo substr($files[$i],strlen($folder),strpos($files[$i], '.')-strlen($folder));
    //echo '</td></tr>';
}
echo '</td></tr>';
echo '</table>';
?>
</div>


	  	</td>
	  </tr>




<tr>
      <td>
      <hr>
        <div class="subtitle" style="display: inline-block;"> 




<table><tr>
<td>
<form name="ennemyNbattle" id="ennemyNbattle" action="admin/ennemyNbattle.php" method="POST">
        N BATTLE USED : ENNEMY 
        <input type="text" id="clanName" name="clanName" size="2" style="width:30;" value="0">
        <button type="submit" style="width:80;">Submit</button>
        <!-- <br> -->
</form>
</td>
<!--         </div>  

            <div class="subtitle">  -->
<td>
<form name="teamNbattle" id="teamNbattle" action="admin/teamNbattle.php" method="POST">
        &nbsp;TEAM : 
        <input type="text" id="clanName" name="clanName" size="2" style="width:30;" value="0">
        <button type="submit" style="width:80;">Submit</button>
        <br>
</form>
</td>
</tr></table>




        </div>    


        
      </td>
    </tr>





	  <tr>
	  	<td>
<hr>


	  		<div class="subtitle">
	  		

<!-- 
<form name="validDate" id="validDate" action="admin/writeEndDate.php" method="POST">
			END BATTLE DATE &nbsp;: 

	  		<input type="text" id="endDate" name="endDate" size="25">
	  		<a href="javascript:NewCal('endDate','ddmmmyyyy',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
	  		<span class="descriptions">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valid (wip)</span> 
	  		<button type="submit" style="width:82;">Submit (wip)</button>

</form>
-->


	  		
	  		</div>	
	  	








        <div class="subtitle"> 

<form name="timeleft" id="timeleft" action="admin/writeTimeleft.php" method="POST">


 GDC TIME LEFT : 

        DAY : 
<SELECT name="thisday" id='thisday'>
   <option value="1">1
   <option value="0">0




</SELECT>





        HOUR : 
<SELECT name="thishour" id='thishour'>
   <option value="0">0
   <option value="1">1
   <option value="2">2
   <option value="3">3
   <option value="4">4
   <option value="5">5
   <option value="6">6
   <option value="7">7
   <option value="8">8
   <option value="9">9
   <option value="10">10
   <option value="11">11
   <option value="12">12
   <option value="13">13
   <option value="14">14
   <option value="15">15
   <option value="16">16
   <option value="17">17
   <option value="18">18
   <option value="19">19
   <option value="20">20
   <option value="21">21
   <option value="22">22
   <option value="23">23



</SELECT>









        MIN : 
<SELECT name="thismin" id='thismin' >
   <option value="0">0
   <option value="1">1
   <option value="2">2
   <option value="3">3
   <option value="4">4
   <option value="5">5
   <option value="6">6
   <option value="7">7
   <option value="8">8
   <option value="9">9
   <option value="10">10
   <option value="11">11
   <option value="12">12
   <option value="13">13
   <option value="14">14
   <option value="15">15
   <option value="16">16
   <option value="17">17
   <option value="18">18
   <option value="19">19
   <option value="20">20
   <option value="21">21
   <option value="22">22
   <option value="23">23
   <option value="24">24
   <option value="25">25
   <option value="26">26
   <option value="27">27
   <option value="28">28
   <option value="29">29
   <option value="30">30
   <option value="31">31
   <option value="32">32
   <option value="33">33
   <option value="34">34
   <option value="35">35
   <option value="36">36
   <option value="37">37
   <option value="38">38
   <option value="39">39
   <option value="40">40
   <option value="41">41
   <option value="42">42
   <option value="43">43
   <option value="44">44
   <option value="45">45
   <option value="46">46
   <option value="47">47
   <option value="48">48
   <option value="49">49
   <option value="50">50
   <option value="51">51
   <option value="52">52
   <option value="53">53
   <option value="54">54
   <option value="55">55
   <option value="56">56
   <option value="57">57
   <option value="58">58
   <option value="59">59
</SELECT>


        <button type="submit" style="width:90px;">Submit</button>
        <br>

        </div>  







</form>







<hr>

	  		<div class="subtitle">



<form name="clearAll" id="clearAll" action="admin/clearAll.php" method="POST">


	  		<button type="submit" style="width:465px;">Clear All for New GDC Battle</button>

</form>



	  	
	  		</div>	


<hr>


	  	</td>
	  </tr>
	  
	  <tr>
	  	<td>
	  			<br>
	  			<div style ="border-radius: 25px;
    background: #8AC007;
        text-align: center;
         	line-height: 35px;
         vertical-align: middle;

    width: 465px;
    height: 35px;">
				<a href="<?php echo HOMEPATH;?>/admin/upload/index.html">UPLOAD VILLAGES IMAGES</a>
				</div>
	  	</td>
	  </tr>	  
        
</table>
<br>








<?php


// include($rootServerPath."/admin/upload/index.html");

?>


<script type="text/javascript">
$('#divLoading').hide();
</script>
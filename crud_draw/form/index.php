


<link rel="stylesheet" type="text/css" href="css/pure-min.css">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>






<script type="text/javascript"> 




    $(document).ready(function() {





/* Attach a submit handler to the form */
$("#comments").submit(function(event) {


 // alert("toto");


    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    // $("#result").html('');

    /* Get some values from elements on the page: */
    var values = $("#comments").serialize();

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "save_comments.php",
        type: "post",
        data: values,
        success: function(){
            // alert("success");
            // $("#result").html('Submitted successfully');
        },
        error:function(){
            alert("failure");
            // $("#result").html('There is error while submit');
        }
    });
});










});







    </script>









<!-- <div id="commentsDiv" class="commentsDiv"  >



  <form id="comments">
  Type Attaque : <input type="text" name="typeAttaque" id="typeAttaque" value="GOWIPE">



<textarea name="comment" id="comment" rows="10" style="width: 250px;height: 250px;">Enter text here...</textarea>   
<br>

  Auteur : <input type="text" name="auteurAttaque" id="auteurAttaque" value="anonymous">



<input type="text" name="nVillage" id="nVillage" value="2" style="display:none">


<input type="submit" value="Submit" style="opacity:80;"/>

<input type="text" name="nVillage" id="nVillage" value="666" style="display:none">

</form>











</div> -->











<form  id="comments" class="pure-form pure-form-stacked">
    <fieldset>
<!--         <legend>A Stacked Form</legend> -->

        <!-- <label for="email">Email</label> -->
        <input name="typeAttaque" id="typeAttaque" placeholder="Type Attaque ( GoWipe ...)" value="No Type">

        <!-- <label for="password">Password</label> -->
<!--         <input id="password" type="password" placeholder="Password"> -->
<textarea name="comment" id="comment" placeholder="Write your comments there ...">zaaaaaaaaaaa</textarea> 
<!-- <textarea name="comment" id="comment" rows="10" style="width: 250px;height: 250px;">Enter text here...</textarea>  -->

<!--         <label for="state">State</label>
        <select id="state">
            <option>AL</option>
            <option>CA</option>
            <option>IL</option>
        </select> -->

<!--         <label for="remember" class="pure-checkbox"> -->
<!--             <input name="auteurAttaque" id="auteurAttaque" type="checkbox"> Remember me -->
   
<input name="auteurAttaque" id="auteurAttaque" placeholder="Auteur Conseil Attaque" value="Anonymous">

<input type="text" name="nVillage" id="nVillage" value="2" style="display:none">



        <!-- <button type="submit" class="pure-button pure-button-primary">Submit</button> -->



<input type="submit" value="Submit" style="opacity:80;"/>



    </fieldset>
</form>








<?php

include("inc_links.php");

/*include("getArray_etoiles_ennemyWin.php");
include("getArray_etoiles_teamLost.php");*/

// include("calcul_etoiles.php");


$directoryBIG = DIRECTORY_BIG;
$directoryLOW = DIRECTORY_LOW;

?>


<br><br><br>
<font color=grey>MANAGE USERS (wip) |</font>
<hr>







<?php

include("crud_users/index.php");


?>



<script type="text/javascript">
$('#divLoading').hide();
</script>
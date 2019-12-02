<link rel="stylesheet" href="../css/pagination.css">
<?php
    /* On calcule le nombre de pages */
    $nombreDePages = ceil($totalResults / $showRecordPerPage)-1;
    $nombreDePages_bottom = ceil($totalResults / $showRecordPerPage);
    $page = $currentPage;
?>
<nav aria-label="Page navigation">


		

<div id="div_pagination" <?php echo $style_pagination; ?>>

					





<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
<div class="divTableCell" style="width:60px;"><?php echo $currentPage+1;?>/<?php echo $nombreDePages_bottom;?></div>

<div class="divTableCell" style="width:1%;padding-right:5px;">

<a class="btn btn-primary navigation_pages_before navigation_pages" role ="button" onclick="refresh_pageId('0');">FIRST</a>

</div>
<div class="divTableCell" style="width:500px;">
	



<?php

/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
* vers la précédente. On va donc l'afficher que si on est sur une autre
* page que la première */
// if ($page > 0):
	?><a class="btn btn-primary navigation_margin_right navigation_pages_before_after" role ="button" onclick="refresh_pageId('<?php echo $page - 1; ?>');"><</a>&nbsp;&nbsp;<?php
// endif;
/* On va effectuer une boucle autant de fois que l'on a de pages */
for ($i = 1; $i <= $nombreDePages; $i++):
	$bt_page_active = "";
	if($i==$currentPage){$bt_page_active='bt_pagination_active';}
	?><a class="btn btn-primary navigation_margin_right navigation_pages <?php echo $bt_page_active; ?>" role ="button" onclick="refresh_pageId('<?php echo $i;?>');"><?php echo $i+1;?></a><?php
endfor;
/* Avec le nombre total de pages, on peut aussi masquer le lien
* vers la page suivante quand on est sur la dernière */
// if ($page < $nombreDePages):
	?>&nbsp;&nbsp;<a class="btn btn-primary navigation_margin_right navigation_pages_before_after navigation_pages_after" role ="button"  onclick="refresh_pageId('<?php echo $page + 1; ?>');">></a><?php
// endif;
?>
<script>
    var nombreDePages = '<?php echo $nombreDePages; ?>';
</script>

<a class="btn btn-primary navigation_margin_right navigation_pages_before_after" role ="button" onclick="refresh_pageId('<?php echo $nombreDePages; ?>');">LAST</a>


</div>
<div class="divTableCell" style="width:1%;">


</div>

<div class="divTableCell">
	

					<select id="select_n_byPage" class="select_n_byPage" data-role="select">
					<?php
					foreach($array_select_n_byPage as $n){
						echo "<option value='$n'>$n</option>";
					}
					?>
					</select>
					<i class="a_result_perPage">results per page</i> | tot : <?php echo $totalResults;?> 


</div>

<div class="divTableCell" style="width:1%;"><?php echo $currentPage+1;?>/<?php echo $nombreDePages_bottom;?></div>

</div>
</div>
</div>







</div>

</nav>
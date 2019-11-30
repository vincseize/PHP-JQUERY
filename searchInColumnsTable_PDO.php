
    public function searchInColumnsTable($Table, $Search)
    {

        $results = array();

        $searchphrase = $Search;
        $table = $Table;
        $sql_search = "SELECT * FROM " . $table . " WHERE ";
        $sql_search_fields = Array();
        $sql = "SHOW COLUMNS FROM " . $table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row){
            $colum = $row['Field'];
            $sql_search_fields[] = $colum . " LIKE('%" . $searchphrase . "%')";
        }

        $sql_search .= implode(" OR ", $sql_search_fields);

        $stmt = $this->pdo->prepare($sql_search);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row){
            array_push($results, $row);
        }

		return $results;
	}
  
  include_once('config.php');
	
	$searchs = $db->searchInColumnsTable( 'reservations','tatar');
	$n_searchs = count($searchs);
	print_r($n_searchs);
	print_r("<br>");
	print_r($searchs);
  
  

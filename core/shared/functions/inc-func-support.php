<?
// SUPPORT FUNCTIONS

//GET Department Name Knowledgebase Swedish
function KBDepartmentSE($DPID) {
	global $SQLlink;

	$strSQL = "SELECT * FROM app_faqs_departments WHERE id = '$DPID'";
  	$results = mysqli_query($SQLlink,$strSQL);
	$CHECK = mysqli_num_rows($results);

	if ($CHECK != 0) {

		// GET contactname FROM DATABASE
		$strSQL = "
			SELECT 
			 name_se
			FROM app_faqs_departments
			WHERE id = '$DPID'
			LIMIT 1";
		$result = mysqli_query( $SQLlink, $strSQL );
		$row = mysqli_fetch_assoc( $result );

		$DepName = $row[ 'name_se' ];
		return $DepName;
	} 	
	
}

//GET Department Name Knowledgebase English
function KBDepartmentEN($DPID) {
	global $SQLlink;

	$strSQL = "SELECT * FROM app_faqs_departments WHERE id = '$DPID'";
  	$results = mysqli_query($SQLlink,$strSQL);
	$CHECK = mysqli_num_rows($results);

	if ($CHECK != 0) {

		// GET contactname FROM DATABASE
		$strSQL = "
			SELECT 
			 name_en
			FROM app_faqs_departments
			WHERE id = '$DPID'
			LIMIT 1";
		$result = mysqli_query( $SQLlink, $strSQL );
		$row = mysqli_fetch_assoc( $result );

		$DepName = $row[ 'name_en' ];
		return $DepName;
	} 	
	
}

?>
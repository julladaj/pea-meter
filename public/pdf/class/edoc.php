<?php
class _eDocument extends Database {
	
	public function getAppointmentLettersDetail($edoc_appointment_id, $token) {
  try {
			$sql_command = "
SELECT  
	e.*,
	DAY(`document_date`) AS d,
	MONTH(`document_date`) AS m,
	YEAR(`document_date`) AS y,
	c.`customer_name`,
	c.`address` AS `customer_address`
FROM `edoc_appointment` e
LEFT JOIN `customer` c 
	ON c.`customer_id` = e.`customer_id`
WHERE 
	e.`edoc_appointment_id` = " . (int)$this->mysqli->real_escape_string($edoc_appointment_id) . " AND 
	e.`token` = '" . $this->mysqli->real_escape_string($token) . "'";

   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    return $row;
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return array();
	}
	
}
?>
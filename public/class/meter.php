<?php
class Meter extends Database {
	
	public function getJSONMeter($filter = array()) {
  $rows = array(
   'total' => 0,
   'items' => array()
  );
  
  try {
			//file_put_contents('log.txt', print_r($filter, true));
			
   $sql_command = "
SELECT SQL_CALC_FOUND_ROWS 
	m.*,
	mc.`meter_category_detail`,
	mq.`meter_qc_detail`,
	msz.`meter_size_detail`,
	msf.`meter_staff_name` AS `recipient_name`,
	msf2.`meter_staff_name` AS `officer_name`
FROM `meter` m
LEFT JOIN `meter_category` mc
	ON mc.`meter_category_id` = m.`meter_category_id`
LEFT JOIN `meter_qc` mq
	ON mq.`meter_qc_id` = m.`meter_qc_id`
LEFT JOIN `meter_size` msz
	ON msz.`meter_size_id` = m.`meter_size_id`
LEFT JOIN `meter_staff` msf
	ON msf.`meter_staff_id` = m.`recipient`
LEFT JOIN `meter_staff` msf2
	ON msf.`meter_staff_id` = m.`officer`";

			$implode = array();
			foreach ($filter['columns'] as $columns) {
				if (isset($columns['search']['value']) && $columns['search']['value']) {
					switch ($columns['data']) {
						case 'fname':
							$implode[] = '`' . $columns['data'] . '` LIKE \'%' . $this->mysqli->real_escape_string($columns['search']['value']) . '%\'';
							break;
						case 'recipient_name':
							$implode[] = 'msf.`meter_staff_name` LIKE \'%' . $this->mysqli->real_escape_string($columns['search']['value']) . '%\'';
							break;
						case 'auto_id':
						case 'number1':
						case 'telephone':
							$implode[] = '`' . $columns['data'] . '` LIKE \'' . $this->mysqli->real_escape_string($columns['search']['value']) . '%\'';
							break;
						case 'date_add':
							$date_filter = explode("|", $columns['search']['value']);
							$date_start = explode("/", $date_filter[0]);
							$date_end = explode("/", $date_filter[1]);
							$implode[] = "(`" . $columns['data'] . "` BETWEEN '" . $date_start[2] . "-" . $date_start[0] . "-" . $date_start[1] . "' AND '" . $date_end[2] . "-" . $date_end[0] . "-" . $date_end[1] . "')";
							break;
						default:
							$implode[] = '`' . $columns['data'] . '` = \'' . $this->mysqli->real_escape_string($columns['search']['value']) . '\'';
							break;
					}
					
				}
			}
			if (count($implode)) {
				$sql_command .= " WHERE " . implode(" AND ", $implode);
			}

			if (isset($filter['order']) and $filter['order']) {
				$implode = array();
				foreach ($filter['order'] as $order) {
					$column = $order['column'];
					if (isset($filter['columns'][$column]['data'])) {
						$implode[] = '`' . $filter['columns'][$column]['data'] . '` ' . $order['dir'];
					}
				}
				if (count($implode)) {
     $sql_command .= " ORDER BY " . implode(", ", $implode);
    } else $sql_command .= " ORDER BY m.`date_add` DESC";
   }
   if (isset($filter['start']) and isset($filter['length'])) {
    $sql_command .= " LIMIT " . $filter['start'] . ", " . $filter['length'];
   }

			//file_put_contents('log.txt', "\n" . $sql_command);
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
				$row['Actions'] = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="loadModalAJAX(this)" href="javascript:;" url="/modal/meter_detail.php?auto_id=' . $row['auto_id'] . '"><i class="la la-pencil-square"></i></a>';
    $rows['items'][] = $row;
   }
   
   $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['total'] = $row['total_rows'];
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
 }
	
	public function getJSONDocument($filter = array()) {
  $rows = array(
   'total' => 0,
   'items' => array()
  );
  
  try {
			//file_put_contents('log.txt', print_r($filter, true));
			
   $sql_command = "
SELECT SQL_CALC_FOUND_ROWS 
	dt.*,
	ms.`meter_size_detail`,
	mst.`meter_staff_name`,
	mst2.`meter_staff_name` AS `sap_staff_name`
FROM `document_transaction` dt
LEFT JOIN `meter_size` ms
	ON ms.`meter_size_id` = dt.`meter_size_id`
LEFT JOIN `meter_staff` mst
	ON mst.`meter_staff_id` = dt.`meter_staff_id`
LEFT JOIN `meter_staff` mst2
	ON mst2.`meter_staff_id` = dt.`sap_staff_id`";

			$implode = array();
   if (isset($filter['filter'])) {
    $filter['filter'] = json_decode($filter['filter'], true);
   
    foreach($filter['filter'] as $field => $value) {
     $implode[] = "LOWER(`" . $field . "`) LIKE '%" . strtolower($this->mysqli->real_escape_string($value)) . "%'";
    }
    
    if (count($implode)) {
     $sql_command .= " WHERE " . implode(" AND ", $implode);
    }
   }

			if (isset($filter['sort']) and isset($filter['order']) and $filter['sort']) {
    $sql_command .= " ORDER BY " . $filter['sort'] . " " . $filter['order'];
   }
   if (isset($filter['offset']) and isset($filter['limit'])) {
    $sql_command .= " LIMIT " . $filter['offset'] . ", " . $filter['limit'];
   }

			//file_put_contents('log.txt', "\n" . $sql_command, FILE_APPEND);
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
				$row['Actions'] = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="loadModalAJAX(this)" href="javascript:;" url="/modal/meter_detail.php?auto_id=' . $row['auto_id'] . '"><i class="la la-pencil-square"></i></a>';
    $rows['items'][] = $row;
   }
   
   $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['total'] = $row['total_rows'];
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
 }
	
	
	
	public function getMeterDetail($record_id, $token) {
		$rows = array(
   'total' => 0,
   'items' => array()
  );
  
  try {
			$sql_command = "
SELECT
	dt.*,
	ms.`meter_size_detail`,
	mst.`meter_staff_name`,
	mst.`meter_staff_position`
FROM `document_transaction` dt
LEFT JOIN `meter_size` ms
	ON ms.`meter_size_id` = dt.`meter_size_id`
LEFT JOIN `meter_staff` mst
	ON mst.`meter_staff_id` = dt.`meter_staff_id`
WHERE 
	dt.`record_id` = '" . $this->mysqli->real_escape_string($record_id) . "' AND
	dt.`token` = '" . $this->mysqli->real_escape_string($token) . "'";
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['items'][] = $row;
   }
   
   $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['total'] = $row['total_rows'];
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
	}
	
	public function getMeterStaff() {
		$rows = array(
   'total' => 0,
   'items' => array()
  );
  
  try {
			$sql_command = "SELECT SQL_CACHE * FROM `meter_staff` ORDER BY `sort_index` ASC";
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
			$rows['items'] = $query->fetch_all(MYSQLI_ASSOC);
   /*while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['items'][] = $row;
   }*/
   
   $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['total'] = $row['total_rows'];
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
	}
	
	public function getMeterSize() {
		$rows = array(
   'total' => 0,
   'items' => array()
  );
  
  try {
			$sql_command = "SELECT SQL_CACHE * FROM `meter_size`";
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['items'][] = $row;
   }
   
   $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows['total'] = $row['total_rows'];
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
	}
	
	public function getFullColumns($table_name) {
		$rows = array();
  
  try {
			$sql_command = "SHOW FULL COLUMNS FROM `" . $table_name . "`";
			
   $query = $this->mysqli->query($sql_command);
   if (!$query) throw new Exception($this->mysqli->error);
   while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
   }
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
		}
  
  return $rows;
	}
	
	
	
	public function updateMeter($data) {
		$sql_command = '';
		$rows = array(
   'record_id' => 0,
   'token' => ''
  );
  
		try {
			if (!isset($data['token'])) throw new Exception('Need token to process!');
			if (!isset($data['record_id'])) throw new Exception('Need record_id to process!');
			//if (!isset($data['customer_name'])) throw new Exception('Need customer_name to process!');
			
			//file_put_contents("log.txt", print_r($data, true));

			$rows['token'] = $data['token'];
			
			$implode = array();
			foreach($data as $field => $value) {
				switch ($field) {
					case 'record_id':
						continue;
					break;
					default:
						if ($value) {
							$implode[] = "`" . $field . "` = '" . $this->mysqli->real_escape_string($value) . "'";
						} else {
							$implode[] = "`" . $field . "` = NULL";
						}
					break;
				}
   }
			if (!count($implode)) throw new Exception('Need data to process!');
			
			
			
			$result = $this->getMeterDetail($data['record_id'], $data['token']);
			if ($result['total']) {
			
				// UPDATE
					$sql_command = "
UPDATE `document_transaction`
SET 
	" . implode(",", $implode) . "
WHERE 
	`record_id` = '" . $this->mysqli->real_escape_string($data['record_id']) . "' AND
	`token` = '" . $this->mysqli->real_escape_string($data['token']) . "'";
				//file_put_contents("log.txt", $sql_command);
				$query = $this->mysqli->query($sql_command);
				if ($query) {
					$rows['record_id'] = $data['record_id'];
				} else throw new Exception($this->mysqli->error);
			} else {
			
				// INSERT
				$sql_command = "
INSERT INTO `document_transaction`
SET 
	" . implode(",", $implode);
				//file_put_contents("log.txt", $sql_command);
				$query = $this->mysqli->query($sql_command);
				if ($query) {
					$rows['record_id'] = $this->mysqli->insert_id;
				} else throw new Exception($this->mysqli->error);
			}
		} catch (Exception $e){
			$_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
   file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage() . "\nLeatest SQ:\n" . $sql_command);
		}
		
		return $rows;
	}
	
}
?>
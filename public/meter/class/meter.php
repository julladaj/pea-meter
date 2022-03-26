<?php

class _Meter extends Database
{

    public function getMeterClient($search)
    {
        try {
            //file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", print_r($filter, true));

            $sql_command = "
SELECT 
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
	ON msf.`meter_staff_id` = m.`recipient_id`
LEFT JOIN `meter_staff` msf2
	ON msf2.`meter_staff_id` = m.`officer_id`";

            if ($search) {
                $sql_command .= "
WHERE 
	m.`auto_id` = '" . $this->mysqli->real_escape_string($search) . "' OR 
	m.`telephone` = '" . $this->mysqli->real_escape_string($search) . "' OR 
	m.`fname` = '" . $this->mysqli->real_escape_string($search) . "' OR
	m.`number1` = '" . $this->mysqli->real_escape_string($search) . "'";
            } else {
                $sql_command .= " WHERE 0";
            }

            $sql_command .= " ORDER BY m.`auto_id` DESC LIMIT 1";

            //file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $sql_command);

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                return $row;
            }
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return false;
    }

    public function getMeterStaff(?array $filters = [])
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "SELECT * FROM `meter_staff` WHERE `meter_staff_active` = 1";

            if ($filters) {
                foreach ($filters as $column => $value) {
                    $value = $this->mysqli->real_escape_string($value);
                    $sql_command .= " AND `$column` = '$value'";
                }
            }

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    /**
     * @param $sql_command
     * @param  array  $rows
     * @return array
     * @throws Exception
     */
    private function getRowsWithPaginate($sql_command, array $rows)
    {
        $query = $this->mysqli->query($sql_command);
        if (!$query) {
            throw new Exception($this->mysqli->error);
        }
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $rows['items'][] = $row;
        }

        $query = $this->mysqli->query("SELECT FOUND_ROWS() AS `total_rows`;");
        if (!$query) {
            throw new Exception($this->mysqli->error);
        }
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $rows['total'] = $row['total_rows'];
        }
        return $rows;
    }

    public function getMeterSize()
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "SELECT * FROM `meter_size` ORDER BY `sort_index` ASC, `meter_size_id` ASC";

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getJobTypes()
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "SELECT * FROM `job_type` ORDER BY `enum` ASC, `description` ASC";

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getJobInstallationPrices(array $param)
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "
SELECT 
       j.`id`,
       j.`description`,
       it.`price`,
       it.`price_special`
FROM `job_type` j
LEFT JOIN `installation_price` it ON 
	it.`job_type_id` = j.`id`
";

            if ($param) {
                $condition = [];
                foreach ($param as $field => $value) {
                    $condition[] = "j.`$field` = '$value'";
                }
                if ($condition) {
                    $sql_command .= ' WHERE ' . implode(' AND ', $condition);
                }
            }

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function postJobInstallationPrices(array $prices): bool
    {
        try {
            if (!count($prices)) {
                throw new Exception('Value is empty!');
            }

            $query = $this->mysqli->query("TRUNCATE TABLE `installation_price`;");
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }

            $sql_command = "INSERT INTO `installation_price` (`job_type_id`, `price`, `price_special`) VALUES ";
            $implode = [];
            foreach ($prices as $key => $value) {
                $price = $value['price'] ?? 0;
                $price_special = $value['price_special'] ?? 0;

                $implode[] = '(' . $key . ', ' . $price . ', ' . $price_special . ')';
            }

            if (!$implode) {
                throw new Exception('Empty after implode!');
            }
            $sql_command .= implode(',', $implode) . ';';

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }

            return true;
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return false;
    }

    public function getMeterCategory()
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "SELECT * FROM `meter_category` ORDER BY `sort_index` ASC, `meter_category_id` ASC";

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getMeterQC()
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            $sql_command = "SELECT * FROM `meter_qc` ORDER BY `sort_index`";

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getFullColumns($table_name)
    {
        $rows = array();

        try {
            $sql_command = "SHOW FULL COLUMNS FROM `" . $table_name . "`";

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function recheck_request($id)
    {
        try {
            $sql_command = "UPDATE `meter` SET `request_button` = 0 WHERE `auto_id` = " . (int)$id;

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            return 1;
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return 0;
    }


    public function updateMeter($data)
    {
        $sql_command = '';
        $rows = array(
            'auto_id' => 0,
            'token' => ''
        );

        try {
            if (!isset($data['token'])) {
                throw new Exception('Need token to process!');
            }
            if (!isset($data['auto_id'])) {
                throw new Exception('Need auto_id to process!');
            }
            //if (!isset($data['customer_name'])) throw new Exception('Need customer_name to process!');

            //file_put_contents("log.txt", print_r($data, true));

            $rows['token'] = $data['token'];

            $implode = array();
            foreach ($data as $field => $value) {
                switch ($field) {
                    case 'auto_id':
                        continue;
                        break;
                    case 'payment_value':
                        if (!$value || $value == '' || $value <= 0) {
                            $implode[] = "`payment_value` = 0";
                        } else {
                            $implode[] = "`payment_value` = '" . $this->mysqli->real_escape_string($value) . "'";
                        }
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
            if (!count($implode)) {
                throw new Exception('Need data to process!');
            }


            $filter = array('auto_id' => $data['auto_id'], 'token' => $data['token']);
            $result = $this->getJSONMeter(array('filter' => json_encode($filter)));
            if ($result['total']) {
                // UPDATE
                $sql_command = "
UPDATE `meter`
SET 
	`request_button` = 1,
	" . implode(",", $implode) . "
WHERE 
	`auto_id` = '" . $this->mysqli->real_escape_string($data['auto_id']) . "' AND
	`token` = '" . $this->mysqli->real_escape_string($data['token']) . "'";
                //file_put_contents("log.txt", $sql_command);
                $query = $this->mysqli->query($sql_command);
                if ($query) {
                    $rows['auto_id'] = $data['auto_id'];
                } else {
                    throw new Exception($this->mysqli->error);
                }
            } else {
                // INSERT
                $sql_command = "
INSERT INTO `meter`
SET 
	" . implode(",", $implode);
                //file_put_contents("log.txt", $sql_command);
                $query = $this->mysqli->query($sql_command);
                if ($query) {
                    $rows['auto_id'] = $this->mysqli->insert_id;
                } else {
                    throw new Exception($this->mysqli->error);
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(
                "log/class." . get_class() . "." . __FUNCTION__ . ".txt",
                $e->getMessage() . "\nLeatest SQ:\n" . $sql_command
            );
        }

        return $rows;
    }

    public function getJSONMeter($filter = array())
    {
        $rows = array(
            'total' => 0,
            'items' => array()
        );

        try {
            //file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", print_r($filter, true));

            $sql_command = "
SELECT SQL_CALC_FOUND_ROWS 
	m.*,
	mc.`meter_category_detail`,
	mq.`meter_qc_detail`,
	msz.`meter_size_detail`,
	msf.`meter_staff_name` AS `recipient_name`,
	msf2.`meter_staff_name` AS `officer_name`,
	jt.`description` AS `job_type_name`,
    ip.`price` AS `installation_price`,
    ip.`price_special` AS `installation_price_special`
FROM `meter` m
LEFT JOIN `meter_category` mc
	ON mc.`meter_category_id` = m.`meter_category_id`
LEFT JOIN `meter_qc` mq
	ON mq.`meter_qc_id` = m.`meter_qc_id`
LEFT JOIN `meter_size` msz
	ON msz.`meter_size_id` = m.`meter_size_id`
LEFT JOIN `meter_staff` msf
	ON msf.`meter_staff_id` = m.`recipient_id`
LEFT JOIN `meter_staff` msf2
	ON msf2.`meter_staff_id` = m.`officer_id`
LEFT JOIN `job_type` jt
	ON jt.`id` = m.`job_type_id`
LEFT JOIN `installation_price` ip 
    ON ip.`job_type_id` = jt.`id`";

            $implode = array();
            if (isset($filter['filter'])) {
                $filter['filter'] = json_decode($filter['filter'], true);

                foreach ($filter['filter'] as $field => $value) {
                    switch ($field) {
                        case 'date_add':
                        case 'date_appoint':
                        case 'date_payment':
                        case 'date_install':
                        case 'date_deathline':
                        case 'date_finish':
                            //$implode[] = "DATE_FORMAT(m.`" . $field . "`, '%m/%d/%Y') = '" . $this->mysqli->real_escape_string($value) . "'";
                            $implode[] = "m.`" . $field . "` = '" . $this->mysqli->real_escape_string($value) . "'";
                            break;
                        case 'start':
                            $implode[] = "m.`date_add` >=  '" . $this->mysqli->real_escape_string($value) . "'";
                            break;
                        case 'end':
                            $implode[] = "m.`date_add` <=  '" . $this->mysqli->real_escape_string($value) . "'";
                            break;
                        case 'date_range':
                            $date_tange = explode(" | ", $value);
                            if (isset($date_tange[0], $date_tange[1])) {
                                $implode[] = "m.`date_add` BETWEEN '" . $this->mysqli->real_escape_string($date_tange[0]) . "' AND '" . $this->mysqli->real_escape_string($date_tange[1]) . "' ";
                            }
                            break;
                        case 'recipient_id':
                        case 'officer_id':
                        case 'meter_qc_id':
                        case 'meter_category_id':
                            $implode[] = "m.`" . $field . "` = '" . $this->mysqli->real_escape_string($value) . "'";
                            break;
                        default:
                            $implode[] = "LOWER(`" . $field . "`) LIKE '%" . strtolower(
                                    $this->mysqli->real_escape_string($value)
                                ) . "%'";
                            break;
                    }
                }

                if (count($implode)) {
                    $sql_command .= " WHERE " . implode(" AND ", $implode);
                }
            }

            $implode = array();

            if (isset($filter['sort'], $filter['order']) && $filter['sort']) {
                $implode[] = "`" . $filter['sort'] . "` " . strtoupper($filter['order']);
            }
            if (isset($filter['multiSort'])) {
                foreach ($filter['multiSort'] as $value) {
                    if (isset($value['sortName'])) {
                        $implode[] = "`" . $value['sortName'] . "` " . strtoupper($value['sortOrder'] ?? '');
                    }
                }
            }
            if (count($implode)) {
                $sql_command .= " ORDER BY " . implode(", ", $implode);
            } else {
                $sql_command .= " ORDER BY m.`date_add` ASC, m.`auto_id` ASC";
            }

            if (isset($filter['offset']) and isset($filter['limit'])) {
                $sql_command .= " LIMIT " . $filter['offset'] . ", " . $filter['limit'];
            }

            $rows = $this->getRowsWithPaginate($sql_command, $rows);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function deleteMeter($auto_id, $token)
    {
        $rows = array(
            'success' => 0
        );

        try {
            $sql_command = "
DELETE FROM `meter`
WHERE 
	`auto_id` = " . (int)$auto_id . " AND 
	`token` = '" . $this->mysqli->real_escape_string($token) . "'";
            $query = $this->mysqli->query($sql_command);
            if ($query) {
                $rows['success'] = 1;
            } else {
                throw new Exception($this->mysqli->error);
            }
        } catch (Exception $e) {
            $rows['error'] = $e->getMessage();
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(
                "log/class." . get_class() . "." . __FUNCTION__ . ".txt",
                $e->getMessage() . "\nLatest SQ:\n" . $sql_command
            );
        }

        return $rows;
    }

}

?>

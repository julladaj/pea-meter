<?php

class report extends Database
{
    public function getMonthlyReplacement($filter = [])
    {
        $rows = [];

        try {
            if (!isset($filter['date_workorder_start'])) {
                return [];
            }
            $start_date = date("Y-m-d", strtotime($filter['date_workorder_start']));
            $end_date = date("Y-m-d", strtotime($filter['date_workorder_end']));

            $special_ford_no = $this->getMetaData('ford_no');
            $special_ford_no = $special_ford_no['ford_no'] ?? [];
            $special_ford_no_list = "'" . implode("','", $special_ford_no) . "'";

            $job_type_enum = $filter['job_type_enum'] ?? '1';

            $sql_command = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
            $this->mysqli->query($sql_command);

            $sql_command = "
SELECT 
    jt.`enum`,
    jt.`description` AS `job_type_name`,";

            for ($i = 0; $i <= 30; $i++) {
                $current_date = date("Y-m-d", strtotime($start_date . "+$i day"));
                $sql_command .= "
CASE WHEN DATE(m.`date_workorder`) = '$current_date' THEN COUNT(m.`auto_id`) ELSE 0 END AS d_$i,
CASE WHEN DATE(m.`date_workorder`) = '$current_date' AND m.`fort_cable` IN ($special_ford_no_list) THEN COUNT(m.`auto_id`) ELSE 0 END AS d_s_$i,
";
                if ($current_date === $end_date) {
                    break;
                }
            }

            $sql_command .= "
    COUNT(m.`auto_id`) AS count_id,
    ip.`price`,
    ip.`price_special`
FROM `job_type` jt
LEFT JOIN `meter` m
	ON jt.`id` = m.`job_type_id` AND DATE(m.`date_workorder`) BETWEEN '$start_date' AND '$end_date'";

            if (isset($filter['recipient_id']) && $filter['recipient_id']) {
                $sql_command .= " AND m.`recipient_id` = " . $filter['recipient_id'];
            }

            $sql_command .= "
LEFT JOIN `installation_price` ip 
    ON ip.`job_type_id` = jt.`id`
WHERE jt.`enum` = '$job_type_enum'
GROUP BY jt.`id`
ORDER BY jt.`id` ASC";

//            dd($sql_command);
            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getMetersP3($startDate, $endDate, $filter = []): array {
        $rows = [];

        try {
            $startDate = $this->mysqli->real_escape_string($startDate);
            $endDate = $this->mysqli->real_escape_string($endDate);

            $sql_command = "
SELECT 
       ms.`meter_staff_name`, 
       m.`number1` AS `pea_no`,
       m.`fname` AS `customer_name`,
       m.`date_payment`,
       m.`date_install`,
       m.`meter_accept_date`,
       m.`meter_store_date`,
       m.`account_receive_date`,
       m.`account_reject_date`,
       m.`account_accept_date`
FROM `meter` m
LEFT JOIN meter_staff ms ON 
    m.`recipient_id` = ms.`meter_staff_id`
WHERE m.`date_payment` BETWEEN '$startDate' AND '$endDate'";

            if ($filter && is_array($filter)) {
                $implode = [];
                foreach ($filter as $key => $value) {
                    $value = $this->mysqli->real_escape_string($value);
                    $key = $this->mysqli->real_escape_string($key);
                    $implode[] = "`$key` = '$value'";
                }
                if ($implode) {
                    $sql_command .= " AND " . implode(' AND ', $implode);
                }
            }

            $sql_command .= " ORDER BY m.`date_payment` ASC";

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            $rows = $query->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents(DIR_ROOT . "log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }

    public function getMetaData($filter = null): array
    {
        $rows = [];

        try {
            $sql_command = "SELECT `meta_key`, `meta_value` FROM `meta_data`";

            if ($filter) {
                if (is_string($filter)) {
                    $filter = $this->mysqli->real_escape_string($filter);
                    $sql_command .= " WHERE `meta_key` = '$filter';";
                }
                if (is_array($filter)) {
                    $implode = [];
                    foreach ($filter as $meta_key) {
                        $meta_key = $this->mysqli->real_escape_string($meta_key);
                        $implode[] = "`$meta_key` = '$meta_key'";
                    }
                    if ($implode) {
                        $sql_command .= " WHERE " . implode(' OR ', $implode);
                    }
                }
            }

            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $rows[$row['meta_key']] = json_decode($row['meta_value'], true, 512, JSON_THROW_ON_ERROR);
            }
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }

        return $rows;
    }
}
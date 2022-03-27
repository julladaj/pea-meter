<?php

class report extends Database
{
    public function getMonthlyReplacement($filter = [])
    {
        $rows = [];

        try {
            if (!isset($filter['date'])) {
                return [];
            }

            $time = strtotime($filter['date']);
            $first_day_of_month = date("Y-m-1", $time);
            $first_day = 1;
            $last_day_of_month = date("Y-m-t", $time);
            $last_day = (int)date("t", $time);

            $special_ford_no = $this->getMetaData('ford_no');
            $special_ford_no = $special_ford_no['ford_no'] ?? [];
            $special_ford_no_list = "'" . implode("','", $special_ford_no) . "'";

            $job_type_enum = $filter['job_type_enum'] ?? '1';

            $sql_command = "
SELECT 
    jt.`enum`,
    jt.`description` AS `job_type_name`,";

            for ($i = $first_day; $i <= $last_day; $i++) {
                $sql_command .= "
CASE WHEN DAY(m.`date_workorder`) = '$i' THEN COUNT(m.`auto_id`) ELSE 0 END AS d_$i,
CASE WHEN DAY(m.`date_workorder`) = '$i' AND m.`fort_cable` IN ($special_ford_no_list) THEN COUNT(m.`auto_id`) ELSE 0 END AS d_s_$i,
";
            }

            $sql_command .= "
    COUNT(m.`auto_id`) AS count_id,
    ip.`price`,
    ip.`price_special`
FROM `job_type` jt
LEFT JOIN `meter` m
	ON jt.`id` = m.`job_type_id` AND m.`date_workorder` BETWEEN '$first_day_of_month' AND '$last_day_of_month'";

            if (isset($filter['recipient_id']) && $filter['recipient_id']) {
                $sql_command .= " AND m.`recipient_id` = " . $filter['recipient_id'];
            }

            $sql_command .= "
LEFT JOIN `installation_price` ip 
    ON ip.`job_type_id` = jt.`id`
WHERE jt.`enum` = '$job_type_enum'
GROUP BY jt.`id`
ORDER BY jt.`id` ASC";

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
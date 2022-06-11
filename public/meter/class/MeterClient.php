<?php

class MeterClient extends Database
{
    /**
     * @param $id
     * @param $date_finish
     * @return bool
     */
    public function updateMeterClient($id, $date_finish): bool
    {
        try {
            // UPDATE
            $sql_command = "
UPDATE `meter`
SET `date_finish` = '{$this->mysqli->real_escape_string($date_finish)}'
WHERE `auto_id` = '{$this->mysqli->real_escape_string($id)}'";
            //file_put_contents("log.txt", $sql_command);
            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new \RuntimeException($this->mysqli->error);
            }
            return true;
        } catch (Exception $e) {
            $_SESSION['error'][] = "log/class." . get_class() . "." . __FUNCTION__ . ".txt<br>" . $e->getMessage();
            file_put_contents("log/class." . get_class() . "." . __FUNCTION__ . ".txt", $e->getMessage());
        }
        return false;
    }
}
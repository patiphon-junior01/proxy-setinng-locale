<?php
include("data.php");

class db extends config
{



    function select_manaul_field($table, array $field_arr)
    {
        $sql = 'SELECT ' . implode(',', $field_arr) . ' FROM ' . $table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    function select_manaul_fieldConition($table, array $field_arr, $condition)
    {
        $sql = 'SELECT ' . implode(',', $field_arr) . ' FROM ' . $table . " WHERE " . $condition;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_manaul_fieldORDER_BY($table, array $field_arr, $condition)
    {
        $sql = 'SELECT ' . implode(',', $field_arr) . ' FROM ' . $table . " ORDER BY " . $condition;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_count_table($table)
    {
        $sql = 'SELECT count(*) as count FROM ' . $table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }


    function select_manual($table, array $select_field_arr, array $where_arr, array $value_arr)
    {
        $sql = 'SELECT ' . implode(', ', $select_field_arr) . ' FROM ' . $table . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ? ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($value_arr);
        $result = $stmt->fetch();
        return $result;
    }

    function select_manual_andWithout($table, array $select_field_arr, array $where_arr, array $value_arr, $where, $value)
    {
        $sql = 'SELECT ' . implode(', ', $select_field_arr) . ' FROM ' . $table . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ?  AND ' . $where . ' != ' . $value;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($value_arr);
        $result = $stmt->fetch();
        return $result;
    }

    function select_manualAll($table, array $select_field_arr, array $where_arr, array $value_arr)
    {
        $sql = 'SELECT ' . implode(', ', $select_field_arr) . ' FROM ' . $table . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ? ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($value_arr);
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_manualAllcondition($table, array $select_field_arr, array $where_arr, array $value_arr, $condition)
    {
        $sql = 'SELECT ' . implode(', ', $select_field_arr) . ' FROM ' . $table . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ? ' . $condition;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($value_arr);
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_is_not_null($table, string $select_field)
    {
        $sql = 'SELECT ' . $select_field .  ',id  FROM ' . $table . ' WHERE ' . $select_field . ' IS NOT NULL';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_is_not_null_field($table, string $select_field, string $field_default)
    {
        $sql = 'SELECT ' . $select_field .  ', id  FROM ' . $table . ' WHERE ' . $field_default . ' IS NOT NULL';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_is_not_null_field_condition($table, string $select_field, string $field_default, string $and)
    {
        $sql = 'SELECT ' . $select_field .  '  FROM ' . $table . ' WHERE ' . $field_default . ' IS NOT NULL ' . $and;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_count_where($table, array $field_arr, array $value_arr)
    {
        $sql = 'SELECT count(*) as count  FROM ' . $table . ' WHERE ' . implode(' = ? AND ', $field_arr) . ' = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($value_arr);
        $result = $stmt->fetch();
        return $result['count'];
    }


    function select_countAll($table)
    {
        $sql = 'SELECT count(*) as count  FROM ' . $table . ' ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    function select_belong($table, $belong_table, $select_field, string $on, array $where_arr, array $where_value_arr)
    {
        $sql = 'SELECT ' . $select_field . ' FROM ' . $table . ' LEFT JOIN ' . $belong_table . ' ON ' . $on . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($where_value_arr);
        $result = $stmt->fetch();
        return $result;
    }

    function select_join_group($table, $belong_table, $select_field, string $on, array $where_arr, array $where_value_arr)
    {
        $sql = 'SELECT ' . $select_field . ' FROM ' . $table . ' LEFT JOIN ' . $belong_table . ' ON ' . $on . ' WHERE ' . implode(' = ? AND ', $where_arr) . ' = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($where_value_arr);
        $result = $stmt->fetchAll();
        return $result;
    }

    function select_join($table, $belong_table, array $select_field, string $on)
    {
        $sql = 'SELECT ' . implode(',', $select_field) . ' FROM ' . $table . ' LEFT JOIN ' . $belong_table . ' ON ' . $on;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function insert($table, array $field_arr, array $value_arr)
    {
        $sql_as = '';
        for ($i = 0; $i < count($field_arr); $i++) {
            if ($i == count($field_arr) - 1) {
                $sql_as .= '?';
                continue;
            }
            $sql_as .= '?,';
        }
        $sql = 'INSERT INTO ' . $table . '(' . implode(',', $field_arr) . ')' . ' VALUE (' . $sql_as . ')';
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($value_arr);
    }

    function update($table, array $field_arr, array $value_arr)
    {
        $sql = 'UPDATE ' . $table . ' SET ' . implode(' = ?,', $field_arr) . '= ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($value_arr)) {
            return true;
        }
        return false;
    }

    function update_where($table, array $field_arr, array $value_arr, string $where)
    {
        $sql = 'UPDATE ' . $table . ' SET ' . implode(' = ?,', $field_arr) . '= ? WHERE ' . $where . ' = ?';
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($value_arr)) {
            return true;
        }
        return false;
    }

    function deletebyid($table, int $id)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            return true;
        }
        return false;
    }

    function deleteby_where($table, $where, int $id)
    {
        $sql = "DELETE FROM " . $table . " WHERE {$where} = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            return true;
        }
        return false;
    }

    function search_data(string $table, array $field_arr, array $where_arr, array $where_value_arr)
    {
        $sql = 'SELECT ' . implode(', ', $field_arr) . ' FROM ' . $table . ' WHERE ' . implode('LIKE ?, ', $where_arr) . ' LIKE ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['%' . implode('', $where_value_arr) . '%']);
        $result = $stmt->fetchAll();
        return $result;
    }

    function search_dataCondetion(string $table, array $field_arr, array $where_arr, array $where_value_arr, $condetion)
    {
        $sql = 'SELECT ' . implode(', ', $field_arr) . ' FROM ' . $table . ' WHERE ' . implode('LIKE ? OR , ', $where_arr) . ' LIKE ? AND ' . $condetion;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($where_value_arr);
        $result = $stmt->fetchAll();
        return $result;
    }


    function sum_data(string $table, string $one_field, array $where_arr, array $where_value_arr)
    {
        if (!empty($where_arr)) {
            $sql = 'SELECT SUM(' . $one_field . ') as sum FROM ' . $table . ' WHERE ' . implode(' = ? AND', $where_arr) . ' = ? ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where_value_arr);
        } else {
            $sql = 'SELECT SUM(' . $one_field . ') as sum FROM ' . $table;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        $result = $stmt->fetch();
        return $result['sum'];
    }


    public function set_image($image_send)
    {
        $numrandom = (mt_rand());
        $path = "../../web/asset/image/image_web/";
        $type =  $image_send["type"];
        $type =  strrchr($type, "/");
        $type =  substr($type, 1);
        $date_img = date("YmdHis");
        $name_img =  $date_img . $numrandom . "." . $type;
        $path_link = $path . $name_img;
        move_uploaded_file($image_send['tmp_name'], $path_link);
        return $name_img;
    }




    public static function cut_phone($phone)
    {
        $count = strlen($phone);
        $number = str_split($phone);
        $arr_set = [[], [], []];
        for ($i = 0; $i < $count; $i++) {
            if ($i < 3) {
                array_push($arr_set[0], $number[$i]);
            } else   if ($i < 6) {
                array_push($arr_set[1], $number[$i]);
            } else   if ($i >= 6) {
                array_push($arr_set[2], $number[$i]);
            }
        }

        $number_text = '';
        $order_count = 0;
        foreach ($arr_set as $number_row) {
            $arr_row = $number_row;
            for ($i = 0; $i < count($arr_row); $i++) {
                $number_text .= $number_row[$i];
            }
            if ($order_count == count($arr_set) - 1) break;
            $number_text .= '-';
            $order_count++;
        }

        return   $number_text;
    }

    public static function set_date($date_recieve)
    {
        $months = [
            'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
        ];

        $dete_birth_d = date("d", strtotime($date_recieve));
        $dete_birth_m = $months[date("m", strtotime($date_recieve)) - 1];
        $dete_birth_y = date("Y", strtotime($date_recieve)) + 543;
        $dete_birth =   $dete_birth_d . " " .  $dete_birth_m . " " .  $dete_birth_y;
        return $dete_birth;
    }
}

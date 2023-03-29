<?php

class Model extends Database
{
    public $errors = array();

    function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower(get_class($this)) . "s";
        }
    }

    public function where($column, $value, $order = 'desc')
    {
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value ORDER BY id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        return $data;
    }

    public function findAll($order = 'desc')
    {
        $query = "SELECT * FROM $this->table order by id $order";
        $data = $this->query($query);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        return $data;
    }

    public function insert($data)
    {

        //remove unwanted columns
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $col) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        //run functions before insert
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);


        $query = "insert into $this->table ($columns) values (:$values)";
        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $col) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        //run functions before insert
        if (property_exists($this, 'beforeUpdate')) {
            foreach ($this->beforeUpdate as $func) {
                $data = $this->$func($data);
            }
        }

        $str = "";
        foreach ($data as $keys => $values) {
            $str .= $keys . "=:" . $keys . ",";
        }

        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where id = :id";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "delete from $this->table where id=:id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }

    public function first($column, $value, $order = 'desc')
    {
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value ORDER BY id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        if (is_array($data)) {
            $data = $data[0];
        }

        return $data;
    }
}

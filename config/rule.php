<?php
class Rule extends Validation
{
    protected array $fields;
    protected array $request;
    protected int $error_count;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate(array $validations): bool
    {
        $this->fields = $validations;
        $this->error_count = 0;
        foreach ($this->fields as $field => $validation_key) {
            $validation_keys = explode('|', $validation_key);
            foreach ($validation_keys as $validation_key) {
                if (key_exists($validation_key, $this->messages)) {
                    if ($validation_key === 'required') {
                        if (isset($this->request["$field"])) {
                            $this->required($this->request["$field"], $field, $validation_key);
                        } else {
                            $this->required("", $field, $validation_key);
                        }
                        if ($this->error_count) {
                            break;
                        }
                    } elseif ($validation_key === 'email') {
                        if (isset($this->request["$field"])) {
                            $this->email($this->request["$field"], $field, $validation_key);
                        } else {
                            $this->email("not-a-email", $field, $validation_key);
                        }
                        if ($this->error_count) {
                            break;
                        }
                    } elseif ($validation_key === 'number') {
                        if (isset($this->request["$field"])) {
                            $this->number($this->request["$field"], $field, $validation_key);
                        } else {
                            $this->number("not-a-number", $field, $validation_key);
                        }
                        if ($this->error_count) {
                            break;
                        }
                    } elseif ($validation_key === 'image') {
                        if (isset($this->request["$field"])) {
                            if (isset($this->request["$field"]['tmp_name'])) {
                                $this->image($this->request["$field"], $field, $validation_key);
                            } else {
                                $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
                                $_SESSION['error']["$field"] = $message;
                                $this->error_count++;
                            }
                        } else {
                            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
                            $_SESSION['error']["$field"] = $message;
                            $this->error_count++;
                        }
                        if ($this->error_count) {
                            break;
                        }
                    }
                } elseif (str_contains($validation_key, ":")) {
                    $keys = explode(":", $validation_key);
                    if (key_exists("$keys[0]", $this->messages)) {
                        if ($keys[0] == "max") {
                            $this->max($this->request["$field"], $field, $keys[0], (int)$keys[1]);
                        } elseif ($keys[0] == "min") {
                            $this->min($this->request["$field"], $field, $keys[0], (int)$keys[1]);
                        } elseif ($keys[0] == "in") {
                            $this->in($this->request["$field"], $field, $keys[0], $keys[1]);
                        } elseif ($keys[0] == "exists") {
                            $this->exists($this->request["$field"], $field, $keys[0], $keys[1]);
                        }
                    } else {
                        echo "Validation failed. Please try again.";
                        return false;
                    }
                } else {
                    echo "Validation failed. Please try again.";
                    return false;
                }
            }
        }
        if ($this->error_count) {
            return false;
        } else {
            return true;
        }
    }

    protected function required($value, $field, $validation_key)
    {
        if ($value == "") {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }

    protected function email($value, $field, $validation_key)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function number($value, $field, $validation_key)
    {
        if (!is_numeric($value)) {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function image($value, $field, $validation_key)
    {
        $check = getimagesize($value["tmp_name"]);
        if ($check === false) {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function max($value, $field, $validation_key, $max)
    {
        if (strlen($value) > $max) {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $message = str_replace(":value", $max, $message);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function min($value, $field, $validation_key, $min)
    {
        if (strlen($value) < $min) {
            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $message = str_replace(":value", $min, $message);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function in($value, $field, $validation_key, $values)
    {
        $values = explode(',', $values);
        if (!in_array($value, $values)) {

            $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
            $_SESSION['error']["$field"] = $message;
            $this->error_count++;
        }
    }
    protected function exists($value, $field, $validation_key, $values)
    {
        $values = explode(',', $values);
        if (count($values) === 2) {
            $table = $values[0];
            $column = $values[1];
            $database = new Database();
            $conn = $database->connect();

            $check_result = $conn->query("DESCRIBE $table");
            if ($check_result) {
                $select_query = "SELECT * FROM $table WHERE $column=?";
                $stmt = $conn->prepare($select_query);
                $stmt->bind_param("s", $value);
                $stmt->execute();
                $select_result = $stmt->get_result();
                $data = mysqli_fetch_assoc($select_result);
                if (!$data) {
                    $message = str_replace(":attr", $field, $this->messages["$validation_key"]);
                    $_SESSION['error']["$field"] = $message;
                    $this->error_count++;
                }
            } else {
                $_SESSION['error']["$field"] = "Table $table doesn't exists on database";
                $this->error_count++;
            }
            $conn->close();
        }
    }
}

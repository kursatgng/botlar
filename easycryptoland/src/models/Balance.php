<?php
class Balance {
    private $conn;
    private $table_name = "balances";

    public $id;
    public $user_id;
    public $currency;
    public $amount;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBalance($user_id, $currency) {
        $query = "SELECT amount FROM " . $this->table_name . " WHERE user_id=:user_id AND currency=:currency";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currency", $currency);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBalance($user_id, $currency, $amount) {
        $query = "UPDATE " . $this->table_name . " SET amount=:amount WHERE user_id=:user_id AND currency=:currency";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currency", $currency);
        $stmt->bindParam(":amount", $amount);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

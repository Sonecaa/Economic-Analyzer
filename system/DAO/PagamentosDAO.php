<?php


class PagamentosDAO {
    public function AllPagamentos(){
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT * FROM db_eca.tb_payments");

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    $lista = array();
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        $lista[] = $x;
                    }
                    return $lista;
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }        
    }
<<<<<<< HEAD
    public function Totaldepagamentos() {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT sum(db_value) FROM db_eca.tb_payments  ");
=======
    
     public function Totaldepagamentos() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT sum(db_value) FROM db_eca.tb_payments  ");

>>>>>>> origin/master
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    $lista = array();
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        $lista[] = $x;
                    }
                    return $lista;
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
<<<<<<< HEAD
    public function TotaldepagamentosUltimoMes() {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT sum(db_value) FROM db_eca.tb_payments ");
=======

    public function TotaldepagamentosUltimoMes() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT sum(db_value) FROM db_eca.tb_payments ");

>>>>>>> origin/master
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    $lista = array();
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        $lista[] = $x;
                    }
                    return $lista;
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
    public function MediaPagamentosDoUltimoMes() {
        global $pdo;
<<<<<<< HEAD
        try {
            $statement = $pdo->prepare("SELECT AVG(db_value) FROM db_eca.tb_payments  ");
=======

        try {

            $statement = $pdo->prepare("SELECT AVG(db_value) FROM db_eca.tb_payments  ");

>>>>>>> origin/master
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    $lista = array();
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        $lista[] = $x;
                    }
                    return $lista;
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
}

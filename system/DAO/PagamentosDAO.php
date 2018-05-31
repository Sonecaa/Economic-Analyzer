<?php
require_once("conexao.php");

class PagamentosDAO {
    public function AllPagamentos(){
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT * FROM db_eca.tb_payments;");

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
    
     public function Totaldepagamentos() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT sum(db_value) as total FROM db_eca.tb_payments  ");

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

    public function TotaldepagamentosUltimoMes() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT sum(db_value) as total FROM db_eca.tb_payments as p where p.int_month = MONTH(CURDATE());");

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

        try {

            $statement = $pdo->prepare("SELECT AVG(db_value) as total FROM db_eca.tb_payments as p where p.int_month = MONTH(CURDATE());  ");

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

    public function Relatorio6(){
        global $pdo;
// #Relatório PDF com o valor total dos pagamentos por região em ordem alfabética;
        try {

            $statement = $pdo->prepare("SELECT p.db_valuea as valor, r.str_name_region as region FROM db_eca.tb_payments as p, db_eca.tb_region as r group by  r.str_name_region order by r.str_name_regions");

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

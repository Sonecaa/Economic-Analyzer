<?php

require_once("conexao.php");

class BeneficiariosDAO {

    public function AllBeneficiariosOrdemAlfabetica() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT * FROM db_eca.tb_beneficiaries order by str_name_person ASC");

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
    
    public function AllBeneficiariosECidades() {
        global $pdo;

        try {

            $statement = $pdo->prepare("SELECT * FROM db_eca.tb_beneficiaries as x order by str_name_person ASC");

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

    public function TotalDeBeneficiarios() {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT COUNT(*) FROM db_eca.tb_beneficiaries  ");
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

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
        //Relatório PDF com a lista de todos os beneficiários e a cidade a qual pertencem, com todos os dados do beneficiário e da cidade, ordenados por cidade e posteriormente por nome do beneficiário;
            $statement = $pdo->prepare("SELECT * FROM db_eca.tb_beneficiaries as b, db_eca.tb_city as c, db_eca.tb_payments as p WHERE p.tb_beneficiaries_id_beneficiaries = b.id_beneficiaries AND p.tb_city_id_city = c.id_city");

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

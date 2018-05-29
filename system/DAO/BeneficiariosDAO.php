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

    public function Relatorio4() {
        global $pdo;
        //Relatório PDF com o número de beneficiários por cidade e o valor total pago por cidade, por mês, ordenados por valor total decrescente;
        try {

            $statement = $pdo->prepare("SELECT COUNT(b.id_beneficiaries) as numBenefi, c.str_name_city as cidade, sum(p.db_value) as total FROM db_eca.tb_beneficiaries as b, db_eca.tb_city as c, db_eca.tb_payments as p WHERE p.tb_city_id_city = c.id_city GROUP BY c.str_name_city ORDER BY p.db_value DESC; ");

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

    public function Relatorio5() {
        global $pdo;
        #Relatório PDF com a soma de vezes que o Beneficiários ganhou auxilio, os meses que foram e os valores de cada mês;
        try {

            $statement = $pdo->prepare("SELECT b.str_name_person as nome, p.db_value as valor FROM db_eca.tb_beneficiaries as b, db_eca.tb_payments as p WHERE b.id_beneficiaries = p.tb_beneficiaries_id_beneficiaries;");

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

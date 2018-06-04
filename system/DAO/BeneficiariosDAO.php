<?php

require_once(__DIR__ .'/conexao.php');

class BeneficiariosDAO {

    public function AllBeneficiariosOrdemAlfabetica() {


        try {
            $GLOBALS['pdo']->rollBack();
            $statement = $GLOBALS['pdo']->prepare("SELECT * FROM db_eca.tb_beneficiaries order by str_name_person ASC");

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

        try {
        //Relatório PDF com a lista de todos os beneficiários e a cidade a qual pertencem, com todos os dados do beneficiário e da cidade, ordenados por cidade e posteriormente por nome do beneficiário;
            $statement = $GLOBALS['pdo']->prepare("SELECT * FROM db_eca.tb_beneficiaries as b, db_eca.tb_city as c, db_eca.tb_payments as p WHERE p.tb_beneficiaries_id_beneficiaries = b.id_beneficiaries AND p.tb_city_id_city = c.id_city");

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

    try {

        $statement = $GLOBALS['pdo']->prepare("SELECT COUNT(*) as total FROM db_eca.tb_beneficiaries  ");

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

        //Relatório PDF com o número de beneficiários por cidade e o valor total pago por cidade, por mês, ordenados por valor total decrescente;
        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT COUNT(b.id_beneficiaries) as numBenefi, c.str_name_city as cidade, sum(p.db_value) as total, p.int_month as mes FROM db_eca.tb_beneficiaries as b, db_eca.tb_city as c, db_eca.tb_payments as p WHERE p.tb_city_id_city = c.id_city GROUP BY c.str_name_city ORDER BY p.db_value DESC; ");

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
        #Relatório PDF com a soma de vezes que o Beneficiários ganhou auxilio, os meses que foram e os valores de cada mês;
        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT b.str_name_person as nome, p.db_value as valor, p.int_month as mes FROM db_eca.tb_beneficiaries as b, db_eca.tb_payments as p WHERE b.id_beneficiaries = p.tb_beneficiaries_id_beneficiaries;");

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

    public function Grafico1($mes)
    {
        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT COUNT(p.tb_beneficiaries_id_beneficiaries) as total FROM db_eca.tb_payments as p WHERE int_month = ?;");
            $statement->bindParam(1, $mes);
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        return  $x;
                    }

                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }

    }

    public function Grafico2($mes)
    {

        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT p.tb_beneficiaries_id_beneficiaries as total FROM db_eca.tb_payments as p WHERE int_month = ?;");
            $statement->bindParam(1, $mes);
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    while ($x = $statement->fetch(PDO::FETCH_OBJ)) {
                        return  $x;
                    }

                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }

    }

    public function Grafico3()
    {
        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT COUNT(p.tb_beneficiaries_id_beneficiaries) as total, s.str_name as estado
FROM db_eca.tb_payments as p, db_eca.tb_state as s, db_eca.tb_city as c
WHERE p.tb_city_id_city = c.id_city AND c.tb_state_id_state = s.id_state
group by s.str_name");
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

    public function Grafico4()
    {

        try {

            $statement = $GLOBALS['pdo']->prepare("SELECT sum(p.db_value) as total, s.str_name as estado
FROM db_eca.tb_payments as p, db_eca.tb_state as s, db_eca.tb_city as c
WHERE p.tb_city_id_city = c.id_city AND c.tb_state_id_state = s.id_state
group by s.str_name");

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

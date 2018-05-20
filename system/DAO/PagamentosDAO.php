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
}

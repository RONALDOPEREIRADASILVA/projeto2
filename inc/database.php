<?php

/**
 * database.php
 *
 * Classe para interação com o banco de dados MySQL usando PDO.
 */

class database
{
    /**
     * Função para executar uma query SQL no banco de dados.
     *
     * @param string $sql A query SQL a ser executada.
     * @param array $params (opcional) Um array de parâmetros para a query preparada.
     * @return array Um array contendo o status da execução e os dados retornados (ou mensagem de erro).
     */

    public function query($sql, $params = [])
    {
        try {
            // Cria uma nova instância do PDO para conectar ao banco de dados.

            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            // Configura o PDO para lançar exceções em caso de erros.

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepara a query SQL para evitar injeção de SQL.
            $stmt = $pdo->prepare($sql);
            // Executa a query preparada com os parâmetros fornecidos.

            $stmt->execute($params);
            // Busca todos os resultados da query como objetos da classe especificada.

            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            // Retorna um array com status 'success' e os dados da query.
            return [
                'status' => 'success',
                'data' => $results
            ];
        } catch (\PDOException $err) {
            // Em caso de erro, retorna um array com status 'error' e a mensagem de erro.
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ];
        }
    }
}

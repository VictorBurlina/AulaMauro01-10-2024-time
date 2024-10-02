<?php

// Conexão
$servidor = 'localhost';
$banco = 'futebol'; 
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $pontos = $_POST['pontos'];

        echo "Recebido: <br>";
        echo "Nome do Time: " . htmlspecialchars($nome) . "<br>";
        echo "Pontos: " . htmlspecialchars($pontos) . "<br>";

        $codigoSQL = "INSERT INTO `times` (`id`, `nome`, `pontos`) VALUES (NULL, :nome, :pontos)";

        $comando = $conexao->prepare($codigoSQL);
        $resultado = $comando->execute(array(':nome' => $nome, ':pontos' => $pontos));

        if ($resultado) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados!";
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

$conexao = null;

?>

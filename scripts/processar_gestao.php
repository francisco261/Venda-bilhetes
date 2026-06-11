<?php
echo "<h1>Dados da Gestão Recebidos com Sucesso!</h1>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Aqui estão os dados enviados pelo formulário:</p>";
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
} else {
    echo "<p>Nenhum dado recebido ainda. Preencha o formulário primeiro.</p>";
}
?>

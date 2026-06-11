<?php

echo "<h2>Registo de Acessos dos Utilizadores</h2>";

try {
    $db = new SQLite3('../venda_bilhetes.db');
    
    $resultados = $db->query('SELECT username, ultimo_acesso FROM utilizadores ORDER BY ultimo_acesso DESC');
    
    echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>
            <tr>
                <th style='padding: 8px;'>Utilizador</th>
                <th style='padding: 8px;'>Último Acesso (Data/Hora)</th>
            </tr>";

    while ($row = $resultados->fetchArray(SQLITE3_ASSOC)) {
        $acesso = $row['ultimo_acesso'] ? $row['ultimo_acesso'] : 'Nunca acedeu';
        echo "<tr>
                <td style='padding: 8px;'>" . htmlspecialchars($row['username']) . "</td>
                <td style='padding: 8px;'>" . htmlspecialchars($acesso) . "</td>
              </tr>";
    }
    echo "</table>";
    
    $db->close();

} catch (Exception $e) {
    echo "<p style='color:red;'>Erro ao ler a base de dados: " . $e->getMessage() . "</p>";
}
?>

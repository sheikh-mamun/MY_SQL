<?php
$db = new mysqli('localhost', 'root', '', 'company');

// Display the logical view in a table
echo "<h1>Logical View</h1>";
echo "<table style='border-collapse: collapse; width: 50%; background-color: #bf0'>";
echo "<tr>
        <th style='border: 2px solid  #D6EEEE ; text-align: center; padding: 5px;'>ID</th>
        <th style='border: 2px solid #dddddd; text-align: center; padding: 5px;'>Name</th>
        <th style='border: 2px solid #dddddd; text-align: center; padding: 5px;'>Price</th>
     </tr>";

$product = $db->query("SELECT * FROM high_price_products"); // Corrected view name
while(list($_id,$_name,$_price) = $product->fetch_row()){
    echo "<tr> 
            <td style='border: 2px solid #dddddd; text-align: center; padding: 5px;'>$_id</td>
            <td style='border: 2px solid #dddddd; text-align: center; padding: 5px;'>$_name</td>
            <td style='border: 2px solid #dddddd; text-align: center; padding: 5px;'>$_price</td>
        </tr>";
}

echo "</table>";
?>

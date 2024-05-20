<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manufacturer and Product Management</title>
<style>
  fieldset {
    margin: 0 auto;
    width: 50%; /* Adjust the width as needed */
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    background-color: teal; /* Change this to the desired background color */
  }

	form {
    background-color: #f9f9f9; /* Change this to the desired background color */
    padding: 20px; /* Add padding for better appearance */
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
	}
  
  form table {
    width: 100%;
  }

  form table td {
    padding: 5px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 8px;
    text-align: left;
  }

  th {
		background-color: #f2f2f2;
  }
</style>
</head>
<body>

<?php 
$db = new mysqli('localhost','root','','company');

if(isset($_POST['btnSubmit'])){
	$mname = $_POST['mname'];
	$contact = $_POST['contact'];
	$db->query(" call add_manufacture('$mname','$contact') ");
}


if(isset($_POST['addProduct'])){
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$mid = $_POST['manufac'];
	$db->query(" call add_product('$pname','$price','$mid') ");
}


if(isset($_POST['delmanufact'])){
	$mid = $_POST['manufac'];
	$db->query(" delete from manufacturer where id='$mid ' ");
}


?>

<fieldset>
<fieldset>
  <h3>Manufacturer table</h3>
  <form action="#" method="post">
    <table>
      <tr>
        <td><label for="mname">Name</label></td>
        <td><input type="text" name="mname" /></td>
      </tr>
      <tr>
        <td><label for="contact">Contact</label></td>
        <td><input type="text" name="contact" /></td>
      </tr>
      <tr> 
        <td></td>
        <td><input type="submit" name="btnSubmit" value="submit" /></td>
      </tr>
    </table>
  </form>
</fieldset>

<fieldset>
  <h3>Product table</h3>
  <form action="#" method="post">
    <table>
      <tr>
        <td><label for="pname">Name</label></td>
        <td><input type="text" name="pname" /></td>
      </tr>
      <tr>
        <td><label for="price">Price</label></td>
        <td><input type="text" name="price" /></td>
      </tr>
      <tr>
        <td><label for="manufac">Manufacturer Name</label></td>
        <td>
          <select name="manufac">
            <?php 
              $manufac = $db->query("select * from manufacturer");
              while(list($_mid,$_mname) = $manufac->fetch_row()){
                  echo "<option value='$_mid'>$_mname</option>";
              }
            ?>
          </select>
        </td>
      </tr>
      <tr> 
        <td></td>
        <td><input type="submit" name="addProduct" value="submit" /></td>
      </tr>
    </table>
  </form>
</fieldset>

<fieldset>
  <form action="#" method="post">
    <table>
      <tr>
        <td><label for="manufac">Manufacturer</label></td>
        <td>
          <select name="manufac">
            <?php 
              $manufac = $db->query("select * from manufacturer");
              while(list($_mid,$_mname) = $manufac->fetch_row()){
                  echo "<option value='$_mid'>$_mname</option>";
              }
            ?>
          </select>
        </td>
      </tr>
      <tr> 
        <td></td>
        <td><input type="submit" name="delmanufact" value="delete" /></td>
      </tr>
    </table>
  </form>
</fieldset>

<fieldset>
  <h3>View Product</h3>

  <table border="1" style="border-collapse: collapse;" > 
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Manufacturer</th>
      <th>Contact</th>
    </tr>
    <?php 
      $product = $db->query(" select * from view_product ");
      while(list($_id,$_name,$_price,$_mname,$_mcont) = $product->fetch_row()){
          echo "<tr> 
                  <td>$_id</td>
                  <td>$_name</td>
                  <td>$_price</td>
                  <td>$_mname</td>
                  <td>$_mcont</td>
              </tr>";
      }
    
    ?>
  </table>
</fieldset>

</body>
</html>

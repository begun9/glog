
   <fieldset>
   <legend>Последние новости в группах</legend>
    <?php
   News::select_v();
      echo "<table>";
      $sliced = array_slice(News::$resultF, 1);
foreach($sliced as $key => $value) { 
    echo "<tr><td>";     
            
    echo "<a href='?group=".$value['id_group']."'>".$value['name_group']."</a></td><td>".$value['date']."</td>
    <td>".$value['login']."</td><td>".$value['header']."</td></tr>";
}
echo "</table>";
?>
</fieldset>
    
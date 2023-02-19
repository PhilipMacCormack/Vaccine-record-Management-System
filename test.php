<html>
    <form>
      <input type = "checkbox" value = "1" name = "checkbox[]">
      <input type = "checkbox" value = "2" name = "checkbox[]">
      <input type = "checkbox" value = "3" name = "checkbox[]">
      <input type = "submit">
    </form>
    <script>
      var s = document.getElementsByName('checkbox')[0];
      var text = text = s.options[s.selectedIndex].text;
    </script>
<?php
    ?>
    </html>
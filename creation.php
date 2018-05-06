<script src="./tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript"> tinymce.init({selector: '#mytextarea', menubar: false}) </script>

<form method="post" action="creation.php">
  <textarea id="mytextarea" name="text">Hello, World!</textarea>
  <input type="submit" value="Enregistrer">
</form>

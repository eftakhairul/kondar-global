  </div>
  
  <?php foreach($js_element as $js) :?>
  <script src="<?=$js?>?<?=time()?>"></script>
  <?php endforeach; ?>
  
  
  <script>
    <?php foreach($js_functions as $js_fn) :?>
        <?=$js_fn?>;
    <?php endforeach; ?>
  </script>
</body>
</html>
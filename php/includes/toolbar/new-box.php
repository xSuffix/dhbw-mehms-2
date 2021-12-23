<?php $new = isset($_GET["new"]) ? $_GET["new"] : false; ?>

<label for="new" class="<?php echo $new ? 'active' : 'inactive' ?>">
  <svg xmlns="http://www.w3.org/2000/svg" class="box active" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" class="box inactive" viewBox="0 0 20 20" fill="currentColor">
    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
  </svg>
</label>
<input type="checkbox" id="new" name="new" <?php echo ' value="' . ($new ? 'true" checked' : 'false"'); ?> onchange="document.getElementById('query').submit()">
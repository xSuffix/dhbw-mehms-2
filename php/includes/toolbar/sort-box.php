<?php $sortOptions = array(
  array("value" => "date", "name" => "Datum"),
  array("value" => "likes", "name" => "Likes"),
  array("value" => "comments", "name" => "Kommentare")
);
$sort = $_GET["sort"] ?? "date";

?>

<select name="sort" id="sort" class="box" onchange="document.getElementById('query').submit()">
  <?php for ($i = 0; $i < count($sortOptions); $i++) {
    echo '<option value="' . $sortOptions[$i]["value"] . '" ' . ($sortOptions[$i]["value"] == $sort ? 'selected ' : '') . '>' . $sortOptions[$i]["name"] . '</option>';
  } ?>
</select>
<?php $filterOptions = array(
    array("value" => "", "name" => "Alle"),
    array("value" => "Programmieren", "name" => "Programmieren"),
    array("value" => "DHBW", "name" => "DHBW"),
    array("value" => "Andere", "name" => "Andere")
);
$category = $_GET["filter"] ?? "";

?>

<label for="filter"></label><select name="filter" id="filter" class="box" onchange="document.getElementById('query').submit()">
    <?php for ($i = 0; $i < count($filterOptions); $i++) {
        echo '<option value="' . $filterOptions[$i]["value"] . '" ' . ($filterOptions[$i]["value"] == $category ? 'selected ' : '') . '>' . $filterOptions[$i]["name"] . '</option>';
    } ?>
</select>
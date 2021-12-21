<?php $filterOptions = array(
    array("value" => "name", "name" => "Name"),
    array("value" => "user", "name" => "User")
);
$filter = $_GET["filter"] ?? "name";

?>

<label for="filter"></label><select name="filter" id="filter" class="box" onchange="document.getElementById('query').submit()">
    <?php for ($i = 0; $i < count($filterOptions); $i++) {
        echo '<option value="' . $filterOptions[$i]["value"] . '" ' . ($filterOptions[$i]["value"] == $filter ? 'selected ' : '') . '>' . $filterOptions[$i]["name"] . '</option>';
    } ?>
</select>
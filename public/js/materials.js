$(document).ready(function () {
    var materialsTable = $("#materials-table-container");
    var addMaterialButton = $("#add-material");

    addMaterialButton.click(function () {
        // $.get("/get-material-row", function (data) {
        //     materialsTable.append(data);
        // });
    });

    materialsTable.on("click", ".remove-material", function () {
        $(this).closest("tr").remove();
    });
});

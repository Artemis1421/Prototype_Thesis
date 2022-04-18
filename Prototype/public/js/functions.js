 function openAdd() {
    document.getElementById("addForm").style.display = "block";
    }

    function closeAdd() {
    document.getElementById("addForm").style.display = "none";
    }

    function openAddQuantity() {
    document.getElementById("addQuantityForm").style.display = "block";
    }

    function closeAddQuantity() {
    document.getElementById("addQuantityForm").style.display = "none";
    }

    function openEdit() {
    document.getElementById("editForm").style.display = "block";
    }

    function closeEdit() {
    document.getElementById("editForm").style.display = "none";
    }

    function openDelete() {
    document.getElementById("deleteForm").style.display = "block";
    }

    function closeDelete() {
    document.getElementById("deleteForm").style.display = "none";
    }

    $(document).ready(function(){
    $("#search_input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#products_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


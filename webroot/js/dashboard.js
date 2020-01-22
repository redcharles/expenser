$(document).ready(function() {
    var expenseTable = $('.addExpenseTable');
    var show = $(".show");
    expenseTable.hide();
    show.show();
    $("#addExpense").submit(function(e) {
        e.preventDefault();
        // Post Changes
        var formData = $(this).serialize();
        var ajaxUrl = $(this).attr("action");
        $.post(ajaxUrl, formData, function(response) {
            if (response.success === false) {
                alert("An error has occured.");
            }
        }).fail(function(xhr, status, error) {
            // console.log("Status: ".status);
            // console.log("Error: ".error);
        });

        // Update Front End
        var results = {};
        $.each($(this).serializeArray(), function() {
            results[this.name] = this.value;
        })
        delete results._csrfToken;
        delete results._method;
        expenseTable.show();
        var tbody = $('.addExpenseTable > tbody');
        var tRow = $('.addExpenseTable > tbody');
        rowToAppend = "<tr>";
        $.each(results, function(k, v) {
                rowToAppend += "<td>" + v + "</td>";
            })
            // rowToAppend += "<td class='deleteRow'>X</td>";
        rowToAppend += "</tr>";
        tbody.prepend(rowToAppend);
        this.reset();
    })
});
$(document.body).on('click', '.deleteRow', function() {
    var tr = $(this).closest("tr");
    tr.remove();
})
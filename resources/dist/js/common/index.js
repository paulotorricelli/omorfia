/* 

DATATABLES 

*/
$(function () {
    $(".table-management").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
    });
});
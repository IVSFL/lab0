jQuery(document).ready(function($) {
    $('#searchButton').on('click', function () {
        performSearch();
    });
    
    function performSearch() {
        const formData = $('#searchForm').seralize();
    
        $.ajax
    }
});

$(document).ready(() => {
    let action = "";
    let search_txt = $("#Input__search").val();
    $.ajax ({
        type: 'POST',
        url: '../config/ajax_type_cpt.php',
        data: {search: 'search',action:action,search_txt:search_txt},
        success:  (Response) => {
            alert(Response);
            $("tbody").html(Response);                    
        }
    })
    $('#Input__search').keyup(() => {
        let search = $(this).text();               
        Return_data();
    })

    alert()
})

// ce code n'est pas utilise dans mon programme j'essayais de faire des calls ajax (sans succes)
// je me suis fie a un exemple trouve sur internet 
$("form").on("submit", function (event) {
    
    event.preventDefault();
    var values = $(this).serialize();

    $.ajax({
        url: "ExercicesPHP.php",
        type: "post",
        async: true,
        data: values,
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (json) {
            $('#result').html((json.content) ? (json.content) : '???');
            $('#result').prop('title', json.title);
            $('#jsonstring').html('Json object: ' + JSON.stringify(json));
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

});
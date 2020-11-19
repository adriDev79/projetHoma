    afficherTotaux();

$('#btnChevronTotaux').click(function () {
    clickChevron($(this), $('#gestionTotaux'),'class', 'fas fa-chevron-down', 'fas fa-chevron-up');
});

function afficherTotaux() {
    var soldeActuel = isNaN(parseFloat($('#inputSoldeActuel').val())) ? 0 : parseFloat($('#inputSoldeActuel').val());
    const url = 'afficherTotaux';
    try {
        $.ajax({
            url : url,
            type : 'GET',
            success: function (response) {
                var solde = parseFloat(response.solde) + soldeActuel;
                $('#totalRevenu').append('<p class="pTotaux">' + response.totalRevenu + ' €</\p>');
                $('#totalDepenseFixe').append('<p class="pTotaux">' + response.totalDepenseFixe + ' €</\p>');
                $('#totalDepenseAnnexe').append('<p class="pTotaux">' + Math.round((response.totalDepenseAnnexe)*100)/100 + ' €</\p>');
                $('#totalDepense').append('<p class="pTotaux">' + Math.round((response.totalDepense)*100)/100 + ' €</\p>');
                $('#solde').append('<p id="soldeTT" class="pTotaux">' + Math.round(solde * 100)/100 + ' €</\p>');
            },
            error : function () {
                message($('#messageMainTotaux'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            }
        });
    } catch (e) {
        message($('#messageMainTotaux'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
        console.log(e.toString());
    }
}

$('#inputSoldeActuel').change(function () {
    const url = 'afficherTotaux';
    var soldeActuel = isNaN(parseFloat($('#inputSoldeActuel').val())) ? 0 : parseFloat($('#inputSoldeActuel').val());
    var solde;

    try {
        $.ajax({
            url : url,
            type : 'GET',
            success: function (response) {
                solde = parseFloat(response.solde);
                var nouveauSolde = Math.round((solde + soldeActuel)*100)/100;
                $('#soldeTT').text(nouveauSolde.toFixed(2) + ' €');
            },
            error : function () {
                message($('#messageMainTotaux'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            }
        });
    } catch (e) {
        message($('#messageMainTotaux'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
        console.log(e.toString());
    }
});

function suppTotaux() {
    $('.pTotaux').each(function () {
        $(this).remove();
    })
}
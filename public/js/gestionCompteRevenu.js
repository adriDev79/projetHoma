afficherRevenu();

$('#btnChevronReveunu').click(function () {
    clickChevron($(this), $('#gestionRevenu'),'class', 'fas fa-chevron-down', 'fas fa-chevron-up');
});

$('#btnAjouterRevenu').click(function () {
    clickDivAjouter($(this), $('#ajouterRevenu'), 'class', 'color', 'fas fa-minus-square fa-lg', 'fas fa-plus-square fa-lg', '#1E8449', '#CC0000');
});

function masquerIconsModification(id) {
    $('#divIconSupp-' + id).css('display', 'block');
    $('#divIconsModif-' +id).css('display', 'none');
}

function afficherIconsModification(id){
    $('#divIconSupp-' + id).css('display', 'none');
    $('#divIconsModif-' +id).css('display', 'block');
}

// Ajouter un revenu
$('#btnValiderAjoutRevenu').click(function (event) {
    event.preventDefault();
    const url = 'ajouterRevenu';

    var libelle = $('#libelle').val();
    var montant = $('#montant').val();

    if (libelle !== '' && montant !== '') {
        if (libelle.length <= 30) {
            console.log(libelle.length);
            try {
                $.ajax({
                    url : url ,
                    type : 'POST',
                    data : 'libelle=' + libelle + '&montant=' + montant,
                    success : function () {
                        supprimerLignes($('.rev'));
                        afficherRevenu();
                        suppTotaux();
                        afficherTotaux();
                        message($('#messageMainRevenu'),'color', '#507f66', REVENU_AJOUTER);
                        $('#btnAjouterRevenu').attr('class', 'fas fa-plus-circle').css('color', '#1E8449');
                        $('#ajouterRevenu').css('display', 'none');
                    },
                    error : function () {
                        message($('#messageMainRevenu'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                    }
                });
            } catch (e) {
                message($('#messageMainRevenu'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainRevenu'),'color', '#E74C3C', CARACTERE_MAX);
            $('#libelle').css('border' , '2px solid red');
        }
    } else {
        message($('#messageMainRevenu'),'color', '#E74C3C', CHAMP_VIDE);
    }
});

function afficherRevenu() {
    const url = 'afficherRevenu';
    try {
        $.ajax({
            url : url,
            type : 'GET',
            success: function (response) {
                for (var i = 0; i < response.length; i++){
                    var id = response[i].id;
                    var libelle = response[i].libelleRevenu;
                    var montant = response[i].montantRevenu;
                    $('#affichageRevenu').append(
                        '<div id="rev-'+id+'" class="rev">' +
                            '<input type="text" id="pLibelleRevenu-' + id + '" class="pLibelleRevenu" value="' + libelle + '" onclick="afficherIconsModification(' + id + ')">' +
                            '<input type="number" id="pMontantRevenu-' + id + '" class="pMontantRevenu" value="' + montant + '" onclick="afficherIconsModification(' + id + ')">' +
                            '<p class="euro">€</p>' +
                            '<div class="divBtnOption">' +
                                '<div class="divIconSupp" id="divIconSupp-' + id + '">' +
                                    '<span title="Supprimer le revenu"><i id="iconSupprimerRevenu-' + id + '" class="iconSupprimerRevenu fas fa-minus-square fa-lg" onclick="suprimerRevenu(' + id + ')"></i></span>' +
                                '</div>' +
                                '<div class="divIconsModif" id="divIconsModif-' + id + '">' +
                                    '<span title="Valider la modification"><i id="iconValidModifierRevenu-' + id + '" class="iconValidModifierRevenu fas fa-check-square fa-lg" onclick="modifierRevenu(' + id + ')"></i></span>' +
                                    '<span title="Annuler la modification"><i id="iconAnnulerModifRevenu-' + id + '" class="iconAnnulerModifRevenu fas fa-minus-square fa-lg" onclick="masquerIconsModification(' + id + ')"></i></span>' +
                                '</div>' +
                            '</div>' +
                        '</div>');
                }
            }
        });
    } catch (e) {
        message($('#messageMainRevenu'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
        console.log(e.toString());
    }
}

function suprimerRevenu(id){
    const url = 'supprimerRevenu';
    if (id !== '') {
        try {
            $.ajax({
                url : url,
                type : 'DELETE',
                data : 'id=' + id,
                dataType : "text",
                success : function () {
                    suppTotaux();
                    afficherTotaux();
                    $('#rev-' + id).remove();
                    message($('#messageMainRevenu'),'color', '#507f66', REVENU_SUPPRIMER);
                }
            });
        } catch (e) {
            message($('#messageMainRevenu'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            console.log(e.toString());
        }
    } else {
        message($('#messageMainRevenu'),'color', '#E74C3C', SUPRESSION_IMPOSSIBLE);
    }
}

function modifierRevenu(id){
    var libelleRevenu = $('#pLibelleRevenu-' + id).val();
    var montantRevenu = $('#pMontantRevenu-' + id).val();

    var element = document.getElementById('messageMain');
    const url = 'modifierRevenu';
    if (libelleRevenu !== '' && montantRevenu !== '') {
        if (libelleRevenu.length <= 30) {
            try {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: 'libelle=' + libelleRevenu + '&montant=' + montantRevenu + '&id=' + id,
                    success : function () {
                        supprimerLignes($('.rev'));
                        afficherRevenu();
                        suppTotaux();
                        afficherTotaux();
                        message($('#messageMainRevenu'),'color', '#507f66', REVENU_MODIFIER);
                    }
                });
            } catch (e) {
                message($('#messageMainRevenu'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainRevenu'),'color', '#E74C3C', CARACTERE_MAX);
            $('#pLibelleRevenu-' + id).css('border' , '2px solid red');
        }
    } else {
        message($('#messageMainRevenu'),'color', '#E74C3C', CHAMP_VIDE);
    }
}
afficherDepenseAnnexe();

$('#btnChevronDepenseA').click(function () {
    clickChevron($(this), $('#gestionDepensesAnnexe'),'class', 'fas fa-chevron-down', 'fas fa-chevron-up');
});

$('#btnAjouterDepenseAnnexe').click(function () {
    clickDivAjouter($(this), $('#ajouterDepenseAnnexe'), 'class', 'color', 'fas fa-minus-square fa-lg', 'fas fa-plus-square fa-lg', '#1E8449', '#CC0000');
});

function annulerModifDepenseAnnexe(id){
    $('#divIconSuppDA-' + id).css('display', 'block');
    $('#divIconsModifDA-' +id).css('display', 'none');
}

function afficherIconModificationDA(id){
    $('#divIconSuppDA-' + id).css('display', 'none');
    $('#divIconsModifDA-' +id).css('display', 'block');
}

// Ajouter une deépense annexe
$('#btnValiderAjoutDepenseAnnexe').click(function (event) {
    event.preventDefault();
    const url = 'ajouterDepenseAnnexe';

    var libelleAnnexe = $('#libelleDepenseAnnexe').val();
    var montantAnnexe = $('#montantDepenseAnnexe').val();
    var id  = parseInt($('#selectTypeDepenseAnnexe').val()?.split(' '));

    if (libelleAnnexe !== '' && montantAnnexe !== '' && !isNaN(id)) {
        if (libelleAnnexe.length <= 30) {
            try {
                $.ajax({
                    url : url ,
                    type : 'POST',
                    data : 'libelle=' + libelleAnnexe + '&montant=' + montantAnnexe + '&id=' + id,
                    success: function () {
                        supprimerLignes($('.depA'));
                        afficherDepenseAnnexe();
                        suppTotaux();
                        afficherTotaux();

                        $('#btnAjouterDepenseAnnexe').attr('class', 'fas fa-plus-circle').css('color', '#1E8449');
                        $('#ajouterDepenseAnnexe').css('display', 'none');

                        message($('#messageMainDepenseAnnexe'),'color', '#507f66', DEPENSE_ANNEXE_AJOUTER);
                    },
                    error : function () {
                        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                    }
                });
            } catch (e) {
                message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', CARACTERE_MAX);
            $('#libelle').css('border' , '2px solid red')

        }
    } else {
        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', CHAMP_VIDE);
    }
});

function modifierDepenseAnnexe(id){
    const url = 'modifierDepenseAnnexe';

    var idType = parseInt($('#selectAnnexe-' + id).val());
    var libelleDepenseAnnexe = $('#pLibelleDepenseAnnexe-' + id).val();
    var montantDepenseAnnexe = $('#pMontantDepenseAnnexe-' + id).val();

    if (libelleDepenseAnnexe !== '' && montantDepenseAnnexe !== '' && !isNaN(idType)) {
        if (libelleDepenseAnnexe.length <= 30) {
            try {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: 'libelle=' + libelleDepenseAnnexe + '&montant=' + montantDepenseAnnexe + '&id=' + id + '&idType=' + idType,
                    success : function () {
                        supprimerLignes($('.depA'));
                        afficherDepenseAnnexe();
                        suppTotaux();
                        afficherTotaux();

                        message($('#messageMainDepenseAnnexe'),'color', '#507f66', DEPENSE_ANNEXE_MODIFIER);
                    },
                    error : function () {
                        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                    }
                });
            } catch (e) {
                message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', CARACTERE_MAX);
            $('#libelle').css('border' , '2px solid red');
        }
    } else {
        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', CHAMP_VIDE);
    }
}

function suprimerDepenseAnnexe(id){
    var idType = parseInt(id);
    const url = 'supprimerDepenseAnnexe';

    if (!isNaN(id)) {
        try {
            $.ajax({
                url : url,
                type : 'DELETE',
                data : 'id=' + id,
                success : function () {
                    $('#depA-' + id).remove();
                    suppTotaux();
                    afficherTotaux();
                    message($('#messageMainDepenseAnnexe'),'color', '#507f66', DEPENSE_ANNEXE_SUPPRIMER);
                },
                error : function () {
                    message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                }
            });
        } catch (e) {
            message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            console.log(e.toString());
        }
    } else {
        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', SUPRESSION_IMPOSSIBLE);
    }
}

function afficherDepenseAnnexe() {
    const url = 'afficherDepenseAnnexe';

    try {
        $.ajax({
            url : url,
            type : 'GET',
            success: function (response) {
                for (var i = 0; i < response[0].length; i++){
                    var id = response[0][i].id;
                    var libelleType = response[0][i].typeDepense.libelleTypeDepense;
                    var idTypeDepenseAnnexe = response[0][i].typeDepense.id;
                    var libelle = response[0][i].libelleDepenseAnnexe;
                    var montant = response[0][i].montantDepenseAnnexe;

                    $('#affichageDepenseAnnexe').append(
                        '<div id="depA-'+id+'" class="depA">' +
                            '<label for="selectModifTypeAnnexe"></label>' +
                            '<select id="selectAnnexe-' + id + '" class="selectTypeAnnexe" onclick="afficherIconModificationDA(' + id + ')">' +
                                '<option value="'+ idTypeDepenseAnnexe + '">' + libelleType + '</option>' +
                            '</select>' +
                            '<input type="text" id="pLibelleDepenseAnnexe-' + id + '" class="pLibelleDepenseAnnexe" value="' + libelle + '" onclick="afficherIconModificationDA(' + id + ')">' +
                            '<input type="number" id="pMontantDepenseAnnexe-' + id + '" class="pMontantDepenseAnnexe" value="' + montant + '" onclick="afficherIconModificationDA(' + id + ')">' +
                            '<p class="euro">€</p>' +
                            '<div class="divBtnOption">' +
                                '<div class="divIconSuppDA" id="divIconSuppDA-' + id + '">' +
                                    '<span title="Supprimer la dépense"><i class="iconSupprimerDepenseAnnexe fas fa-minus-square fa-lg" onclick="suprimerDepenseAnnexe(' + id + ')"></i></span>' +
                                '</div>' +
                                '<div class="divIconsModifDA" id="divIconsModifDA-' + id + '">' +
                                    '<span title="Valider la modification"><i class="iconValidModifierDepenseAnnexe fas fa-check-square fa-lg" onclick="modifierDepenseAnnexe(' + id + ')"></i></span>' +
                                    '<span title="Annuler la modification"><i class="iconAnnulerModifDepenseAnnexe fas fa-minus-square fa-lg" onclick="annulerModifDepenseAnnexe(' + id + ')"></i></span>' +
                                '</div>' +
                            '</div>' +
                        '</div>');

                    for (let j = 0; j < response[1].length; j++){
                        $('#selectAnnexe-' + id).append(
                            '<option>' + response[1][j].id + ' ' + response[1][j].libelleTypeDepense + '</option>'
                        )
                    }
                }
            },
            error : function () {
                message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            }
        });
    } catch (e) {
        message($('#messageMainDepenseAnnexe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
        console.log(e.toString());
    }
}
afficherDepenseFixe();

$('#btnChevronDepenseF').click(function () {
    clickChevron($(this), $('#gestionDepensesFixe'),'class', 'fas fa-chevron-down', 'fas fa-chevron-up');
});

$('#btnAjouterDepenseFixe').click(function () {
    clickDivAjouter($(this), $('#ajouterDepenseFixe'), 'class', 'color', 'fas fa-minus-square fa-lg', 'fas fa-plus-square fa-lg', '#1E8449', '#CC0000');
});

function annulerModifDepenseFixe(id){
    $('#divIconSuppDF-' + id).css('display', 'block');
    $('#divIconsModifDF-' +id).css('display', 'none');
}

function afficherIconModificationDF(id){
    $('#divIconSuppDF-' + id).css('display', 'none');
    $('#divIconsModifDF-' +id).css('display', 'block');
}

// Ajouter une deépense fixe
$('#btnValiderAjoutDepenseFixe').click(function (event) {
    event.preventDefault();

    const url = 'ajouterDepenseFixe';
    var libelle = $('#libelleDepenseFixe').val();
    var montant = $('#montantDepenseFixe').val();
    var id  = parseInt($('#selectTypeDepense').val()?.split(' '));

    if (libelle !== '' && montant !== '' && !isNaN(id)) {
        if (libelle.length <= 30) {
            try {
                $.ajax({
                    url : url ,
                    type : 'POST',
                    data : 'libelle=' + libelle + '&montant=' + montant + '&id=' + id,
                    dataType : "text",
                    success : function () {
                        supprimerLignes($('.depF'));
                        afficherDepenseFixe();
                        suppTotaux();
                        afficherTotaux();

                        $('#btnAjouterDepenseFixe').attr('class', 'fas fa-plus-circle').css('color', '#1E8449');
                        $('#ajouterDepenseFixe').css('display', 'none');
                        message($('#messageMainDepenseFixe'),'color', '#507f66', DEPENSE_FIXE_AJOUTER);
                    },
                    error : function () {
                        message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                    }
                });
            } catch (e) {
                message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainDepenseFixe'),'color', '#E74C3C', CARACTERE_MAX);
            $('#libelle').css('border' , '2px solid red');
        }
    } else {
        message($('#messageMainDepenseFixe'),'color', '#E74C3C', CHAMP_VIDE);
    }
});

function modifierDepenseFixe(id){
    var idType = parseInt($('#select-' + id).val());
    var libelleDepenseFixe = $('#pLibelleDepenseFixe-' + id).val();
    var montantDepenseFixe = $('#pMontantDepenseFixe-' + id).val();
    const url = 'modifierDepenseFixe';

    if (libelleDepenseFixe !== '' && montantDepenseFixe !== '' && !isNaN(idType)) {
        if (libelleDepenseFixe.length <= 30) {
            try {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: 'libelle=' + libelleDepenseFixe + '&montant=' + montantDepenseFixe + '&id=' + id + '&idType=' + idType,
                    success : function () {
                        supprimerLignes($('.depF'));
                        afficherDepenseFixe();
                        suppTotaux();
                        afficherTotaux();

                        message($('#messageMainDepenseFixe'),'color', '#507f66', DEPENSE_FIXE_MODIFIER);
                    },
                    error : function () {
                        message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                    }
                });
            } catch (e) {
                message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                console.log(e.toString());
            }
        } else {
            message($('#messageMainDepenseFixe'),'color', '#E74C3C', CARACTERE_MAX);
            $('#libelle').css('border' , '2px solid red');
        }
    } else {
        message($('#messageMainDepenseFixe'),'color', '#E74C3C', CHAMP_VIDE);
    }
}

function suprimerDepenseFixe(id){
    var idDepenseFixe = parseInt(id);
    const url = 'supprimerDepenseFixe';

    if (!isNaN(idDepenseFixe)) {
        try {
            $.ajax({
                url : url,
                type : 'DELETE',
                data : 'id=' + idDepenseFixe,
                dataType : "text",
                success : function () {
                    $('#depF-' + id).remove();
                    suppTotaux();
                    afficherTotaux();
                    message($('#messageMainDepenseFixe'),'color', '#507f66', DEPENSE_FIXE_SUPPRIMER);
                },
                error : function () {
                    message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
                }
            });
        } catch (e) {
            message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            console.log(e.toString());
        }
    } else {
        message($('#messageMainDepenseFixe'),'color', '#E74C3C', SUPRESSION_IMPOSSIBLE);
    }
}

function afficherDepenseFixe() {
    const url = 'afficherDepenseFixe';

    try {
        $.ajax({
            url : url,
            type : 'GET',
            success: function (response) {
                for (var i = 0; i < response[0].length; i++){
                    var id = response[0][i].id;
                    var libelleType = response[0][i].typeDepense.libelleTypeDepense;
                    var idTypeDepenseFixe = response[0][i].typeDepense.id;
                    var libelle = response[0][i].libelleDepenseFixe;
                    var montant = response[0][i].montantDepenseFixe;

                    $('#affichageDepenseFixe').append(
                        '<div id="depF-'+id+'" class="depF">' +
                        '<label for="selectModifType"></label>' +
                        '<select id="select-' + id + '" class="selectType" onclick="afficherIconModificationDF(' + id + ')">' +
                        '<option value="' + idTypeDepenseFixe + '">' + libelleType + '</option>' +
                        '</select>' +
                        '<input type="text" id="pLibelleDepenseFixe-' + id + '" class="pLibelleDepenseFixe" value="' + libelle + '" onclick="afficherIconModificationDF(' + id + ')">' +
                        '<input type="number" id="pMontantDepenseFixe-' + id + '" class="pMontantDepenseFixe" value="' + montant + '" onclick="afficherIconModificationDF(' + id + ')">' +
                        '<p class="euro">€</p>' +
                        '<div class="divBtnOption">' +
                        '<div class="divIconSuppDF" id="divIconSuppDF-' + id + '">' +
                        '<span title="Supprimer la dépense"><i class="iconSupprimerDepenseFixe fas fa-minus-square fa-lg" onclick="suprimerDepenseFixe(' + id + ')" ></i></span>' +
                        '</div>' +
                        '<div class="divIconsModifDF" id="divIconsModifDF-' + id + '">' +
                        '<span title="Valider la modification"><i class="iconValidModifierDepenseFixe fas fa-check-square fa-lg" onclick="modifierDepenseFixe(' + id + ')"></i></span>' +
                        '<span title="Annuler la modification"><i class="iconAnnulerModifDepenseFixe fas fa-minus-square fa-lg" onclick="annulerModifDepenseFixe(' + id + ')"></i></span>' +
                        '</div>' +
                        '</div>');

                    for (let j = 0; j < response[1].length; j++){
                        $('#select-' + id).append(
                            '<option>' + response[1][j].id + ' ' + response[1][j].libelleTypeDepense + '</option>'
                        )
                    }
                }
            },
            error : function () {
                message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
            }
        });
    } catch (e) {
        message($('#messageMainDepenseFixe'),'color', '#E74C3C', ACTION_IMPOSSIBLE);
        console.log(e.toString());
    }
}
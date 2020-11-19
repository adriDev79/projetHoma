const CARACTERE_MAX = '30 caractères maximum !';
const CHAMP_VIDE = 'Merci de renseigné tout les champs !';
const ACTION_IMPOSSIBLE = 'impossible d\'éffectuer cette action !';
const SUPRESSION_IMPOSSIBLE = 'Supression impossible !';

// Gestion revenu
const REVENU_MODIFIER = 'Revenu modifié !';
const REVENU_SUPPRIMER = 'Revenu supprimé !';
const REVENU_AJOUTER = 'Revenu ajouté !';

// Gestion dépense fixe
const DEPENSE_FIXE_AJOUTER = 'Dépense Fixe ajouté !';
const DEPENSE_FIXE_MODIFIER = 'Dépense fixe modifié !';
const DEPENSE_FIXE_SUPPRIMER = 'Dépense fixe supprimé !';

// Gestion dépense annexe
const DEPENSE_ANNEXE_AJOUTER = 'Dépense annexe ajouté !';
const DEPENSE_ANNEXE_MODIFIER = 'Dépense annexe modifié !';
const DEPENSE_ANNEXE_SUPPRIMER = 'Dépense annexe supprimé !';

/**
 * function qui permet d'afficher un message
 *
 * @param element, element ou sera afficher le message
 * @param cssAttr, attribut css à mdifier
 * @param valueCss, valeur css
 * @param text, texte du message
 */
function message(element, cssAttr, valueCss, text) {
    $(element).css(cssAttr, valueCss)
        .text(text).fadeIn(2000, function () {
        $(this).fadeOut(6000);
    });
}

/**
 * finction qui permet de supprimer les lignes
 *
 * @param element
 */
function supprimerLignes(element) {
    $(element).each(function () {
        $(this).remove();
    });
}

/**
 * fonction qui fait apparaitre les div revenu,  depense fixe, depense annexe et totaux
 * 
 * @param clickElement
 * @param actionElement
 * @param cssAttr
 * @param valueCss
 * @param valueCss2
 */
function clickChevron(clickElement, actionElement, cssAttr , valueCss , valueCss2) {
        $(actionElement).slideToggle(500);
        if ($(clickElement).attr(cssAttr) === valueCss) {
            $(clickElement).attr(cssAttr, valueCss2);
        } else {
            $(clickElement).attr(cssAttr, valueCss);
        }
}

/**
 * fonction qui fait apparaitre les div pour ajouté du contenu
 *
 * @param clickElement
 * @param actionElement
 * @param cssAttr
 * @param cssAttr2
 * @param valueCss
 * @param valueCss2
 * @param valueCssColor
 * @param valueCssColor2
 */
function clickDivAjouter(clickElement, actionElement, cssAttr, cssAttr2 , valueCss , valueCss2, valueCssColor, valueCssColor2) {
    $(actionElement).slideToggle(500);
    if ($(clickElement).attr(cssAttr) === valueCss) {
        $(clickElement).attr(cssAttr, valueCss2).css(cssAttr2, valueCssColor);
    } else {
        $(clickElement).attr(cssAttr, valueCss).css(cssAttr2, valueCssColor2);
    }
}


/**
 * @param string modelName nombre del modelo
 * @param string formName nombre del modelo Ej: Customer, Post, etc
 * @param string fieldPrefix nombre del campo a llenar (populate)
 * @param integer integerValue es un random value generado desde el PHP para cada elemento
 */
function populateCampos(modelName, formName, fieldPrefix, integerValue) {
    var seleccionado = $('#Form'+modelName+'Id-'+integerValue+'  option:selected');
    var inputName = "data["+formName+"]["+fieldPrefix;
    
    if (seleccionado.val()){
        var Coso =  jQuery.parseJSON(seleccionado.attr('json'));
        for (property in Coso) {
            inputName = "data["+formName+"]["+fieldPrefix+"_"+property+"]";
            var elementoFormInput = $('[name="'+inputName+'"]');
            if (elementoFormInput.length > 0) {
                elementoFormInput.val(Coso[property]);
            } else {
                var elementoElement = $("#"+fieldPrefix+"_"+property);
                if(elementoElement.length > 0) {
                    elementoElement.val(Coso[property]);
                }
            }

        }
    } else {
        $('input[name^="'+inputName+'"]').val('');
        $('select[name^="'+inputName+'"]').val('');
    }
}

    


        
// PageLoad function
// This function is called when:
// 1. after calling $.historyInit();
// 2. after calling $.historyLoad();
// 3. after pushing "Go Back" button of a browser
function pageload(hash) {
    // hash doesn't contain the first # character.
    if(hash) {
        // restore ajax loaded state
        $("#div-for-vehicles").load(hash);
    } else {
        if (typeof(primeraVez) == 'undefined'){
            contenidoInicial = $("#div-for-vehicles").html();
        }
        primeraVez = 'definida';
        $("#div-for-vehicles").empty();
        //$("#div-for-vehicles").append(contenidoInicial);
        $("#div-for-vehicles").html(contenidoInicial);
    }
}

$(document).ready(function(){
    // Initialize history plugin.
    // The callback is called at once by present location.hash.
    $.history.init(pageload);

    // set onlick event for buttons
    $("a[rel='history']").click(function(){
        //
        var hash = this.href;
        hash = hash.replace(/^.*#/, '');
        // moves to a new page.
        // pageload is called at once.
        $.history.load(hash);
        return false;
    });
});

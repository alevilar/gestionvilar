/**
 * @param string formName nombre del modelo Ej: Customer, Post, etc
 * @param string fieldPrefix nombre del campo a llenar (populate)
 * @param integer andom value generado desde el PHP para cada elemento
 */
function populateCampos(modelName,formName, fieldPrefix, integerValue) {
    var seleccionado = $('#Form'+modelName+'Id-'+integerValue+'  option:selected');
    var inputName = "data["+formName+"]["+fieldPrefix;
    if (seleccionado.val()){
        var Coso =  jQuery.parseJSON(seleccionado.attr('json'));
        for (property in Coso) {
            inputName = "data["+formName+"]["+fieldPrefix+"_"+property+"]";
            $('[name="'+inputName+'"]').val(Coso[property]);
        }
    } else {
        $('input[name^="'+inputName+'"]').val('');
        $('select[name^="'+inputName+'"]').val('');
    }
}

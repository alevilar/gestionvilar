<h2>Resumen de cambios</h2>

<h3>Versión <?php echo GESTAFORM_VERSION?></h3>

<p>Desde su puesta en funcionamiento el sistema ha sufrido numerosas modificaciones con el fin de mejorar la aplicación al máximo. Siguiendo esta metodologia, se ha realizado una actualización que resuelve los siguientes puntos:</p>

<ul>
    <li>F03: en la Secci{on "A" la fecha aparece autom{aticamente sólo cuando ese formulario ya ha sido impreso. En ese caso muesta la última información que se imprimió. Esto se realizó de esa manera debido a que se piensa acelerar los tiempos, suponiendo quela mayoria delos campos a reeimprimir continuarán siendo los mismos que la vez impres anteriormente.
        <br>
        Para ser mas claros:  si ayer imprimí este mismo formulario, supongo que hoy, lo que imprima será casi todo igual SALVO algunos campitos en particulares. Por ello es que se muestran los datos pre-cargados de los formularios anteriores impresos para el mismo vehiculo.
        </li>

        <li>
            En elF01 se eliminó el Dominio cuando van los datos del automotor. No era requerido por este formulario y, por ende, molestaba.
        </li>
        <li>
            F01, F03, F04 y F08: El apoderado ahora se puede elegir.
        </li>
        <lI>
            F01, F03 y F08: Se agregó el campo "PROFESION" en el 3er renglon donde deberia ir el nombre.
        </lI>
        <li>
            Se solucionó el problema que aparecian fechas del 31/12/69 automaticamente cuando no se cargaba ninguna fecha.
        </li>
        <li>
            F08 y F03: Se solucionó el problema que habia ocaciones en que RNP se repetia para el apoderado y para el cliente, o para la esposa y algún actor.
        </li>
        <li>
            F08: El Apoderado no se completaba correctamente en la seccion "K" y "L"
        </li>


</ul>


<h3>Versión 1.1</h3>

<p>Desde su puesta en funcionamiento el sistema ha sufrido numerosas modificaciones con el fin de mejorar la aplicación al máximo. Siguiendo esta metodologia, se ha realizado una actualización que resuelve los siguientes puntos:</p>

<ul>
    <li>F12, 03 y 02, ya no aparecen las fechas del dia actual por defecto</li>
    <li>Se eliminaron las fechas de nacimiento que estaban de más en Actores del tipo Persona Jurídica</li>
    <li>Ahora aparece el nombre del formulario en el que estoy como titulo de la pantalla. Principalmente útil cuando quiero abrir varios formularios en varias solapas</li>
    <li>F03, la cláusula de actualización ahora por defecto aparece en "NO"</li>
</ul>


    
<h3>Versiones Anteriores</h3>

<h4>Versión 1.0 Beta (10 Dic 2010)</h4>
<ul>
    <li>¡¡Nuevo Diseño mas ágil, dinámico y alegre!!</li>
    <li>Posibilidad de imprimir Formularios Rápidos, sin necesidad de crear clientes ni vehículos</li>
    <li>Nuevo buscador con mejores posibilidades de filtrado</li>
</ul>


<h4>Versión 0.9 (1 Dic 2010)</h4>
<ul>
    <li>Ahora se pueden eliminar formularios historicos desde la misma pantalla que los muestra, precionando sobre la "X" que aparece al lado</li>
    <li>Nuevo Campo "Cuadraditos" Que permite insertar datos en los formularios y que estos imprima cada carácter en un cuadradito. Se realizó este trabajo específicamente para los formularios 13</li>
    <li>Nuevas pantallas de acdministración de campos de coordenadas. Se ha llegado a la fase final de la página que permitirá realizar modificaciones en las coordenadas, asi como se podrá agregar nuevos "datos" a los formularios de forma automática y simple. Sólo creando un campo con un nombre, su posición y la relación con el campo en la base de datos, se podrá crear un nuevo valor en el PDF.</li>
    <li>Primera versión de los formularios 13 para Bs As y CABA</li>
</ul>


<h4>Versión 0.8.1 (8 Nov 2010)</h4>
<ul>
    <li>Ahora se guarda correctamente el CUIT y CUIL de los Actores</li>
    <li>Ahora aparece la ocupacioón del cliente, cuando éste es del tipo Cliente Físico.
        La ocupación aparece en el formulario, arriba a la derecha, junto a las notas.
        La propuesta aqui, consiste en facilitarles la visualización del dato ocupacion
        para que ustedes la puedan agregar a mano fácilmente haciendo copy-paste
    </li>
    <li>Se separó la Identificación para sólo los clientes Físicos. Quedando la posibilidad de agregar Cuit o Cuil para clientes Físicos o Legales</li>
    <li>Las fechas de nacimiento o creación ahora pueden quedar vacias si se presiona la CRUZ roja (símbolo de eliminar). Este problema se daba en Actores y Clientes</li>
    <li>En el F02, Panedile no aparece la patente de arriba. En mi caso me apareció siempre por lo tanto no pude reproducir este error y no toqué ni modifiqué nada relacionado con este punto</li>
    <li>Elemento probatorio de adquisición ahora aparece en el PDF</li>
    <li>El nombre del cónyuge ahora aparece en el formulario ya sea para los Actores como para los Clientes Naturales</li>
    <li>Ahora se coloca el texto "GARANTIA DE PAGO" en el Formulario 03 sección "Modalidad de Contrato"</li>
</ul>


<h4>Versiones Intermedias</h4>
<p>Sin relevar información sobre actualizaciones realizadas</p>


<h4>Version Inicial:: Versión 0.0.1 (6 Julio 2010)</h4>
<ul>
    <li>Primera versión de los formularios: 02, 11, 12 y 59M</li>
</ul>


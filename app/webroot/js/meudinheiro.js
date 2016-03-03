/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function mostraLoading() {
    $('#interacao').show();
}

function ocultaLoading() {
    $('#interacao').hide();
}
$(document).ready(function() {
    $body = $("body");

    $(document).on({
        ajaxStart: function () {
            mostraLoading();
        },
        ajaxStop: function () {
            ocultaLoading();
        }
    });
});
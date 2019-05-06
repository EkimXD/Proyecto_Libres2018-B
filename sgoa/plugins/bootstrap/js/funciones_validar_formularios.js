function validar_formulario_profesor(){
    var es_valida_la_cedula=validar_cedula();
    if(es_valida_la_cedula===true){
        return true;
    }else{
         alert('la cédula ingresada no es válida');
         return false;
    }
}

function validar_formulario_estudiante()
{ 
    var es_valida_la_cedula=validar_cedula();
    var son_iguales_contrasenias=comparar_contrasenias();
    if(es_valida_la_cedula && son_iguales_contrasenias){
        return true;
    }else{
        if(es_valida_la_cedula===false){
            alert('la cédula ingresada no es válida');
        }
        if(son_iguales_contrasenias===false){
            alert('las contraseñas no son idénticas');
        }
        return false;
    }
}

function comparar_contrasenias()
{
    var contrasenia=document.getElementById('contrasenia').value;
    var contrasenia1=document.getElementById('contrasenia1').value;
    //alert(contrasenia + contrasenia1);
    if (contrasenia.localeCompare(contrasenia1)===0) {
        return true;
    } else
    {
        return false;
    }
}

function isDigit(str) {
    return str && !/[^\d]/.test(str);
}

function validar_cedula() {
    var cedula = document.getElementById('cedula').value;
    flag = false;
    if (isDigit(cedula)) {
        //Preguntamos si la cedula consta de 10 digitos
        if (cedula.length === 10) {

            //Obtenemos el digito de la region que sonlos dos primeros digitos
            var digito_region = cedula.substring(0, 2);

            //Pregunto si la region existe ecuador se divide en 24 regiones
            if (digito_region >= 1 && digito_region <= 24) {

                // Extraigo el ultimo digito
                var ultimo_digito = cedula.substring(9, 10);

                //Agrupo todos los pares y los sumo
                var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));

                //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
                var numero1 = cedula.substring(0, 1);
                var numero1 = (numero1 * 2);
                if (numero1 > 9) {
                    var numero1 = (numero1 - 9);
                }

                var numero3 = cedula.substring(2, 3);
                var numero3 = (numero3 * 2);
                if (numero3 > 9) {
                    var numero3 = (numero3 - 9);
                }

                var numero5 = cedula.substring(4, 5);
                var numero5 = (numero5 * 2);
                if (numero5 > 9) {
                    var numero5 = (numero5 - 9);
                }

                var numero7 = cedula.substring(6, 7);
                var numero7 = (numero7 * 2);
                if (numero7 > 9) {
                    var numero7 = (numero7 - 9);
                }

                var numero9 = cedula.substring(8, 9);
                var numero9 = (numero9 * 2);
                if (numero9 > 9) {
                    var numero9 = (numero9 - 9);
                }

                var impares = numero1 + numero3 + numero5 + numero7 + numero9;

                //Suma total
                var suma_total = (pares + impares);

                //extraemos el primero digito
                var primer_digito_suma = String(suma_total).substring(0, 1);

                //Obtenemos la decena inmediata
                var decena = (parseInt(primer_digito_suma) + 1) * 10;

                //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
                var digito_validador = decena - suma_total;

                //Si el digito validador es = a 10 toma el valor de 0
                if (digito_validador == 10)
                    var digito_validador = 0;

                //Validamos que el digito validador sea igual al de la cedula
                if (digito_validador == ultimo_digito) {
                    //console.log('la cedula:' + cedula + ' es correcta');
                    flag = true;
                } else {
                    //console.log('la cedula:' + cedula + ' es incorrecta');
                    flag = false;
                }

            } else {
                // imprimimos en consola si la region no pertenece
                //console.log('Esta cedula no pertenece a ninguna region');
                flag = false;
            }
        } else {
            //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
            //console.log('Esta cedula tiene menos de 10 Digitos');
            flag = false;
        }
    } else
    {
        flag = false;
    }
    return flag;
}
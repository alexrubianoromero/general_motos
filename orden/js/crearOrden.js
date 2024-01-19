//estga es para buscar la placa exacta y traern info si existe
//sino existe mostrara un mensaje que la placa no existe 
function busquePlacaNueva123(){

    // alert('buenas '); 
    var placa = document.getElementById('placaABuscarEnBAseDatos').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultadosPlaca_new").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=busquePlacaNueva123'
            +'&placa='+placa
    );

}


//esta funcion va a traer las placasque conicidan con la busqueda 
function busquePlacasQueConicidan(){
    // alert('buenas '); 
    var placa = document.getElementById('placaABuscarEnBAseDatos').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultadosPlaca_new").innerHTML  = this.responseText;
               document.getElementById("div_info_propietario").innerHTML  = '';
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=busquePlacasQueConicidan'
            +'&placa='+placa
    );
}

//esta funcion fue adaptada de busquePlacasQueConicidan
//con la diferencia que esta busca  por idcarro  que se pase por parametro 
//la otra no tomaba valor por parametro y buscaba era por placa

function busquePlacasQueConicidanIdCarro(idCarro){
    // alert('buenas '); 
    // var placa = document.getElementById('placaABuscarEnBAseDatos').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultadosPlaca_new").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=busquePlacasQueConicidanIdCarro'
            +'&idCarro='+idCarro
    );
}


function buscarPropietarioDesdeOrden(){
    // alert('buenas '); 
    var nombre = document.getElementById('inputBuscarPropietario').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("idPropietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=buscarPropietarioDesdeOrden'
            +'&nombre='+nombre
    );

}
function buscarPropietarioDesdePlaca(){
    // alert('buenas '); 
    var nombre = document.getElementById('inputBuscarPropietario').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("idNuevoPropietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=buscarPropietarioDesdeOrden'
            +'&nombre='+nombre
    );

}
function colocarNuevoClienteEnSelect(){
    // alert('buenas '); 
    var idCliente = document.getElementById('idClienteGrabado').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("idPropietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=colocarNuevoClienteEnSelect'
            +'&idCliente='+idCliente
    );
}
function colocarNuevoClienteEnSelectNew(idCliente){
    // alert('buenas '); 
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("idPropietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=colocarNuevoClienteEnSelect'
            +'&idCliente='+idCliente
    );
}



function muestreFormuNuevaPlaca()
{
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_resultadosPlaca_new").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=muestreFormuNuevaPlaca'
    // +'&placa='+placa
    );
}
function llamarFormuNuevoProp()
{
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyNuevoCliente").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=llamarFormuNuevoProp'
    // +'&placa='+placa
    );
}

function grabarNuevoPropietarioOrden(){
    // alert('buenas '); 
    var identi = document.getElementById('txtIdenti').value;
    var nombre = document.getElementById('txtNombre').value;
    var direccion = document.getElementById('txtDireccion').value;
    var telefono = document.getElementById('txtTelefono').value;
    var email = document.getElementById('txtEmail').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyNuevoCliente").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=grabarNuevoPropietarioOrden'
    +'&identi='+identi
    +'&nombre='+nombre
    +'&direccion='+direccion
    +'&telefono='+telefono
    +'&email='+email
    );
}

function escogioPropietario(){
    document.getElementById('inputBuscarPropietario').value = '';
    var idPropietario = document.getElementById('idPropietario').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_info_propietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=escogioPropietario'
            +'&idPropietario='+idPropietario
    );
}
function mostrarPropietarioActualizado(idPropietario){
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_info_propietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarPropietarioActualizado'
            +'&idPropietario='+idPropietario
    );
}


function formuModificarPropietarioOrden(idCliente){
    // alert(idCliente); 
    // document.getElementById("div_info_propietario").;
    // document.getElementById("modalNuevoCliente").modal('show');
    // document.getElementById("modalNuevoCliente").style('display','block');
    // document.getElementById('inputBuscarPropietario').value = '';
    // var idPropietario = document.getElementById('idPropietario').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("modalBodyNuevoCliente").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuModificarPropietarioOrden'
    +'&idCliente='+idCliente
    );
}
function actualizarPropietarioOrden(idCliente){
    var identi = document.getElementById('txtIdentiMod').value;
    var nombre = document.getElementById('txtNombreMod').value;
    var direccion = document.getElementById('txtDireccionMod').value;
    var telefono = document.getElementById('txtTelefonoMod').value;
    var email = document.getElementById('txtEmailMod').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoCliente").innerHTML  = this.responseText;
               //actualizar la imagen y que recargue el listado declientes
               mostrarPropietarioActualizado(idCliente);
               colocarNuevoClienteEnSelectNew(idCliente);

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarPropietarioOrden'
            +'&idCliente='+idCliente
            +'&identi='+identi
            +'&nombre='+nombre
            +'&direccion='+direccion
            +'&telefono='+telefono
            +'&email='+email
    );
}
function realizarGrabacionMoto()
{
    // alert('llego a la funcion ');

    var valida = validarCamposGrabarMoto();
    if(valida)
    {
        var idCliente = document.getElementById('idPropietario').value;
        var placa = document.getElementById('txtPlaca').value;
        var marca = document.getElementById('txtMarca').value;
        var linea = document.getElementById('txtLinea').value;
        var modelo = document.getElementById('txtModelo').value;
        var chasis = document.getElementById('txtChasis').value;
        var motor = document.getElementById('txtMotor').value;
        var soat = document.getElementById('txtSoat').value;
        var tecno = document.getElementById('txtTecnomecanica').value;
        const http=new XMLHttpRequest();
        const url = '../orden/crearOrdenNueva.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_info_propietario").innerHTML  = this.responseText;
                //actualizar la imagen y que recargue el listado declientes
                // mostrarPropietarioActualizado(idCliente);
                // colocarNuevoClienteEnSelectNew(idCliente);
                limpiarDivsPrincipales();
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=realizarGrabacionMoto'
        +'&idCliente='+idCliente
        +'&placa='+placa
        +'&marca='+marca
        +'&linea='+linea
        +'&modelo='+modelo
        +'&chasis='+chasis
        +'&motor='+motor
        +'&soat='+soat
        +'&tecno='+tecno
        );
     } //fiin de si valida
}
    
function validarCamposGrabarMoto()
{
    if( document.getElementById('idPropietario').value == '-1'){
        alert('Por seleccionar o crear propietario');
        document.getElementById('idPropietario').focus();
        return 0;
    }
    if( document.getElementById('txtPlaca').value == ''){
        alert('Por digitar placa');
        document.getElementById('txtPlaca').focus();
        return 0;
    }
    if( document.getElementById('txtMarca').value == ''){
        alert('Por digitar marca');
        document.getElementById('txtMarca').focus();
        return 0;
    }
    if( document.getElementById('txtLinea').value == ''){
        alert('Por digitar linea');
        document.getElementById('txtLinea').focus();
        return 0;
    }
    if( document.getElementById('txtModelo').value == ''){
        alert('Por digitar modelo');
        document.getElementById('txtModelo').focus();
        return 0;
    }

    
    return 1;
}
function limpiarDivsPrincipales()
{
    document.getElementById("div_resultadosPlaca_new").innerHTML  = '';
}


function revisarSiExistePlaca(){
    // alert('buenas '); 
    var placa = document.getElementById('txtPlaca').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divAdvertenciaPlaca").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=revisarSiExistePlaca'
    +'&placa='+placa
    );
}
function verificarSiexisteIdentidad(){
    // alert('buenas '); 
    var identi = document.getElementById('txtIdenti').value;
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divAdvertenciaIdenti").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verificarSiexisteIdentidad'
    +'&identi='+identi
    );
}

function traerResumenInfoPlaca(idCarro){
    // alert('buenas '); 
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_info_propietario").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerResumenInfoPlaca'
            +'&idCarro='+idCarro
    );
    // traerHistorialInfoPlaca(idCarro);
}
function traerHistorialInfoPlaca(idCarro){
    // alert('buenas '); 
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("divUltimaParte").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerHistorialInfoPlaca'
            +'&idCarro='+idCarro
    );
}
function traerHistorialMotosPlaca(idCarro){
    // alert(placa); 
    const http=new XMLHttpRequest();
    const url = '../orden/crearOrdenNueva.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyHistorialMotos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerHistorialMotosPlaca'
            +'&idCarro='+idCarro
    );
}



function actualizarPropietarioOrdenNuevo(idCarro){
    //  alert(idCliente); 
    var idCliente = document.getElementById('idNuevoPropietario').value;
    if(idCliente == -1){
        alert('Nuevo propietario esta en blanco ');
    }else{

        const http=new XMLHttpRequest();
        const url = '../orden/crearOrdenNueva.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                // document.getElementById("div_info_propietario").innerHTML  = this.responseText;
                document.getElementById("div_info_propietario").innerHTML  = '';
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=actualizarPropietarioOrdenNuevo'
        +'&idCarro='+idCarro
        +'&idCliente='+idCliente
        );
        setTimeout(() => {
            busquePlacasQueConicidanIdCarro(idCarro);
        }, 500);
    }
}

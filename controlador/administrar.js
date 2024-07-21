var App = angular.module('app', []);

App.controller('adminFac', function($scope, $http) {

    // Objeto para almacenar los datos de una nueva factura
    $scope.nuevaFactura = {};

    // Arreglo para almacenar todas las facturas
    $scope.facturas = [];

    // Función para consultar facturas desde el backend
    $scope.consultar = function() {
        $http.post('./medioAdministrar/consultar.php')
            .then(function(response) {
                $scope.facturas = response.data;
            }, function(error) {
                alert("Error en la Petición");
            });
    }

    // Consultar facturas al cargar la página
    $scope.consultar();

    // Función para guardar una nueva factura
    $scope.guardar = function() {
        $http.post('./medioAdministrar/guardar.php', $scope.nuevaFactura)
            .then(function(response) {
                $scope.nuevaFactura = {};
                $scope.consultar();
                $('#myModal').modal('hide');
            }, function(error) {
                alert("Error en la Petición");
            });
    }

    // Objeto para almacenar los datos de una factura a modificar
    $scope.facturaMod = {};

    // Función para eliminar una factura
    $scope.eliminar = function(factura) {
        let isBook = confirm("¿Quieres eliminar este registro?");
        if (isBook) {
            $http.post('./medioAdministrar/eliminar.php', factura)
                .then(function(response) {
                    $scope.nuevaFactura = {};
                    $scope.consultar();
                    $('#myModal').modal('hide');
                }, function(error) {
                    alert("Error en la Petición");
                });
        }
    }

    // Función para seleccionar una factura y mostrarla en un modal
    $scope.seleccionar = function(u) {
        $scope.facturaMod = u;
        $("#ModalMod").modal();
    }

    // Función para modificar una factura
    $scope.modificar = function() {
        $http.post('./medioAdministrar/modificar.php', $scope.facturaMod)
            .then(function(response) {
                $scope.nuevaFactura = {};
                $scope.consultar();
                $('#ModalMod').modal('hide');
            }, function(error) {
                alert("Error en la Petición");
            });
    }

    $scope.factura = function(factura) {
        let isSure = confirm("¿Estás seguro que deseas crear el archivo Excel?");
        if (isSure) {
            $http.post('./medioAdministrar/Excel.php', factura, { responseType: 'arraybuffer' })
                .then(function(response) {
                    var blob = new Blob([response.data], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var downloadLink = angular.element('<a></a>');
                    downloadLink.attr('href', window.URL.createObjectURL(blob));
                    downloadLink.attr('download', 'factura.xlsx');
                    downloadLink[0].click();
                }, function(error) {
                    console.error('Error al generar el archivo Excel:', error);
                });
        } else {
            console.log("Cancelado por el usuario");
        }
    };
    

});

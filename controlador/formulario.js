var App = angular.module('app', []);

App.controller('admin', ['$scope', '$http', function($scope, $http) {
    $scope.factura = {};

    $scope.insertarFactura = function() {
        console.log('Insertando factura:', $scope.factura);
        $http.post('./factura.php', $scope.factura)
            .then(function(response) {
                console.log('Respuesta del servidor:', response.data);
                if (response.data.success) {
                    alert('Factura insertada correctamente');
                    $scope.factura = {}; // Limpiar los campos del formulario
                } else {
                    alert('Error al insertar la factura: ' + response.data.error);
                }
            }, function(error) {
                console.error('Error en la solicitud:', error);
                alert('Error al insertar la factura');
            });
    };

    $scope.actualizarCuota = function(clave, cuotaField) {
        $http.get('./cuota.php?clave=' + clave).then(function(response) {
            if (response.data.success) {
                $scope.factura[cuotaField] = response.data.cuota;
                $scope.calcularImporte();
            } else {
                alert('Clave no encontrada');
            }
        }, function(error) {
            alert('Error en la solicitud');
        });
    };

    $scope.calcularImporte = function() {
        var cuota1 = parseFloat($scope.factura.cuota) || 0;
        var cuota2 = parseFloat($scope.factura.cuota2) || 0;
        var cuota3 = parseFloat($scope.factura.cuota3) || 0;
        $scope.factura.importe = cuota1 + cuota2 + cuota3;
    };
}]);

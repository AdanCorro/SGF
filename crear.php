<!DOCTYPE html>
<html lang="es" ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Factura</title>
        <link rel="stylesheet" href="build/css/app.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="controlador/angular.min.js"></script>
    </head>
    <body ng-controller="admin">
        <div class="background-contenedor container main-container">
            <h1 class="titulo3">Formulario de Factura</h1>
            <form class="formulario" ng-submit="insertarFactura()">
                <div class="form-group">
                    <label class="campo-formulario" for="ur">UR:</label>
                    <input type="number" class="form-control" id="ur" ng-model="factura.ur" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="fecha">Fecha:</label>
                    <input type="datetime-local" class="form-control" id="fecha" ng-model="factura.fecha" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="entidadFederativa">Entidad Federativa:</label>
                    <select class="form-control" id="entidadFederativa" ng-model="factura.entidadFederativa" required>
                        <option value="Alvarado">Alvarado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="ApPaterno">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="ApPaterno" ng-model="factura.ApPaterno" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="ApMaterno">Apellido Materno:</label>
                    <input type="text" class="form-control" id="ApMaterno" ng-model="factura.ApMaterno" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" ng-model="factura.nombre" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" id="matricula" ng-model="factura.matricula" maxlength="9" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario control-label col-sm-2" for="area">Área:</label>
                    <select class="form-control" ng-model="factura.area" id="area" required>
                        <option value="ELEC">Electrónica</option>
                        <option value="MEC">Mecánica</option>                                
                        <option value="PESC">Pesca</option>
                        <option value="ALIM">Alimentos</option>
                        <option value="PREP">Preparación</option>
                        <option value="REFR">Refrigeración</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" ng-model="factura.direccion" maxlength="500" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="grado">Grado:</label>
                    <input type="number" class="form-control" id="grado" ng-model="factura.grado" required>
                </div>
                <div class="form-group">
                    <label class="campo-formulario campo-formulario_centralizado" for="turno">Turno:</label>
                    <select class="form-control" id="turno" ng-model="factura.turno" required>
                        <option value="M">Matutino</option>
                        <option value="V">Vespertino</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label class="campo-formulario" for="clave">Clave 1:</label>
                    <select class="form-control" id="clave" ng-model="factura.clave" ng-change="actualizarCuota(factura.clave, 'cuota')" required>
                        <option value="A001">ACREDITACION, CERT. Y CONVALIDACION DE ESTUDIOS</option>
                        <option value="A002">EXPEDICION Y OTORGAMIENTO DE DOC. OFICIALES</option>
                        <option value="A003">EXAMENES</option>
                        <option value="A004">DEPOSITOS CHEQUE 1643 Y 1644 POR SUBSIDIO FEDERAL</option>
                        <option value="B001">CUOTAS DE COOP. VOLUNTARIA</option>
                        <option value="B002">APORTACIONES, COOP. Y DON. AL PLANTEL</option>
                        <option value="B003">BENEFICIOS</option>
                        <option value="C006">OTROS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="cuota">Cuota 1:</label>
                    <input type="number" step="0.01" class="form-control" id="cuota" ng-model="factura.cuota" ng-change="calcularImporte()" required>
                </div>

                <div class="form-group">
                    <label class="campo-formulario" for="clave2">Clave 2:</label>
                    <select class="form-control" id="clave2" ng-model="factura.clave2" ng-change="actualizarCuota(factura.clave2, 'cuota2')">
                        <option value="A001">ACREDITACION, CERT. Y CONVALIDACION DE ESTUDIOS</option>
                        <option value="A002">EXPEDICION Y OTORGAMIENTO DE DOC. OFICIALES</option>
                        <option value="A003">EXAMENES</option>
                        <option value="A004">DEPOSITOS CHEQUE 1643 Y 1644 POR SUBSIDIO FEDERAL</option>
                        <option value="B001">CUOTAS DE COOP. VOLUNTARIA</option>
                        <option value="B002">APORTACIONES, COOP. Y DON. AL PLANTEL</option>
                        <option value="B003">BENEFICIOS</option>
                        <option value="C006">OTROS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="cuota2">Cuota 2:</label>
                    <input type="number" step="0.01" class="form-control" id="cuota2" ng-model="factura.cuota2" ng-change="calcularImporte()">
                </div>

                <div class="form-group">
                    <label class="campo-formulario" for="clave3">Clave 3:</label>
                    <select class="form-control" id="clave3" ng-model="factura.clave3" ng-change="actualizarCuota(factura.clave3, 'cuota3')">
                        <option value="A001">ACREDITACION, CERT. Y CONVALIDACION DE ESTUDIOS</option>
                        <option value="A002">EXPEDICION Y OTORGAMIENTO DE DOC. OFICIALES</option>
                        <option value="A003">EXAMENES</option>
                        <option value="A004">DEPOSITOS CHEQUE 1643 Y 1644 POR SUBSIDIO FEDERAL</option>
                        <option value="B001">CUOTAS DE COOP. VOLUNTARIA</option>
                        <option value="B002">APORTACIONES, COOP. Y DON. AL PLANTEL</option>
                        <option value="B003">BENEFICIOS</option>
                        <option value="C006">OTROS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="campo-formulario" for="cuota3">Cuota 3:</label>
                    <input type="number" step="0.01" class="form-control" id="cuota3" ng-model="factura.cuota3" ng-change="calcularImporte()">
                </div>

                <div class="form-group">
                    <label class="campo-formulario" for="importe">Importe:</label>
                    <input type="number" step="0.01" class="form-control" id="importe" ng-model="factura.importe" required>
                </div>
                <button type="submit" class="btn-enviar btn btn-primary">Enviar</button>
                <button type="button" class="btn-consultar btn btn-primary" onclick="window.location.href='consultar.php'">Consultar</button>
            </form>
        </div>
        <script src="controlador/formulario.js"></script>
    </body>
</html>

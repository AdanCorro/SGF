<?php require_once 'validacion.php'; ?>

<link rel="stylesheet" href="build/css/app.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="controlador/angular.min.js"></script>
<script src="controlador/administrar.js"></script>

<body ng-app="app" ng-controller="adminFac">
    <div class="container">
        <form>
            <div class="input-group col-sm-6 offset-sm-3 buscador-container">
                <input class="form-control" type="text" name="buscador" id="buscador" placeholder="Buscar">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <br>
        <h2 class="admin-titulo">Historial de Facturas</h2>
        <table class="table table-hover table-responsive table-striped">
            <thead>
                <tr>
                    <th class="tabla-colum">Recibo No.</th>
                    <th class="tabla-colum">Matricula</th>
                    <th class="tabla-colum">Grado</th>
                    <th class="tabla-colum">Área</th>
                    <th class="tabla-colum">Turno</th>
                    <th class="tabla-colum">Clave</th>
                    <th class="tabla-colum">Fecha</th>
                    <th class="tabla-colum">Modificar <span class="glyphicon glyphicon-pencil"></span></th>
                    <th class="tabla-colum">Eliminar <span class="glyphicon glyphicon-trash"></span></th>
                    <th class="tabla-colum">Imprimir <span class="glyphicon glyphicon-print"></span></th>
                </tr>
            </thead>
            <tbody>
                <tr class="tabla" ng-repeat="u in facturas">
                    <td class="recibo">{{u.numRecibo}}</td>
                    <td class="recibo">{{u.matricula}}</td>
                    <td>{{u.grado}}</td>
                    <td>{{u.area}}</td>
                    <td>{{u.turno}}</td>
                    <td>{{u.clave}}</td>
                    <td>{{u.fecha}}</td>
                    <td>
                        <button type="button" ng-click="seleccionar(u)" class="btn btn-success">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                    <td>
                        <button type="button" ng-click="eliminar(u)" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                    <td>
                        <button type="button" ng-click="factura(u)" class="btn btn-info">
                            <span class="glyphicon glyphicon-print"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Modal modificar producto-->
        <div id="ModalMod" class="modal fade" role="dialog">
            <div class="modal-dialog ">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modificar Factura</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="factura">Matricula:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="facturaMod.matricula" id="matricula" placeholder="Matricula del Alumno" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="factura">Grado:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="facturaMod.grado" id="grado" placeholder="Grado del Alumno" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="factura sel1">Área:</label>
                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="facturaMod.area" id="area" required>
                                        <option value="ELEC">Electrónica</option>
                                        <option value="MEC">Mecánica</option>                                
                                        <option value="PESC">Pesca</option>
                                        <option  option value="ALIM">Alimentos</option>
                                        <option value="PREP">Preparación</option>
                                        <option value="REFR">Refrigeración</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="factura">Turno:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="facturaMod.turno" id="turno" placeholder="Turno del Alumno" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="factura">Clave:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="facturaMod.clave" id="clave" placeholder="Clave" required>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" ng-click="modificar()" class="btn btn-primary">Modificar Usuario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> <!-- FIN MODAL MODIFICAR-->
    </div>
    <script src="src/js/script.js"></script>
</body>
</html>

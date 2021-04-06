<?php 
require_once 'actions/estudiante.php';
require_once 'helpers/utilities.php';
require_once 'actions/Cookies.php';
require_once 'layout/main.php';

$layout = new LayoutTest(true);
$service = new CookiesTest();
$utilities = new UtilitiesTest();

$students = $service->GetList();


?>

<?php echo $layout->PrintHeader();?>

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">

            <button type="button" class="btn btn-success button-fix" data-bs-toggle="modal" data-bs-target="#nueva-student">
                Agregar nuevo estudiante
            </button>

        </div>
    </div>

    <div class="row">
        
        <div class="col-md-3 button-group-fix">
            <div class="btn-group">
                <a href="index.php" class="btn btn-dark text-light">Todos</a>
                <a href="index.php?filtroId=1" class="btn btn-dark text-light">Redes</a>
                <a href="index.php?filtroId=2" class="btn btn-dark text-light">Software</a>
                <a href="index.php?filtroId=3" class="btn btn-dark text-light">Multimedia</a>
                <a href="index.php?filtroId=4" class="btn btn-dark text-light">Mecatronica</a>
                <a href="index.php?filtroId=5" class="btn btn-dark text-light">Seguridad informática</a>

            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="col-sm-12">
        <div class="card card_fix2" id="content-container">
            <div class="card-body">
            <div class="row">

                <?php if(count($students) == 0): ?>
                    <div class="card-body">
                        <h2 class="card-text">No se encontraron estudiantes. Para agregar uno nuevo presione el botón Agregar estudiantes</h2>
                    </div>

                <?php else: ?>
                    <?php foreach($students as $student) : ?>
                        <div class="col-md-3 mb-3">
                            
                                <?php if($student->Status != "on") :?>
                                        <div class="card card-fix border-danger">
                                <?php else: ?>
                                    <div class="card card-fix border-success">
                                <?php endif; ?>

                                <div class="card-body">
                                    <img src="archivos/<?= $student->Foto ?>" class="card-img-top">
                                    <h5 class="card-title"><?= $student->Name.' '.$student->Apellido ?></h5>
                                    <p class="card-text"><b>Carrera</b>: <?= $utilities->carreras[$student->CarreraId]?></p>
                                </div>

                                <div class="card-body">
                                    <a href="actions/info.php?id=<?= $student->id ?>" class="btn btn-primary">Ver info</a>
                                    <a href="actions/edit.php?id=<?= $student->id ?>" class="btn btn-warning">Editar</a>
                                    <a href="#" id="btn-delete" data-id="<?= $student->id ?>" class="btn btn-danger">Eliminar</a>
                                </div>
                                
                                    <?php if($student->Status != "on") :?>
                                        <div class="card-footer text-danger">
                                        Estado: Inactivo
                                    <?php else: ?>
                                        <div class="card-footer text-success">
                                        Estado: Activo
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        
                    
                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>

    

    

    <!-- Modal -->
    <div class="modal fade" id="nueva-student" tabindex="-1" aria-labelledby="firstModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="firstModal">Agregar Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="actions/add.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" name="NombreEstudiante" class="form-control" id="pelicula" placeholder="Juan">
                            <label for="nombre">Nombre</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="ApellidoEstudiante" class="form-control" id="pelicula" placeholder="Perez">
                            <label for="nombre">Apellido</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="MateriasFavoritas" placeholder="Leave a description here" id="description" style="height: 100px"></textarea>
                            <label for="description">Materias favoritas (separadas por coma)</label>
                        </div> 

                        <div class="col-sm-8 mb-4">

                            <label class="visually-hidden" for="Genero">Elegir Carrera</label>
                            <select name="CarreraId" class="form-select" id="genero">
                                <option value="0">Seleccionar carrera</option>
                                <?php foreach($utilities->carreras as $value => $carrera):?>
                                    
                                    <option value="<?= $value ?>"><?= $carrera ?></option>

                                <?php endforeach;?>

                            </select>
        
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Seleccionar una foto de perfil</label>
                            <input class="form-control" name="archivo" type="file" id="formFile">
                        </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

                </form>
            </div>
        </div>
    </div>

<?php echo $layout->PrintFooter();?>
<script src="assets\js\main\index.js"></script>
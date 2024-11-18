<?php

require_once __DIR__ . '/../../../config.php';

function genCRUDModal(string $form)
{
?>
    <div class="modal fade" id="CRUDModal" tabindex="-1" aria-labelledby="CRUDModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="CRUDModalLabel"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="crudLoader" class="spinner-border my-5 mx-auto" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <div id="crudError" class="my-5 mx-auto">
                    <p>Ocurrio un error en la solicitud.</p>
                </div>

                <div id="crudContent">
                    <div class="modal-body">
                        <?php

                        include COMPONENTS_PATH . $form;

                        ?>
                    </div>

                    <div id="editTools" class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="deleteButton">Borrar</button>
                        <button type="button" class="btn btn-primary" id="editButton">Guardar cambios</button>
                    </div>

                    <div id="createTools" class="modal-footer">
                        <button type="button" class="btn btn-primary" id="createButton">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
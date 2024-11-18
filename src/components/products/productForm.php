<form id="crudForm">
    <div class="mb-3 mx-auto ratio ratio-4x3 rounded border overflow-hidden">
        <img class="object-fit-cover" src="" id="editProductoImagenPreview" alt="Producto">
    </div>
    <div class="mb-3">
        <input accept="image/png,image/jpeg" type="file" class="form-control" id="editProductoImagen" name="image_data">
    </div>
    <div class="mb-3">
        <label for="editNombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="editNombre" name="nombre" required maxlength="250">
    </div>
    <div class="mb-3">
        <label for="editDescripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="editDescripcion" rows="3" name="descripcion" required></textarea>
    </div>
    <div class="mb-3">
        <label for="editPrecio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="editPrecio" name="precio" required>
    </div>
    <div class="mb-3">
        <label for="editCantidad" class="form-label">Cantidad</label>
        <input type="number" class="form-control" id="editCantidad" name="cantidad" required>
    </div>
    <div class="mb-3">
        <label for="editProductoProveedorOptions" class="form-label">Proveedor</label>
        <select class="form-select" aria-label="Default select example" id="editProductoProveedorOptions" name="idProveedor" required>
            <option selected>Open this select menu</option>
        </select>
    </div>
</form>
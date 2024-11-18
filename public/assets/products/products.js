const editImageInput = document.querySelector('#editProductoImagen');
const productImagenPreview = document.getElementById(
	'editProductoImagenPreview'
);

function updateWrapper() {
	const productsWrapper = $('#productsWrapper');

	productsWrapper.empty();

	const products = $.get('/electroworld/productos/products.php').done(
		(data, textStatus, jqXHR) => {
			productsWrapper.append(data);
		}
	);
}

onUpdateAction((form, serializedForm, id) => {
	const formData = {};
	$(form)
		.serializeArray()
		.forEach(function (field) {
			formData[field.name] = field.value;
		});

	formData['idProducto'] = id;

	const file = editImageInput.files[0];

	const sendData = image_data => {
		setLoading();

		formData['imageData'] = image_data;

		$.ajax({
			type: 'PUT',
			url: '/electroworld/api/producto.php',
			data: JSON.stringify(formData)
		}).done((data, textStatus, jqXHR) => {
			BsCRUDModal.hide();
			updateWrapper();
		});
	};

	if (file) {
		reader.onloadend = () => {
			sendData(reader.result);
		};

		reader.readAsDataURL(file);
	} else {
		sendData(productImagenPreview.src);
	}
});

onCreateAction((form, serializedForm) => {
	const formData = {};
	$(form)
		.serializeArray()
		.forEach(function (field) {
			formData[field.name] = field.value;
		});

	const file = editImageInput.files[0];

	if (file) {
		setLoading();

		reader.onloadend = () => {
			formData['imageData'] = reader.result;

			$.ajax({
				type: 'POST',
				url: '/electroworld/api/producto.php',
				data: JSON.stringify(formData)
			})
				.done((data, textStatus, jqXHR) => {
					BsCRUDModal.hide();
					updateWrapper();
				})
				.fail(() => {
					setError();
				});
		};

		reader.readAsDataURL(file);
	}
});

onDeleteAction((form, id) => {
	setLoading();

	$.ajax({
		type: 'DELETE',
		url: '/electroworld/api/producto.php',
		data: JSON.stringify({ idProducto: id })
	})
		.done((data, textStatus, jqXHR) => {
			BsCRUDModal.hide();
			updateWrapper();
		})
		.fail(() => {
			setError();
		});
});

onShowModal(
	(modal, event, id) => {
		productImagenPreview.src = '';

		const productRes = $.getJSON('/electroworld/api/producto.php', {
			idProducto: id
		})
			.done((data, textStatus, jqXHR) => {
				const imageElement = document.querySelector(
					'#editProductoImagenPreview'
				);
				const modalNombreInput = modal.querySelector(
					'.modal-body #editNombre'
				);
				const modalDescripcionInput = modal.querySelector(
					'.modal-body #editDescripcion'
				);
				const modalPrecioInput = modal.querySelector(
					'.modal-body #editPrecio'
				);
				const modalCantidadInput = modal.querySelector(
					'.modal-body #editCantidad'
				);

				imageElement.src = data.image_data;

				modalNombreInput.value = data.nombre;
				modalDescripcionInput.value = data.descripcion;
				modalPrecioInput.value = data.precio;
				modalCantidadInput.value = data.cantidad;

				const proveedorRes = $.getJSON(
					'/electroworld/api/provedores.php'
				)
					.done((proveedorData, textStatus, jqXHR) => {
						$('#editProductoProveedorOptions').empty();

						proveedorData.forEach(proveedor => {
							$('#editProductoProveedorOptions').append(
								`<option value="${proveedor.id_proveedor}" ${
									data.id_proveedor ===
										proveedor.id_proveedor && 'selected'
								}>${proveedor.nombre}</option>`
							);
						});

						setOK();
					})
					.fail(() => {
						setError();

						$('#editProductoProveedorOptions').empty();
						return;
					});
			})
			.fail(() => {
				setError();
				return;
				// modalBodyInput.value = recipient;
			});
	},
	(modal, event) => {
		productImagenPreview.src = '';

		const proveedorRes = $.getJSON('/electroworld/api/provedores.php')
			.done((proveedorData, textStatus, jqXHR) => {
				$('#editProductoProveedorOptions').empty();

				proveedorData.forEach(proveedor => {
					$('#editProductoProveedorOptions').append(
						`<option value="${proveedor.id_proveedor}">${proveedor.nombre}</option>`
					);
				});

				setOK();
			})
			.fail(() => {
				setError();

				$('#editProductoProveedorOptions').empty();
				return;
			});
	}
);

// Image preview
document.getElementById('editProductoImagen').addEventListener('change', e => {
	const file = e.target.files[0];

	reader.onloadend = () => {
		productImagenPreview.src = reader.result;
	};

	reader.readAsDataURL(file);
});

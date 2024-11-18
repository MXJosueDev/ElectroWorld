function updateWrapper() {
	const shopsWrapper = $('#shopsWrapper');

	shopsWrapper.empty();

	const shopsRes = $.get('/electroworld/tiendas/shops.php').done(
		(data, textStatus, jqXHR) => {
			shopsWrapper.append(data);
		}
	);
}

onUpdateAction((form, serializedForm, id) => {
	setLoading();

	$.ajax({
		type: 'PUT',
		url: '/electroworld/api/tienda.php',
		data: serializedForm + `&idTienda=${id}`
	})
		.done((data, textStatus, jqXHR) => {
			BsCRUDModal.hide();
			updateWrapper();
		})
		.fail(() => {
			setError();
		});
});

onCreateAction((form, serializedForm) => {
	setLoading();

	$.ajax({
		type: 'POST',
		url: '/electroworld/api/tienda.php',
		data: serializedForm
	})
		.done((data, textStatus, jqXHR) => {
			BsCRUDModal.hide();
			updateWrapper();
		})
		.fail(() => {
			setError();
		});
});

onDeleteAction((form, id) => {
	$.ajax({
		type: 'DELETE',
		url: '/electroworld/api/tienda.php',
		data: JSON.stringify({ idTienda: id })
	})
		.done((data, textStatus, jqXHR) => {
			BsCRUDModal.hide();
			updateWrapper();
		})
		.fail(() => {
			setError();
		});
});

onShowModal((modal, event, id) => {
	const shopRes = $.getJSON('/electroworld/api/tienda.php', {
		idTienda: id
	})
		.done((data, textStatus, jqXHR) => {
			const modalNombreInput = modal.querySelector(
				'.modal-body #editNombre'
			);
			const modalDireccionInput = modal.querySelector(
				'.modal-body #editDireccion'
			);
			const modalTelefonoInput = modal.querySelector(
				'.modal-body #editTelefono'
			);

			modalNombreInput.value = data.nombre;
			modalDireccionInput.value = data.direccion;
			modalTelefonoInput.value = data.telefono;

			setOK();
			return;
		})
		.fail(() => {
			setError();
			return;
		});
});

// Shop_Products
$('.shopProductCheckbox').change(function () {
	const checkbox = $(this);
	const [idTienda, idProducto] = checkbox.attr('id').split('_');
	const checked = checkbox.prop('checked');

	const data = {
		idTienda,
		idProducto
	};

	const ajaxOptions = {
		type: checked ? 'POST' : 'DELETE',
		url: '/electroworld/api/tienda_producto.php',
		data: JSON.stringify(data)
	};

	$.ajax(ajaxOptions).fail(() => {
		checkbox.prop('checked', !checked);
		setError();
	});
});

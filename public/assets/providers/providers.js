function updateWrapper() {
	const providersWrapper = $('#providersWrapper');

	providersWrapper.empty();

	const providersRes = $.get('/electroworld/provedores/providers.php').done(
		(data, textStatus, jqXHR) => {
			providersWrapper.append(data);
		}
	);
}

onUpdateAction((form, serializedForm, id) => {
	setLoading();

	$.ajax({
		type: 'PUT',
		url: '/electroworld/api/proveedor.php',
		data: serializedForm + `&idProveedor=${id}`
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
		url: '/electroworld/api/proveedor.php',
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
		url: '/electroworld/api/proveedor.php',
		data: JSON.stringify({ idProveedor: id })
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
	const providerRes = $.getJSON('/electroworld/api/proveedor.php', {
		idProveedor: id
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

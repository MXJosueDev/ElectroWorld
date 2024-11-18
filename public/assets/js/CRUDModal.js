const reader = new FileReader();

// Modals
const CRUDModal = document.getElementById('CRUDModal');
const BsCRUDModal = new bootstrap.Modal('#CRUDModal');

const CRUDForm = document.getElementById('crudForm');

// Modal contents
const modalLoader = CRUDModal.querySelector('#crudLoader');
const modalError = CRUDModal.querySelector('#crudError');
const modalContent = CRUDModal.querySelector('#crudContent');
const modalEditTools = CRUDModal.querySelector('#editTools');
const modalCreateTools = CRUDModal.querySelector('#createTools');

// Action Buttons
const editButton = document.getElementById('editButton');
const createButton = document.getElementById('createButton');
const deleteButton = document.getElementById('deleteButton');

// Form States
function setError() {
	modalLoader.classList.add('d-none');
	modalContent.classList.add('d-none');
	modalError.classList.remove('d-none');
}

function setOK() {
	modalLoader.classList.add('d-none');
	modalContent.classList.remove('d-none');
	modalError.classList.add('d-none');
}

function setLoading() {
	modalLoader.classList.remove('d-none');
	modalContent.classList.add('d-none');
	modalError.classList.add('d-none');
}

function setEditTools() {
	modalEditTools.classList.remove('d-none');
	modalCreateTools.classList.add('d-none');
}

function setCreateTools() {
	modalEditTools.classList.add('d-none');
	modalCreateTools.classList.remove('d-none');
}

//
function onCreateAction(callback) {
	createButton.addEventListener('click', event => {
		if (CRUDForm.checkValidity()) {
			const form = $('#crudForm');
			const serializedForm = form.serialize();

			callback(form, serializedForm);
		} else {
			alert('Por favor revisa los campos del formulario.');
		}
	});
}

function onUpdateAction(callback) {
	editButton.addEventListener('click', event => {
		if (CRUDForm.checkValidity()) {
			const form = $('#crudForm');
			const serializedForm = form.serialize();
			const id = CRUDForm.getAttribute('data-update-target');

			callback(form, serializedForm, id);
		} else {
			alert('Por favor revisa los campos del formulario.');
		}
	});
}

function onDeleteAction(callback) {
	deleteButton.addEventListener('click', event => {
		const form = $('#crudForm');
		const id = CRUDForm.getAttribute('data-update-target');

		callback(form, id);
	});
}

function onShowModal(
	updateCallback = () => {
		setOK();
	},
	createCallback = () => {
		setOK();
	}
) {
	if (CRUDModal) {
		CRUDModal.addEventListener('show.bs.modal', event => {
			CRUDForm.reset();

			const button = event.relatedTarget;
			const modalTitle = CRUDModal.querySelector('.modal-title');

			const id = button.getAttribute('data-bs-whatever');

			setLoading();

			if (id) {
				modalTitle.textContent = `Editando: ${id}`;
				setEditTools();

				CRUDForm.setAttribute('data-update-target', id);

				updateCallback(CRUDModal, event, id);
			} else {
				modalTitle.textContent = `Creando`;
				setCreateTools();

				CRUDForm.removeAttribute('data-update-target');

				createCallback(CRUDModal, event);
			}
		});

		BsCRUDModal.handleUpdate();
	}
}

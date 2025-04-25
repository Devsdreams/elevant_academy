<!-- filepath: c:\xampp\htdocs\elevant_academy\application\views\backend\user\groups.php -->
<div class="container">
    <h3><?php echo get_phrase('groups'); ?></h3>
    <form id="group_form" action="<?php echo site_url('user/save_group'); ?>" method="post" enctype="multipart/form-data">
        <!-- Nombre del grupo -->
        <div class="form-group">
            <label for="group_name"><?php echo get_phrase('group_name'); ?></label>
            <input type="text" class="form-control" id="group_name" name="group_name" required>
        </div>

        <!-- Formulario manual para agregar contactos -->
        <div class="form-group">
            <div class="row">
                <!-- Contact Name -->
                <div class="col-md-3">
                    <label for="contact_name"><?php echo get_phrase('contact_name'); ?></label>
                    <input type="text" class="form-control" id="contact_name" placeholder="<?php echo get_phrase('enter_contact_name'); ?>">
                </div>

                <!-- Contact Email -->
                <div class="col-md-3">
                    <label for="email_input"><?php echo get_phrase('email'); ?></label>
                    <input type="email" class="form-control" id="email_input" placeholder="<?php echo get_phrase('enter_email'); ?>">
                </div>

                <!-- Contact Number -->
                <div class="col-md-3">
                    <label for="contact_number"><?php echo get_phrase('contact_number'); ?></label>
                    <input type="text" class="form-control" id="contact_number" placeholder="<?php echo get_phrase('enter_contact_number'); ?>">
                </div>

                <!-- Company -->
                <div class="col-md-3">
                    <label for="company"><?php echo get_phrase('company'); ?></label>
                    <input type="text" class="form-control" id="company" placeholder="<?php echo get_phrase('enter_company_name'); ?>">
                </div>
            </div>
        </div>

        <!-- Botón para agregar contacto -->
        <div class="form-group text-left">
            <button class="btn btn-primary btn-sm" type="button" id="add_contact_button"><?php echo get_phrase('add'); ?></button>
        </div>

        <!-- Campo para subir archivo -->
        <div class="form-group">
            <label for="email_file"><?php echo get_phrase('upload_contacts_file'); ?></label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="email_file" name="email_file" accept=".xls, .xlsx">
                <label class="custom-file-label" for="email_file"><?php echo get_phrase('choose_file'); ?></label>
            </div>
            <small class="text-muted"><?php echo get_phrase('upload_excel_file_with_columns_name_email_number_company'); ?></small>
        </div>

        <!-- Botón para descargar formato Excel -->
        <div class="form-group">
            <a href="<?php echo site_url('user/download_contact_format'); ?>" >
                <?php echo get_phrase('download_excel_format'); ?>
            </a>
        </div>

        <!-- Tabla para mostrar contactos -->
        <div class="form-group">
            <table class="table table-bordered" id="contact_table">
                <thead>
                    <tr>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('email'); ?></th>
                        <th><?php echo get_phrase('number'); ?></th>
                        <th><?php echo get_phrase('company'); ?></th>
                        <th><?php echo get_phrase('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los contactos se agregarán dinámicamente aquí -->
                </tbody>
            </table>
        </div>

        <!-- Campo oculto para enviar contactos como JSON -->
        <input type="hidden" name="manual_emails" id="manual_emails">

        <!-- Botón para guardar contactos -->
        <div class="form-group text-left">
            <button class="btn btn-success" type="submit"><?php echo get_phrase('save_contacts'); ?></button>
        </div>
    </form>
</div>

<!-- Librerías necesarias -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
    // Referencias a los campos del formulario
    const contactNameInput = document.getElementById('contact_name');
    const emailInput = document.getElementById('email_input');
    const contactNumberInput = document.getElementById('contact_number');
    const companyInput = document.getElementById('company');
    const addContactButton = document.getElementById('add_contact_button');
    const emailFileInput = document.getElementById('email_file');
    const manualContactsInput = document.getElementById('manual_emails');

    let contactList = []; // Lista de contactos

    // Agregar contacto manualmente
    addContactButton.addEventListener('click', function () {
        const name = contactNameInput.value.trim();
        const email = emailInput.value.trim();
        const number = contactNumberInput.value.trim();
        const company = companyInput.value.trim();

        if (name && email && validateEmail(email)) {
            if (!contactList.some(contact => contact.email === email)) {
                contactList.push({ name, email, number, company });
                updateContactTable();
                contactNameInput.value = '';
                emailInput.value = '';
                contactNumberInput.value = '';
                companyInput.value = '';
            } else {
                alert('<?php echo get_phrase('email_already_added'); ?>');
            }
        } else {
            alert('<?php echo get_phrase('enter_valid_contact_details'); ?>');
        }
    });

    // Procesar archivo Excel al seleccionarlo
    emailFileInput.addEventListener('change', async function () {
        const file = emailFileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = async function (e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });

                // Leer la primera hoja del archivo Excel
                const sheetName = workbook.SheetNames[0];
                const sheet = workbook.Sheets[sheetName];

                // Convertir los datos de la hoja a JSON
                const rows = XLSX.utils.sheet_to_json(sheet);

                // Agregar los datos del archivo Excel a la lista de contactos
                rows.forEach(row => {
                    const name = row['Name'] || '';
                    const email = row['Email'] || '';
                    const number = row['Number'] || '';
                    const company = row['Company'] || '';

                    if (email && validateEmail(email)) {
                        if (!contactList.some(contact => contact.email === email)) {
                            contactList.push({ name, email, number, company });
                        }
                    }
                });

                // Actualizar la tabla con los datos cargados
                updateContactTable();
            };

            reader.readAsArrayBuffer(file);
        } else {
            alert('<?php echo get_phrase('please_select_a_file'); ?>');
        }
    });

    // Validar formato de correo
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Actualizar la tabla de contactos
    function updateContactTable() {
        const table = $('#contact_table').DataTable();
        table.clear(); // Limpiar la tabla antes de actualizar
        contactList.forEach((contact, index) => {
            table.row.add([
                contact.name,
                contact.email,
                contact.number,
                contact.company,
                `<button type="button" class="btn btn-danger btn-sm" onclick="removeContact(${index})"><?php echo get_phrase('remove'); ?></button>`
            ]).draw(false);
        });
        manualContactsInput.value = JSON.stringify(contactList); // Guardar como JSON
    }

    // Eliminar contacto de la lista
    function removeContact(index) {
        contactList.splice(index, 1);
        updateContactTable();
    }

    // Inicializar DataTables
    $(document).ready(function () {
        $('#contact_table').DataTable({
            pageLength: 5,
            lengthChange: false,
            searching: true,
            ordering: false,
            info: false
        });
    });
</script>
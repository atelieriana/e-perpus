import { formValidation } from '@form-validation/core';
import { Trigger } from '@form-validation/plugin-trigger';
import { Bootstrap5 } from '@form-validation/plugin-bootstrap5';
import { notEmpty } from '@form-validation/validator-not-empty';
import Swal from 'sweetalert2'

window.FormValidation = {
    formValidation(form, options) {
        return formValidation(form, options)
            .registerValidator('notEmpty', notEmpty);
    },
    plugins: {
        Trigger,
        Bootstrap5,
    },
};

window.Swal = Swal
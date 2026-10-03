import { formValidation } from '@form-validation/core';
import { Trigger } from '@form-validation/plugin-trigger';
import { Bootstrap5 } from '@form-validation/plugin-bootstrap5';
import { notEmpty } from '@form-validation/validator-not-empty';
import { emailAddress } from '@form-validation/validator-email-address';
import { identical } from '@form-validation/validator-identical';
import { regexp } from '@form-validation/validator-regexp';
import Swal from 'sweetalert2'

window.FormValidation = {
    formValidation(form, options) {
        return formValidation(form, options)
            .registerValidator('notEmpty', notEmpty)
            .registerValidator('emailAddress', emailAddress)
            .registerValidator('regexp', regexp)
            .registerValidator('identical', identical)
    },
    plugins: {
        Trigger,
        Bootstrap5
    },
};

window.Swal = Swal
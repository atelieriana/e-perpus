import { formValidation } from '@form-validation/core';
import { Trigger } from '@form-validation/plugin-trigger';
import { Bootstrap5 } from '@form-validation/plugin-bootstrap5';
import { notEmpty } from '@form-validation/validator-not-empty';
import { emailAddress } from '@form-validation/validator-email-address';
import { identical } from '@form-validation/validator-identical';
import { regexp } from '@form-validation/validator-regexp';
import { init } from 'node-waves'
import {stringLength} from "@form-validation/validator-string-length";
import {digits} from "@form-validation/validator-digits";
import {between} from "@form-validation/validator-between";
import {isbn} from "@form-validation/validator-isbn";
import {greaterThan} from "@form-validation/validator-greater-than";
import {file} from "@form-validation/validator-file";

import Swal from 'sweetalert2'
import axios from 'axios';
window.FormValidation = {
    formValidation(form, options) {
        return formValidation(form, options)
            .registerValidator('notEmpty', notEmpty)
            .registerValidator('emailAddress', emailAddress)
            .registerValidator('regexp', regexp)
            .registerValidator('identical', identical)
            .registerValidator('stringLength', stringLength)
            .registerValidator('digits', digits)
            .registerValidator('between', between)
            .registerValidator('isbn', isbn)
            .registerValidator('greaterThan', greaterThan)
            .registerValidator('file', file)
    },
    plugins: {
        Trigger,
        Bootstrap5
    },
};

window.Swal = Swal

document.addEventListener('DOMContentLoaded', () => {
    init();
    $('[data-toggle="tooltip"]').tooltip()
});

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

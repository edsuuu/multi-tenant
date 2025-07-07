import './bootstrap';

window.formatMoney = formatMoney;
window.maskPhone = maskPhone;
window.documentMask = documentMask;

function formatMoney(value, maxInt) {
    if (value || Number.isInteger(value)) {
        const cleanValue = value.toString().replace(/[^\d]/g, '');

        const limitedValue = cleanValue.slice(0, maxInt);

        return limitedValue
            .replace(/(\d{1,})(\d{2})$/, '$1,$2')
            .replace(/(?=(\d{3})+(\D))\B/g, '.');
    }
    return '';
}

function maskPhone(value) {
    return value.replace(/[^0-9]/g, '').length > 10 ? '(99) 99999-9999' : '(99) 9999-9999';
}

function documentMask(value) {
    const cleanValue = value.toString().replace(/[^\d]/g, '');

    const limitedValue = cleanValue.slice(0, 14);

    if (limitedValue.length <= 11) {
        if (limitedValue.length <= 3) {
            return limitedValue;
        } else if (limitedValue.length <= 6) {
            return limitedValue.replace(/^(\d{3})(\d{0,3})/, '$1.$2');
        } else if (limitedValue.length <= 9) {
            return limitedValue.replace(/^(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
        } else {
            return limitedValue.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
        }
    } else {
        if (limitedValue.length <= 2) {
            return limitedValue;
        } else if (limitedValue.length <= 5) {
            return limitedValue.replace(/^(\d{2})(\d{0,3})/, '$1.$2');
        } else if (limitedValue.length <= 8) {
            return limitedValue.replace(/^(\d{2})(\d{3})(\d{0,3})/, '$1.$2.$3');
        } else if (limitedValue.length <= 12) {
            return limitedValue.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4})/, '$1.$2.$3/$4');
        } else {
            return limitedValue.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2})/, '$1.$2.$3/$4-$5');
        }
    }
}

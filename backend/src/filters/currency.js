export default function currencyEUR(value) {
    return new Intl.NumberFormat('nl-NL', {style: 'currency', currency: 'EUR'})
        .format(value);
}

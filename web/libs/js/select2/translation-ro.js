/**
 * Custom romanian translations for Select2.
 */
(function () {

    if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) {
        var e=jQuery.fn.select2.amd;
    }
    
    return e.define("select2/i18n/ro", [], function () {
        return {
            inputTooLong: function (args) {
                var overChars = args.input.length - args.maximum;

                return 'Va rugam sa introduceti mai putin de '
                    + (1 == overChars ? 'un caracter' : overChars + ' caractere')
                    + '!';
            },
            inputTooShort: function (args) {
                var remainingChars = args.minimum - args.input.length;

                return 'Va rugam sa introduceti inca '
                    + (1 == remainingChars ? 'un caracter' : remainingChars + ' caractere')
                    + '!';
            },
            loadingMore: function () {
                return 'Se incarca…';
            },
            maximumSelected: function (args) {
                return 'Aveti voie sa selectati cel mult '
                    + (1 == args.maximum) ? 'un caracter' : args.maximum + ' caractere'
                    + '!';
            },
            noResults: function () {
                return 'Nu a fost gasit nimic!';
            },
            searching: function () {
                return 'Cautare…';
            }
        };
    });

})();

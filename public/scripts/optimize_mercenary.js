$(window).on('load', function () {
    console.log('optimize_mercenary.js loaded');

    let runeFlat = $('input[type="text"][name="rune_fixed"]');
    let runePerc = $('input[type="text"][name="rune_percent"]');
    let mRune1stFlat = $('input[type="text"][name="mythic_rune_first_half_fixed"]');
    let mRune2ndFlat = $('input[type="text"][name="mythic_rune_second_half_fixed"]');
    let mRune1stPerc = $('input[type="text"][name="mythic_rune_first_half_percent"]');
    let mRune2ndPerc = $('input[type="text"][name="mythic_rune_second_half_percent"]');

    $('[data-target]').on('click', function (event) {
        switch ($(this).data('target')) {
            case 'rune_fixed':
                runeFlat.val($(this).data('value'));
                break;
            case 'rune_percent':
                runePerc.val($(this).data('value'));
                break;
            case 'mythic_rune_first_half_fixed':
                mRune1stFlat.val($(this).data('value'));
                break;
            case 'mythic_rune_second_half_fixed':
                mRune2ndFlat.val($(this).data('value'));
                break;
            case 'mythic_rune_first_half_percent':
                mRune1stPerc.val($(this).data('value'));
                break;
            case 'mythic_rune_second_half_percent':
                mRune2ndPerc.val($(this).data('value'));
                break;
        }
    });
});
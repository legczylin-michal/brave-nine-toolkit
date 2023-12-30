$(window).on('load', function () {
    console.log('rune_simulation.js loaded');

    let level = $('#level');

    let fstGrowthRank = $('#fst-growth-rank');
    let sndGrowthRank = $('#snd-growth-rank');
    let thrGrowthRank = $('#thr-growth-rank');

    level.on('change', function () {
        fstGrowthRank.prop('disabled', true);
        sndGrowthRank.prop('disabled', true);
        thrGrowthRank.prop('disabled', true);

        if ($(this).val() >= 3) fstGrowthRank.prop('disabled', false);
        if ($(this).val() >= 6) sndGrowthRank.prop('disabled', false);
        if ($(this).val() >= 9) thrGrowthRank.prop('disabled', false);
    });

    level.trigger('change');
});
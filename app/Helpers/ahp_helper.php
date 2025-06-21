<?php

function nilaiAHPLabel($value)
{
    $labels = [
        1 => 'Sama penting',
        2 => 'Antara 1 dan 3',
        3 => 'Sedikit lebih penting',
        4 => 'Antara 3 dan 5',
        5 => 'Cukup penting',
        6 => 'Antara 5 dan 7',
        7 => 'Sangat penting',
        8 => 'Antara 7 dan 9',
        9 => 'Ekstrem penting',
    ];

    $numeric = floatval($value);
    $labelKey = round($numeric);

    return $labels[$labelKey] ?? 'Tidak dikenal';
}

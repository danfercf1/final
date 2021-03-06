<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'Graficas';
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas', 'url' => ['estadisticas']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="graficas">

    <p class="lead">Analisis Estadistico: Rendimiento Academico</p>

    <div>
        <h4>Desviación Estándar: <?=$dev_std;?></h4>
    </div>
    <?php
    echo "<div class='division'></div>";

    echo "<div>";
    echo Highcharts::widget([
        'scripts' => [
            'modules/exporting',
            'themes/sand-signika',
        ],
        'options' => [
            'title' => ['text' => 'Aprobados por '.$atributo],
            'xAxis' => [
                'categories' => $categories
            ],
            'yAxis' => [
                'title' => ['text' => 'Cantidad de Aprobados'],
                'max'=>max($data),
            ],
            'series' => [
                [
                    'type' => 'column',
                    'name' => 'Aprobados',
                    'data' => $data,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => 360,
                        //'color' => '#FFFFFF',
                        'align' => 'center',
                        'y' => '10',
                    ],
                ],
            ]
        ]
    ]);
    echo "</div>";
    echo "<div class='division'></div>";
    echo "<div>";
    echo Highcharts::widget([
        'scripts' => [
            'modules/exporting',
            'themes/sand-signika',
        ],
        'options' => [
            'title' => ['text' => 'Media de Notas por '.$atributo],
            'xAxis' => [
                'categories' => $categories_avg
            ],
            'yAxis' => [
                'title' => ['text' => 'Notas'],
                'max'=>100,
            ],
            'series' => [
                [
                    'type' => 'column',
                    'name' => 'Notas',
                    'data' => $data_avg,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => 360,
                        //'color' => '#FFFFFF',
                        'format' => '{point.y:.1f}',
                        'align' => 'center',
                        'y' => '10',
                    ],
                ],
            ]
        ]
    ]);
    echo "</div>";

    echo "<div class='division'></div>";
    echo "<div>";
    echo Highcharts::widget([
        'scripts' => [
            'modules/exporting',
            'themes/sand-signika',
        ],
        'options' => [
            'title' => ['text' => 'Moda de Notas por '.$atributo],
            'xAxis' => [
                'categories' => $categories_mod
            ],
            'yAxis' => [
                'title' => ['text' => 'Notas'],
                'max'=>100,
            ],
            'series' => [
                [
                    'type' => 'column',
                    'name' => 'Notas',
                    'data' => $data_mod,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => 360,
                        //'color' => '#FFFFFF',
                        //'format' => '{point.y:.1f}',
                        'align' => 'center',
                        'y' => '10',
                    ],
                ],
            ]
        ]
    ]);

    echo "<div class='division'></div>";
    echo "<div>";
    echo Highcharts::widget([
        'scripts' => [
            'modules/exporting',
            'themes/sand-signika',
        ],
        'options' => [
            'title' => ['text' => 'Nota Máxima y Mínima por '.$atributo],
            'xAxis' => [
                'categories' => $categories_mod
            ],
            'yAxis' => [
                'title' => ['text' => 'Notas'],
                'max'=>100,
            ],
            'series' => [
                [
                    'type' => 'column',
                    'name' => 'Max',
                    'data' => $data_max,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => 360,
                        //'color' => '#FFFFFF',
                        //'format' => '{point.y:.1f}',
                        'align' => 'center',
                        'y' => '10',
                    ],
                ],[
                    'type' => 'column',
                    'name' => 'Min',
                    'data' => $data_min,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => 360,
                        //'color' => '#FFFFFF',
                        //'format' => '{point.y:.1f}',
                        'align' => 'center',
                        'y' => '10',
                    ],
                ],
            ]
        ]
    ]);
    echo "</div>";


    ?>

</div>

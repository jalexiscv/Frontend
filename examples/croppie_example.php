<?php

/**
 * Ejemplo de uso del componente Croppie refactorizado
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Croppie;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo: Componente Croppie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1>Ejemplos de Componente Croppie</h1>
        <p class="text-muted">Componente refactorizado según <code>COMPONENT_STANDARDS.md</code></p>

        <hr class="my-4">

        <!-- Ejemplo 1: Croppie Básico Cuadrado -->
        <section class="mb-5">
            <h2>1. Croppie Básico (Square)</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    $croppie1 = new Croppie([
                        'id' => 'croppie-square',
                        'viewport' => [
                            'width' => 400,
                            'height' => 400,
                            'type' => 'square'
                        ],
                        'boundary' => [
                            'width' => 500,
                            'height' => 500
                        ]
                    ]);

                    echo $croppie1->render();
                    ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Viewport: 400x400 (square) | Boundary: 500x500</small>
                </div>
            </div>
        </section>

        <!-- Ejemplo 2: Croppie Circular -->
        <section class="mb-5">
            <h2>2. Croppie Circular (para avatares)</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    $croppie2 = new Croppie([
                        'id' => 'croppie-circle',
                        'viewport' => [
                            'width' => 300,
                            'height' => 300,
                            'type' => 'circle'
                        ],
                        'boundary' => [
                            'width' => 400,
                            'height' => 400
                        ],
                        'output' => [
                            'width' => 600,
                            'height' => 600
                        ]
                    ]);

                    echo $croppie2->render();
                    ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Viewport: 300x300 (circle) | Output: 600x600</small>
                </div>
            </div>
        </section>

        <!-- Ejemplo 3: Croppie con Imagen Precargada -->
        <section class="mb-5">
            <h2>3. Croppie con Imagen Precargada</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    $croppie3 = new Croppie([
                        'id' => 'croppie-preloaded',
                        'image' => 'https://via.placeholder.com/800x600',
                        'viewport' => [
                            'width' => 600,
                            'height' => 400,
                            'type' => 'square'
                        ],
                        'boundary' => [
                            'width' => 700,
                            'height' => 500
                        ]
                    ]);

                    echo $croppie3->render();
                    ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Con imagen precargada | Viewport: 600x400</small>
                </div>
            </div>
        </section>

        <!-- Ejemplo 4: Configuración Personalizada -->
        <section class="mb-5">
            <h2>4. Configuración Personalizada</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    $croppie4 = new Croppie([
                        'id' => 'croppie-custom',
                        'viewport' => [
                            'width' => 400,
                            'height' => 400,
                            'type' => 'square'
                        ],
                        'boundary' => [
                            'width' => 500,
                            'height' => 500
                        ],
                        'reference' => 'USER_PROFILE',
                        'uploadUrl' => '/api/upload/profile-image',
                        'fieldName' => 'profileImage',
                        'csrfToken' => 'csrf_token_name',
                        'csrfHash' => 'sample_hash_value',
                        'assetsUrl' => '/assets/libs/croppie'
                    ]);

                    echo $croppie4->render();
                    ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Con reference, uploadUrl, CSRF y assets URL personalizados</small>
                </div>
            </div>
        </section>

        <!-- Documentación -->
        <section class="mb-5">
            <h2>Documentación</h2>
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Opciones Disponibles</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Opción</th>
                                <th>Tipo</th>
                                <th>Default</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>id</code></td>
                                <td>string</td>
                                <td>auto-generado</td>
                                <td>ID único del componente</td>
                            </tr>
                            <tr>
                                <td><code>image</code></td>
                                <td>string</td>
                                <td>null</td>
                                <td>URL de imagen a precargar</td>
                            </tr>
                            <tr>
                                <td><code>viewport</code></td>
                                <td>array</td>
                                <td>720x480, square</td>
                                <td>Dimensiones y tipo del área de recorte</td>
                            </tr>
                            <tr>
                                <td><code>boundary</code></td>
                                <td>array</td>
                                <td>740x500</td>
                                <td>Dimensiones del contenedor</td>
                            </tr>
                            <tr>
                                <td><code>output</code></td>
                                <td>array</td>
                                <td>null</td>
                                <td>Dimensiones de salida (opcional)</td>
                            </tr>
                            <tr>
                                <td><code>reference</code></td>
                                <td>string</td>
                                <td>'DEFAULT'</td>
                                <td>Referencia para identificar uploads</td>
                            </tr>
                            <tr>
                                <td><code>uploadUrl</code></td>
                                <td>string</td>
                                <td>'/storage/images/croppie'</td>
                                <td>URL para procesar el upload</td>
                            </tr>
                            <tr>
                                <td><code>fieldName</code></td>
                                <td>string</td>
                                <td>'attachment'</td>
                                <td>Nombre del campo oculto</td>
                            </tr>
                            <tr>
                                <td><code>csrfToken / csrfHash</code></td>
                                <td>string</td>
                                <td>null</td>
                                <td>Tokens CSRF si se usan</td>
                            </tr>
                            <tr>
                                <td><code>assetsUrl</code></td>
                                <td>string</td>
                                <td>'/themes/assets/libraries/croppie'</td>
                                <td>URL base para assets</td>
                            </tr>
                            <tr>
                                <td><code>includeAssets</code></td>
                                <td>bool</td>
                                <td>true</td>
                                <td>Incluir CSS/JS automáticamente</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Código de Ejemplo -->
        <section class="mb-5">
            <h2>Código de Ejemplo</h2>
            <div class="card">
                <div class="card-body">
                    <pre><code class="language-php">use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Croppie;

// Ejemplo básico
$croppie = new Croppie([
    'id' => 'my-cropper',
    'viewport' => [
        'width' => 400,
        'height' => 400,
        'type' => 'circle'  // 'square' o 'circle'
    ],
    'boundary' => [
        'width' => 500,
        'height' => 500
    ],
    'output' => [
        'width' => 800,
        'height' => 800
    ]
]);

echo $croppie->render();</code></pre>
                </div>
            </div>
        </section>

        <div class="alert alert-info">
            <strong>Nota:</strong> Este componente cumple 100% con <code>COMPONENT_STANDARDS.md</code>:
            <ul class="mb-0 mt-2">
                <li>✅ Usa <code>declare(strict_types=1)</code></li>
                <li>✅ Namespace correcto</li>
                <li>✅ Implementa <code>ComponentInterface</code></li>
                <li>✅ Extiende <code>AbstractComponent</code></li>
                <li>✅ Usa <code>render(): TagInterface</code></li>
                <li>✅ Genera HTML con <code>Html::tag()</code></li>
                <li>✅ Constructor con array de opciones</li>
                <li>✅ Validación de opciones</li>
                <li>✅ Sin dependencias de funciones globales</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
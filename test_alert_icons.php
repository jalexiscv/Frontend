<?php

/**
 * Test: Alert con Iconos según Bootstrap 5.3
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Alert;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test: Alert con Iconos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap Icons SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
</head>

<body>
    <div class="container my-5">
        <h1>Test: Alert con Iconos</h1>
        <p class="text-muted">Verificando soporte de iconos en componente Alert según Bootstrap 5.3</p>

        <hr class="my-4">

        <!-- Test 1: Font Awesome Icons -->
        <section class="mb-5">
            <h2>1. Font Awesome Icons</h2>

            <?php
            $alertSuccess = new Alert([
                'type' => 'success',
                'icon' => 'fas fa-check-circle',
                'content' => 'Operación completada exitosamente con icono de Font Awesome'
            ]);
            echo $alertSuccess->render();
            ?>

            <div class="mt-3">
                <?php
                $alertDanger = new Alert([
                    'type' => 'danger',
                    'icon' => 'fas fa-exclamation-triangle',
                    'content' => 'Error: Algo salió mal'
                ]);
                echo $alertDanger->render();
                ?>
            </div>

            <div class="mt-3">
                <?php
                $alertWarning = new Alert([
                    'type' => 'warning',
                    'icon' => 'fas fa-exclamation-circle',
                    'content' => 'Advertencia: Revisa los datos antes de continuar'
                ]);
                echo $alertWarning->render();
                ?>
            </div>

            <div class="mt-3">
                <?php
                $alertInfo = new Alert([
                    'type' => 'info',
                    'icon' => 'fas fa-info-circle',
                    'content' => 'Información: El sistema se actualizará pronto'
                ]);
                echo $alertInfo->render();
                ?>
            </div>
        </section>

        <!-- Test 2: Bootstrap Icons (SVG) -->
        <section class="mb-5">
            <h2>2. Bootstrap Icons (SVG)</h2>

            <?php
            $svgSuccess = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"></use></svg>';
            $alertSvgSuccess = new Alert([
                'type' => 'success',
                'icon' => $svgSuccess,
                'content' => 'An example success alert with an icon'
            ]);
            echo $alertSvgSuccess->render();
            ?>

            <div class="mt-3">
                <?php
                $svgInfo = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"></use></svg>';
                $alertSvgInfo = new Alert([
                    'type' => 'primary',
                    'icon' => $svgInfo,
                    'content' => 'An example alert with an icon'
                ]);
                echo $alertSvgInfo->render();
                ?>
            </div>

            <div class="mt-3">
                <?php
                $svgWarning = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"></use></svg>';
                $alertSvgWarning = new Alert([
                    'type' => 'warning',
                    'icon' => $svgWarning,
                    'content' => 'An example warning alert with an icon'
                ]);
                echo $alertSvgWarning->render();
                ?>
            </div>

            <div class="mt-3">
                <?php
                $svgDanger = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"></use></svg>';
                $alertSvgDanger = new Alert([
                    'type' => 'danger',
                    'icon' => $svgDanger,
                    'content' => 'An example danger alert with an icon'
                ]);
                echo $alertSvgDanger->render();
                ?>
            </div>
        </section>

        <!-- Test 3: Con htmlContent -->
        <section class="mb-5">
            <h2>3. Icono + htmlContent</h2>

            <?php
            $alertHtml = new Alert([
                'type' => 'success',
                'icon' => 'fas fa-check-circle',
                'htmlContent' => '<strong>¡Pedido confirmado!</strong><br>
                    Tu pedido #12345 ha sido procesado correctamente. 
                    <a href="#" class="alert-link">Ver detalles</a>',
                'dismissible' => true
            ]);
            echo $alertHtml->render();
            ?>
        </section>

        <!-- Test 4: Dismissible con Icono -->
        <section class="mb-5">
            <h2>4. Dismissible + Icono</h2>

            <?php
            $alertDismissible = new Alert([
                'type' => 'info',
                'icon' => 'fas fa-bell',
                'content' => 'Esta notificación se puede cerrar',
                'dismissible' => true
            ]);
            echo $alertDismissible->render();
            ?>
        </section>

        <!-- Test 5: Sin Icono (Comparación) -->
        <section class="mb-5">
            <h2>5. Sin Icono (Comparación)</h2>

            <?php
            $alertNoIcon = new Alert([
                'type' => 'secondary',
                'content' => 'Alert sin icono para comparar (comportamiento normal)'
            ]);
            echo $alertNoIcon->render();
            ?>
        </section>

        <!-- Verificación HTML -->
        <section class="mb-5">
            <h2>Verificación del HTML Generado</h2>
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">HTML Esperado</h5>
                </div>
                <div class="card-body">
                    <pre><code>&lt;div class="alert alert-primary d-flex align-items-center" role="alert"&gt;
  &lt;i class="fas fa-info-circle flex-shrink-0 me-2" aria-hidden="true"&gt;&lt;/i&gt;
  &lt;div&gt;
    Contenido del alert
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>
        </section>

        <div class="alert alert-success">
            <strong>✅ Tests completados</strong><br>
            Si todos los alerts arriba muestran iconos correctamente alineados, el componente funciona bien.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
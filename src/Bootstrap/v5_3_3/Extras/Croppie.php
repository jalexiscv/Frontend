<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente Croppie de Bootstrap 5.3.3
 * 
 * Integración completa de la librería Croppie.js para recortar imágenes
 * con modal, controles de zoom/rotación y upload AJAX.
 * 
 * Opciones disponibles:
 * - 'id': string - ID único del componente [default: generado automáticamente]
 * - 'oid': string|int - Object ID para identificar el objeto asociado [default: 0]
 * - 'image': string - URL de la imagen a cargar [default: imagen placeholder]
 * - 'viewport': array - Dimensiones del viewport de recorte [default: ['width' => 720, 'height' => 480, 'type' => 'square']]
 * - 'boundary': array - Dimensiones del contenedor boundary [default: ['width' => 740, 'height' => 500]]
 * - 'output': array - Dimensiones de salida [default: ['width' => null, 'height' => null]]
 * - 'reference': string - Referencia para identificar el upload [default: 'DEFAULT']
 * - 'uploadUrl': string - URL para procesar el upload [default: '/storage/images/croppie/{oid}']
 * - 'fieldName': string - Nombre del campo del formulario [default: 'attachment']
 * - 'csrfToken': string - Nombre del token CSRF si se usa [default: null]
 * - 'csrfHash': string - Hash CSRF si se usa [default: null]
 * - 'assetsUrl': string - URL base para assets de croppie [default: '/themes/assets/libraries/croppie']
 * - 'includeAssets': bool - Si debe incluir assets de croppie [default: true]
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @implements ComponentInterface
 * 
 * @example
 * new Croppie([
 *     'id' => 'photo-cropper',
 *     'image' => '/path/to/image.jpg',
 *     'viewport' => ['width' => 400, 'height' => 400, 'type' => 'circle'],
 *     'output' => ['width' => 800, 'height' => 800]
 * ]);
 */
class Croppie extends AbstractComponent implements ComponentInterface
{
    private string $id;
    private string $oid = '0';
    private ?string $image = null;
    private string $reference = 'DEFAULT';
    private string $uploadUrl = '/storage/images/croppie';
    private string $fieldName = 'attachment';
    private ?string $csrfToken = null;
    private ?string $csrfHash = null;
    private string $assetsUrl = '/themes/assets/libraries/croppie';
    private bool $includeAssets = true;
    private array $attributes = [];

    // Viewport
    private int $viewportWidth = 720;
    private int $viewportHeight = 480;
    private string $viewportType = 'square';

    // Boundary
    private int $boundaryWidth = 740;
    private int $boundaryHeight = 500;

    // Output
    private ?int $outputWidth = null;
    private ?int $outputHeight = null;

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? 'croppie_' . uniqid();
        $this->oid = (string)($options['oid'] ?? '0');

        if (isset($options['image'])) {
            $this->image = $options['image'];
        }

        if (isset($options['viewport'])) {
            if (isset($options['viewport']['width'])) {
                $this->viewportWidth = (int)$options['viewport']['width'];
            }
            if (isset($options['viewport']['height'])) {
                $this->viewportHeight = (int)$options['viewport']['height'];
            }
            if (isset($options['viewport']['type'])) {
                $this->viewportType = $options['viewport']['type'];
            }
        }

        if (isset($options['boundary'])) {
            if (isset($options['boundary']['width'])) {
                $this->boundaryWidth = (int)$options['boundary']['width'];
            }
            if (isset($options['boundary']['height'])) {
                $this->boundaryHeight = (int)$options['boundary']['height'];
            }
        }

        if (isset($options['output'])) {
            if (isset($options['output']['width'])) {
                $this->outputWidth = (int)$options['output']['width'];
            }
            if (isset($options['output']['height'])) {
                $this->outputHeight = (int)$options['output']['height'];
            }
        }

        if (isset($options['reference'])) {
            $this->reference = $options['reference'];
        }

        if (isset($options['uploadUrl'])) {
            $this->uploadUrl = $options['uploadUrl'];
        } else {
            // Si no se especifica URL, usar la por defecto con oid
            $this->uploadUrl = "/storage/images/croppie/{$this->oid}";
        }

        if (isset($options['fieldName'])) {
            $this->fieldName = $options['fieldName'];
        }

        if (isset($options['csrfToken'])) {
            $this->csrfToken = $options['csrfToken'];
        }
        if (isset($options['csrfHash'])) {
            $this->csrfHash = $options['csrfHash'];
        }

        if (isset($options['assetsUrl'])) {
            $this->assetsUrl = $options['assetsUrl'];
        }

        if (isset($options['includeAssets'])) {
            $this->includeAssets = (bool)$options['includeAssets'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->validate();
    }

    private function validate(): void
    {
        $validTypes = ['square', 'circle'];
        if (!in_array($this->viewportType, $validTypes)) {
            throw new \InvalidArgumentException(
                "Croppie: viewport type debe ser 'square' o 'circle', recibido: '{$this->viewportType}'"
            );
        }

        if ($this->viewportWidth < 1 || $this->viewportHeight < 1) {
            throw new \InvalidArgumentException(
                'Croppie: viewport width y height deben ser mayores a 0'
            );
        }

        if ($this->boundaryWidth < $this->viewportWidth) {
            throw new \InvalidArgumentException(
                'Croppie: boundary width debe ser mayor o igual que viewport width'
            );
        }

        if ($this->boundaryHeight < $this->viewportHeight) {
            throw new \InvalidArgumentException(
                'Croppie: boundary height debe ser mayor o igual que viewport height'
            );
        }
    }

    public function render(): TagInterface
    {
        $container = Html::tag('div', $this->attributes);
        $elements = [];

        if ($this->includeAssets) {
            $elements[] = $this->createAssets();
        }

        $elements[] = $this->createImageDisplay();
        $elements[] = $this->createModal();
        $elements[] = $this->createScript();

        $container->content($elements);
        return $container;
    }

    private function createAssets(): TagInterface
    {
        $wrapper = Html::tag('div');
        $assets = [];

        $css = Html::tag('link', [
            'rel' => 'stylesheet',
            'href' => $this->assetsUrl . '/croppie.css',
            'type' => 'text/css'
        ]);
        $assets[] = $css;

        $js = Html::tag('script', [
            'type' => 'text/javascript',
            'src' => $this->assetsUrl . '/croppie.js?v=' . time()
        ]);
        $assets[] = $js;

        $wrapper->content($assets);
        return $wrapper;
    }

    private function createImageDisplay(): TagInterface
    {
        $displayContainer = Html::tag('div', [
            'class' => 'position-relative d-inline-block'
        ]);

        $elements = [];

        $defaultImage = $this->image ?: '/themes/assets/images/empty-720x480.png';
        $img = Html::tag('img', [
            'src' => $defaultImage,
            'id' => 'profile-pic-' . $this->id,
            'class' => 'img-fluid rounded shadow-sm',
            'alt' => 'Profile Picture',
            'style' => 'max-width: 100%; height: auto;'
        ]);
        $elements[] = $img;

        $inputGroup = Html::tag('div', ['class' => 'croppie-input-group']);
        $inputGroupElements = [];

        $hiddenInput = Html::tag('input', [
            'type' => 'hidden',
            'id' => $this->id,
            'name' => $this->id
        ]);
        $inputGroupElements[] = $hiddenInput;

        $fileInput = Html::tag('input', [
            'type' => 'file',
            'class' => 'croppie-file-input file-input',
            'id' => $this->id . '-cropper',
            'name' => $this->id . '-cropper',
            'hidden' => 'hidden'
        ]);
        $inputGroupElements[] = $fileInput;

        $cameraIcon = Html::tag('i', ['class' => 'fas fa-camera text-dark']);
        $cameraBtn = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn btn-light btn-sm position-absolute top-0 end-0 m-2 shadow rounded-circle btn-file-' . $this->id,
            'title' => 'Cambiar foto'
        ]);
        $cameraBtn->content($cameraIcon);
        $inputGroupElements[] = $cameraBtn;

        $inputGroup->content($inputGroupElements);
        $elements[] = $inputGroup;

        $displayContainer->content($elements);
        return $displayContainer;
    }

    private function createModal(): TagInterface
    {
        $modal = Html::tag('div', [
            'class' => 'modal fade',
            'id' => 'croppie-modal-' . $this->id,
            'tabindex' => '-1',
            'role' => 'dialog',
            'aria-hidden' => 'true'
        ]);

        $modalDialog = Html::tag('div', [
            'class' => 'modal-dialog modal-lg modal-dialog-centered',
            'role' => 'document'
        ]);

        $modalContent = Html::tag('div', ['class' => 'modal-content shadow-lg']);
        $modalElements = [];

        $modalElements[] = $this->createModalHeader();
        $modalElements[] = $this->createModalBody();
        $modalElements[] = $this->createModalFooter();

        $modalContent->content($modalElements);
        $modalDialog->content($modalContent);
        $modal->content($modalDialog);

        return $modal;
    }

    private function createModalHeader(): TagInterface
    {
        $header = Html::tag('div', ['class' => 'modal-header py-2']);
        $elements = [];

        $title = Html::tag('h6', ['class' => 'modal-title fw-bold']);
        $title->content('Recortar imagen y subir');
        $elements[] = $title;

        $closeBtn = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn-close btn-sm',
            'data-bs-dismiss' => 'modal',
            'aria-label' => 'Close'
        ]);
        $elements[] = $closeBtn;

        $header->content($elements);
        return $header;
    }

    private function createModalBody(): TagInterface
    {
        $body = Html::tag('div', [
            'class' => 'modal-body p-0 bg-dark d-flex justify-content-center align-items-center',
            'style' => 'min-height: 400px;'
        ]);

        $resizerDiv = Html::tag('div', [
            'id' => 'resizer-' . $this->id
        ]);

        $body->content($resizerDiv);
        return $body;
    }

    /**
     * Crea el footer del modal con controles de zoom/rotación y botón upload
     */
    private function createModalFooter(): TagInterface
    {
        $footer = Html::tag('div', [
            'class' => 'modal-footer py-2 justify-content-between bg-light'
        ]);

        $footerElements = [];

        // Controles izquierda
        $controlsWrapper = Html::tag('div', ['class' => 'd-flex']);
        $controls = [];

        // Grupo rotación
        $rotateGroup = Html::tag('div', ['class' => 'btn-group me-2', 'role' => 'group']);
        $rotateButtons = [];

        $rotateLeftIcon = Html::tag('i', ['class' => 'fas fa-undo']);
        $rotateLeft = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn btn-outline-secondary rotate-' . $this->id,
            'data-deg' => '90',
            'title' => 'Rotate Left'
        ]);
        $rotateLeft->content($rotateLeftIcon);
        $rotateButtons[] = $rotateLeft;

        $rotateRightIcon = Html::tag('i', ['class' => 'fas fa-redo']);
        $rotateRight = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn btn-outline-secondary rotate-' . $this->id,
            'data-deg' => '-90',
            'title' => 'Rotate Right'
        ]);
        $rotateRight->content($rotateRightIcon);
        $rotateButtons[] = $rotateRight;

        $rotateGroup->content($rotateButtons);
        $controls[] = $rotateGroup;

        // Grupo zoom
        $zoomGroup = Html::tag('div', ['class' => 'btn-group', 'role' => 'group']);
        $zoomButtons = [];

        $zoomOutIcon = Html::tag('i', ['class' => 'fas fa-search-minus']);
        $zoomOut = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn btn-outline-secondary zoom-out-' . $this->id,
            'title' => 'Zoom Out'
        ]);
        $zoomOut->content($zoomOutIcon);
        $zoomButtons[] = $zoomOut;

        $zoomInIcon = Html::tag('i', ['class' => 'fas fa-search-plus']);
        $zoomIn = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn btn-outline-secondary zoom-in-' . $this->id,
            'title' => 'Zoom In'
        ]);
        $zoomIn->content($zoomInIcon);
        $zoomButtons[] = $zoomIn;

        $zoomGroup->content($zoomButtons);
        $controls[] = $zoomGroup;

        $controlsWrapper->content($controls);
        $footerElements[] = $controlsWrapper;

        // Botón upload derecha
        $uploadIcon = Html::tag('i', ['class' => 'fas fa-cloud-upload-alt me-2']);
        $uploadBtn = Html::tag('button', [
            'id' => 'croppie-upload-' . $this->id,
            'class' => 'btn btn-primary px-4'
        ]);
        $uploadBtn->content([$uploadIcon, 'Recortar y subir']);
        $footerElements[] = $uploadBtn;

        $footer->content($footerElements);
        return $footer;
    }

    private function createScript(): TagInterface
    {
        $outputWidth = $this->outputWidth ? $this->outputWidth : 'null';
        $outputHeight = $this->outputHeight ? $this->outputHeight : 'null';
        $csrfName = $this->csrfToken ? $this->csrfToken : '';
        $csrfHash = $this->csrfHash ? $this->csrfHash : '';

        $scriptContent = <<<JAVASCRIPT
document.addEventListener('DOMContentLoaded', function() {
    const id = "{$this->id}";
    const oid = "{$this->oid}";
    const uploadUrl = "{$this->uploadUrl}";
    const csrfName = "{$csrfName}";
    const csrfHash = "{$csrfHash}";
    const fieldName = "{$this->fieldName}";
    const reference = "{$this->reference}";
    const outputWidth = {$outputWidth};
    const outputHeight = {$outputHeight};

    const fileInput = document.getElementById(`\${id}-cropper`);
    const uploadBtn = document.getElementById(`croppie-upload-\${id}`);
    const modalElement = document.getElementById(`croppie-modal-\${id}`);
    const resizer = document.getElementById(`resizer-\${id}`);
    const profilePic = document.getElementById(`profile-pic-\${id}`);
    const resultInput = document.getElementById(id);
    
    let croppieInstance = null;
    let modal = null;

    const btnFile = document.querySelector(`.btn-file-\${id}`);
    if(btnFile){
        btnFile.addEventListener('click', () => fileInput.click());
    }

    if (typeof window.base64ImageToBlob === 'undefined') {
        window.base64ImageToBlob = function(str) {
            const pos = str.indexOf(';base64,');
            const type = str.substring(5, pos);
            const b64 = str.substr(pos + 8);
            const imageContent = atob(b64);
            const buffer = new ArrayBuffer(imageContent.length);
            const view = new Uint8Array(buffer);
            for (let n = 0; n < imageContent.length; n++) {
                view[n] = imageContent.charCodeAt(n);
            }
            return new Blob([buffer], { type: type });
        };
    }

    const readFile = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if(croppieInstance) croppieInstance.bind({ url: e.target.result });
            }
            reader.readAsDataURL(input.files[0]);
        }
    };

    if(fileInput){
        fileInput.addEventListener('change', function(event) {
            if (!modal) modal = new bootstrap.Modal(modalElement);
            modal.show();
            
            setTimeout(() => {
                if (!croppieInstance) {
                    croppieInstance = new Croppie(resizer, {
                        viewport: {
                            width: {$this->viewportWidth},
                            height: {$this->viewportHeight},
                            type: '{$this->viewportType}'
                        },
                        boundary: {
                            width: {$this->boundaryWidth},
                            height: {$this->boundaryHeight}
                        },
                        enableZoom: true,
                        mouseWheelZoom: 'ctrl',
                        showZoomer: false,
                        enableOrientation: true,
                        enableExif: true,
                        enforceBoundary: true
                    });
                }
                readFile(event.target);
            }, 200);
        });
    }

    document.querySelectorAll(`.rotate-\${id}`).forEach(btn => {
        btn.addEventListener('click', function() {
            if (croppieInstance) croppieInstance.rotate(parseInt(this.dataset.deg));
        });
    });

    const zoomStep = 0.1;
    const btnZoomIn = document.querySelector(`.zoom-in-\${id}`);
    const btnZoomOut = document.querySelector(`.zoom-out-\${id}`);

    if(btnZoomIn) {
        btnZoomIn.addEventListener('click', () => {
            if(croppieInstance) {
                let info = croppieInstance.get();
                croppieInstance.setZoom(info.zoom + zoomStep);
            }
        });
    }

    if(btnZoomOut) {
        btnZoomOut.addEventListener('click', () => {
            if(croppieInstance) {
                let info = croppieInstance.get();
                croppieInstance.setZoom(info.zoom - zoomStep);
            }
        });
    }

    if(uploadBtn){
        uploadBtn.addEventListener('click', function() {
            if (!croppieInstance) return;
            let resultOptions = { type: 'base64' };
            if (outputWidth && outputHeight) {
                resultOptions.size = { width: outputWidth, height: outputHeight };
            } else {
                resultOptions.size = 'viewport';
            }
            croppieInstance.result(resultOptions).then(function(base64) {
                modal.hide();
                profilePic.src = "/themes/assets/images/preloader.gif";
                const formData = new FormData();
                if (csrfName && csrfHash) formData.append(csrfName, csrfHash);
                formData.append("field", "attachment");
                formData.append("object", oid);
                formData.append("reference", reference);
                formData.append(fieldName, window.base64ImageToBlob(base64));
                fetch(uploadUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.text())
                .then(response => {
                    if (response === "error") {
                        profilePic.src = "/themes/assets/images/empty-720x480.png";
                    } else {
                        profilePic.src = base64;
                        resultInput.value = response;
                    }
                })
                .catch(err => {
                    console.error(err);
                    profilePic.src = "/themes/assets/images/empty-720x480.png";
                });
            });
        });
    }

    if(modalElement){
        modalElement.addEventListener('hidden.bs.modal', function() {
            if (croppieInstance) {
                croppieInstance.destroy();
                croppieInstance = null;
            }
            fileInput.value = '';
        });
    }
});
JAVASCRIPT;

        $script = Html::tag('script', ['type' => 'text/javascript']);
        $script->content(Html::raw($scriptContent));

        return $script;
    }
}

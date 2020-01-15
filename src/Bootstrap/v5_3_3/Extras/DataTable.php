<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente DataTable de Bootstrap 5.3.3
 *
 * Componente para mostrar una tabla de datos interactiva con buscador, paginación
 * y ordenamiento estático con renderizado del lado del servidor (SSR) mediante navegación paramétrica (State via URL GET).
 *
 * Opciones:
 * - 'id': string - Identificador único de la tabla. Autogenerado si no se provee.
 * - 'columns': array - Definición de las columnas. Puede ser ['clave' => 'Título'] o ['clave' => ['title' => 'Título', 'class' => 'text-center']]
 * - 'data': array - Array asociativo con los datos. Puede ser ['clave' => 'valor'] o ['clave' => ['value' => 'valor', 'class' => 'text-danger', 'style' => 'color: red;']]
 * - 'searchable': bool - Mostrar u ocultar el input de búsqueda. [default: true]
 * - 'pagination': bool - Mostrar u ocultar paginación. [default: true]
 * - 'perPage': int - Cantidad de registros por página por defecto [default: 10]
 * - 'perPageOptions': array - Opciones de registros por página [default: [10, 25, 50, 100]]
 * - 'attributes': array - Atributos HTML adicionales para el contenedor principal
 * - 'tableAttributes': array - Atributos HTML adicionales para la tabla (e.g. ['class' => 'table-sm'])
 * - 'columnStyles': array - Estilos CSS para las columnas ['clave' => 'text-center', ...] (preferible definir class dentro de columns)
 *
 * Opciones para Paginación del Lado del Servidor (Server-Side Pagination):
 * - 'serverSide': bool - Habilita paginación del lado del servidor [default: false]
 * - 'totalRecords': int - Total de registros en la base de datos (requerido si serverSide es true)
 * - 'currentPage': int - Página actual (requerido si serverSide es true) [default: 1]
 *
 * @implements ComponentInterface
 */
class DataTable extends AbstractComponent implements ComponentInterface
{
    private string $id;
    private array $columns = [];
    private array $data = [];
    private bool $searchable;
    private bool $pagination;
    private int $perPage;
    private array $perPageOptions;

    private array $attributes = [];
    private array $tableAttributes = [];
    private array $columnStyles = [];

    // Server-Side Pagination
    private bool $serverSide;
    private int $totalRecords;
    private int $currentPage;

    /**
     * Constructor
     *
     * @param array $options Array de opciones de configuración
     */
    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? 'datatable_' . uniqid();
        
        $rawColumns = $options['columns'] ?? [];
        $this->columns = [];
        foreach ($rawColumns as $key => $colConfig) {
            if (is_array($colConfig)) {
                $this->columns[$key] = (string)($colConfig['title'] ?? $key);
                if (isset($colConfig['class'])) {
                    $this->columnStyles[$key] = (string)$colConfig['class'];
                }
            } else {
                $this->columns[$key] = (string)$colConfig;
            }
        }

        $this->data = $options['data'] ?? [];

        $this->searchable = $options['searchable'] ?? true;
        $this->pagination = $options['pagination'] ?? true;

        $this->perPage = $options['perPage'] ?? 10;
        $this->perPageOptions = $options['perPageOptions'] ?? [10, 25, 50, 100];

        // Server-Side Pagination
        $this->serverSide = $options['serverSide'] ?? false;
        $this->totalRecords = $options['totalRecords'] ?? 0;
        $this->currentPage = $options['currentPage'] ?? 1;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        if (isset($options['tableAttributes']) && is_array($options['tableAttributes'])) {
            $this->tableAttributes = $options['tableAttributes'];
        }

        if (isset($options['columnStyles']) && is_array($options['columnStyles'])) {
            $this->columnStyles = array_merge($this->columnStyles, $options['columnStyles']);
        }
    }

    /**
     * Renderiza el componente
     * 
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['class'] = $this->mergeClasses(
            'datatable-container w-100',
            $this->attributes['class'] ?? null
        );

        $container = Html::tag('div', $this->attributes);
        $contents = [];

        // Resolucion de parametros GET
        $search = $_GET['search'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = (int)($_GET['per_page'] ?? $this->perPage);
        $sort = $_GET['sort'] ?? null;
        $dir = $_GET['dir'] ?? 'asc';

        // Determinar si se usa paginación del lado del servidor o cliente
        if ($this->serverSide) {
            // SERVER-SIDE PAGINATION: Los datos ya vienen filtrados y paginados desde el servidor
            $pageData = $this->data;
            $total = $this->totalRecords;
            $page = $this->currentPage;
            $totalPages = (int)ceil($total / $perPage);

            $start = ($page - 1) * $perPage;
            $startCount = $total > 0 ? $start + 1 : 0;
            $endCount = min($start + count($pageData), $total);
        } else {
            // CLIENT-SIDE PAGINATION: Filtrado, ordenamiento y paginación en el cliente
            $filteredData = $this->data;

            // 1. Filtrado por busqueda
            if ($search !== '') {
                $filteredData = array_filter($filteredData, function($row) use ($search) {
                    foreach ($this->columns as $col => $title) {
                        $val = $row[$col] ?? null;
                        if (is_array($val) && isset($val['value'])) {
                            $val = $val['value'];
                        }
                        if ($val !== null && stripos(strip_tags((string)$val), $search) !== false) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            // 2. Ordenamiento
            if ($sort && isset($this->columns[$sort])) {
                usort($filteredData, function($a, $b) use ($sort, $dir) {
                    $valA = $a[$sort] ?? '';
                    if (is_array($valA) && isset($valA['value'])) {
                        $valA = $valA['value'];
                    }

                    $valB = $b[$sort] ?? '';
                    if (is_array($valB) && isset($valB['value'])) {
                        $valB = $valB['value'];
                    }

                    if ($valA == $valB) return 0;

                    $cleanA = strip_tags((string)$valA);
                    $cleanB = strip_tags((string)$valB);

                    if (is_numeric($cleanA) && is_numeric($cleanB)) {
                        $compare = $cleanA <=> $cleanB;
                    } else {
                        $compare = strnatcasecmp($cleanA, $cleanB);
                    }

                    return $dir === 'desc' ? -$compare : $compare;
                });
            }

            // 3. Paginacion
            $total = count($filteredData);
            $totalPages = (int)ceil($total / $perPage);
            if ($page > $totalPages && $totalPages > 0) {
                $page = $totalPages;
            }

            $start = ($page - 1) * $perPage;
            $pageData = array_slice($filteredData, $start, $perPage);

            $startCount = $total > 0 ? $start + 1 : 0;
            $endCount = min($start + $perPage, $total);
        }

        // Controles Superiores (Busqueda y Paginacion Select)
        $topControls = $this->renderTopControls($search, $perPage);
        if ($topControls) {
            $contents[] = $topControls;
        }

        // Tabla
        $tableWrapper = Html::tag('div', ['class' => 'table-responsive']);
        
        $tableClasses = 'table table-bordered table-hover mb-0';
        $this->tableAttributes['class'] = $this->mergeClasses(
            $tableClasses,
            $this->tableAttributes['class'] ?? null
        );
        $this->tableAttributes['id'] = $this->id . '_table';
        
        $table = Html::tag('table', $this->tableAttributes);
        
        // Thead
        $thead = Html::tag('thead');
        $trHead = Html::tag('tr');
        foreach ($this->columns as $key => $title) {
            $thClass = 'align-middle';
            if (isset($this->columnStyles[$key])) {
                $thClass = $this->mergeClasses($thClass, $this->columnStyles[$key]);
            }
            $th = Html::tag('th', ['scope' => 'col', 'class' => $thClass]);
            
            $queryParams = $_GET;
            $newDir = 'asc';
            $icon = '↕';
            // Si ya estamos ordenando por esta columna, cambiamos la direccion
            if ($sort === $key) {
                if ($dir === 'asc') {
                    $newDir = 'desc';
                    $icon = '↑';
                } else {
                    $newDir = 'asc';
                    $icon = '↓';
                }
            }
            $queryParams['sort'] = $key;
            $queryParams['dir'] = $newDir;
            $queryParams['page'] = 1; // Reiniciar pagina al ordenar
            
            $queryString = http_build_query($queryParams);
            $url = '?' . $queryString;
            
            $link = Html::tag('a', [
                'href' => $url,
                'class' => 'text-decoration-none text-dark d-block'
            ], [
                $title,
                Html::tag('span', ['class' => 'ms-1 text-muted small'], $icon)
            ]);
            
            $th->content($link);
            $trHead->addChild($th);
        }
        $thead->content($trHead);
        
        // Tbody
        $tbody = Html::tag('tbody');
        if (empty($pageData)) {
            $tr = Html::tag('tr');
            $td = Html::tag('td', [
                'colspan' => (string)count($this->columns),
                'class' => 'text-center text-muted py-3'
            ], 'No se encontraron registros.');
            $tr->content($td);
            $tbody->addChild($tr);
        } else {
            foreach ($pageData as $row) {
                $tr = Html::tag('tr');
                foreach ($this->columns as $colKey => $colTitle) {
                    $tdClass = 'align-middle';
                    $val = $row[$colKey] ?? '';
                    $tdStyle = null;

                    if (is_array($val) && isset($val['value'])) {
                        // Si el tbody tiene clase, respetarla. Si no, usar la del header
                        if (isset($val['class'])) {
                            $tdClass = $this->mergeClasses($tdClass, (string)$val['class']);
                        } elseif (isset($this->columnStyles[$colKey])) {
                            $tdClass = $this->mergeClasses($tdClass, $this->columnStyles[$colKey]);
                        }
                        if (isset($val['style'])) {
                            $tdStyle = (string)$val['style'];
                        }
                        $val = $val['value'];
                    } else {
                        // Si no es un array con valor, usar la clase del header si existe
                        if (isset($this->columnStyles[$colKey])) {
                            $tdClass = $this->mergeClasses($tdClass, $this->columnStyles[$colKey]);
                        }
                    }

                    $tdAttrs = ['class' => $tdClass];
                    if ($tdStyle) {
                        $tdAttrs['style'] = $tdStyle;
                    }

                    $td = Html::tag('td', $tdAttrs);

                    if ($val !== null && $val !== '') {
                        $td->content(Html::raw((string)$val));
                    }
                    $tr->addChild($td);
                }
                $tbody->addChild($tr);
            }
        }
        
        $table->content([$thead, $tbody]);
        $tableWrapper->content($table);
        $contents[] = $tableWrapper;

        // Controles Inferiores (Información y Paginador Ul)
        if ($this->pagination) {
            $botControls = $this->renderBottomControls($page, $totalPages, $total, $perPage, $startCount, $endCount);
            if ($botControls) {
                $contents[] = $botControls;
            }
        }
        
        $container->content($contents);
        
        // Estilos minimos
        $style = Html::tag('style', [], "
            #{$this->id} .text-dark:hover { color: #0d6efd !important; }
        ");
        $container->addChild($style);
        
        return $container;
    }

    private function renderTopControls(string $search, int $perPage): ?TagInterface
    {
        if (!$this->searchable && !$this->pagination) {
            return null;
        }

        $form = Html::tag('form', ['method' => 'GET', 'action' => '', 'class' => 'mb-3']);
        
        $preserveParams = $_GET;
        unset($preserveParams['search'], $preserveParams['per_page'], $preserveParams['page']);
        $this->addHiddenInputs($form, $preserveParams);

        $row = Html::tag('div', ['class' => 'row align-items-center']);
        
        if ($this->pagination) {
            $colSelect = Html::tag('div', ['class' => 'col-auto me-auto']);
            $selectWrap = Html::tag('div', ['class' => 'd-flex align-items-center']);
            $selectWrap->addChild(Html::tag('label', ['class' => 'me-2 small text-muted'], 'Mostrar'));
            
            $select = Html::tag('select', [
                'name' => 'per_page',
                'class' => 'form-select form-select-sm w-auto d-inline-block',
                'onchange' => 'this.form.submit()'
            ]);
            foreach ($this->perPageOptions as $opt) {
                $attrs = ['value' => (string)$opt];
                if ($opt === $perPage) {
                    $attrs['selected'] = 'selected';
                }
                $select->addChild(Html::tag('option', $attrs, (string)$opt));
            }
            
            $selectWrap->addChild($select);
            $selectWrap->addChild(Html::tag('label', ['class' => 'ms-2 small text-muted'], 'registros'));
            $colSelect->content($selectWrap);
            $row->addChild($colSelect);
        } else {
             $row->addChild(Html::tag('div', ['class' => 'col-auto me-auto'])); // Spacer
        }

        if ($this->searchable) {
            $colSearch = Html::tag('div', ['class' => 'col-auto']);
            $searchWrap = Html::tag('div', ['class' => 'input-group input-group-sm']);
            $searchWrap->addChild(Html::tag('span', ['class' => 'input-group-text bg-transparent'], '🔍'));
            $searchWrap->addChild(Html::tag('input', [
                'type' => 'search',
                'name' => 'search',
                'value' => $search,
                'class' => 'form-control',
                'placeholder' => 'Buscar...',
                'aria-label' => 'Buscar'
            ]));
            $searchWrap->addChild(Html::tag('button', [
                'type' => 'submit',
                'class' => 'btn btn-outline-secondary'
            ], 'Buscar'));
            
            $colSearch->content($searchWrap);
            $row->addChild($colSearch);
        }

        $form->addChild($row);
        return $form;
    }

    private function addHiddenInputs(TagInterface $form, array $params, string $prefix = ''): void
    {
        foreach ($params as $key => $value) {
            $name = $prefix === '' ? (string)$key : $prefix . '[' . $key . ']';
            if (is_array($value)) {
                $this->addHiddenInputs($form, $value, $name);
            } else {
                $form->addChild(Html::tag('input', ['type' => 'hidden', 'name' => $name, 'value' => (string)$value]));
            }
        }
    }

    private function renderBottomControls(int $page, int $totalPages, int $total, int $perPage, int $startCount, int $endCount): ?TagInterface
    {
        if ($total === 0) {
            return null; // Don't show if there are no results
        }
        
        $row = Html::tag('div', ['class' => 'row mt-3 align-items-center']);
        
        // Información de registros
        $colInfo = Html::tag('div', ['class' => 'col-sm-12 col-md-5 mb-2 mb-md-0']);
        $colInfo->content(Html::tag('div', [
            'class' => 'small text-muted'
        ], "Mostrando {$startCount} a {$endCount} de {$total} registros"));
        
        // Paginación
        $colNav = Html::tag('div', ['class' => 'col-sm-12 col-md-7 d-flex justify-content-md-end justify-content-center']);
        $nav = Html::tag('nav', ['aria-label' => 'Paginación de tabla']);
        $ul = Html::tag('ul', [
            'class' => 'pagination pagination-sm mb-0'
        ]);
        
        if ($totalPages > 1) {
            // Anterior
            $prevLi = Html::tag('li', ['class' => 'page-item ' . ($page <= 1 ? 'disabled' : '')]);
            $prevParams = $_GET;
            $prevParams['page'] = $page > 1 ? $page - 1 : 1;
            $prevA = Html::tag('a', [
                'class' => 'page-link',
                'href' => '?' . http_build_query($prevParams)
            ], '«');
            if ($page <= 1) {
                $prevA->setAttribute('tabindex', '-1');
                $prevA->setAttribute('aria-disabled', 'true');
            }
            $prevLi->content($prevA);
            $ul->addChild($prevLi);
            
            // Numeros de pagina
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);
            
            if ($startPage > 1) {
                $ul->addChild($this->createPageItem(1, $page));
                if ($startPage > 2) {
                    $ul->addChild($this->createEllipsisItem());
                }
            }
            
            for ($i = $startPage; $i <= $endPage; $i++) {
                $ul->addChild($this->createPageItem($i, $page));
            }
            
            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    $ul->addChild($this->createEllipsisItem());
                }
                $ul->addChild($this->createPageItem($totalPages, $page));
            }
            
            // Siguiente
            $nextLi = Html::tag('li', ['class' => 'page-item ' . ($page >= $totalPages ? 'disabled' : '')]);
            $nextParams = $_GET;
            $nextParams['page'] = $page < $totalPages ? $page + 1 : $totalPages;
            $nextA = Html::tag('a', [
                'class' => 'page-link',
                'href' => '?' . http_build_query($nextParams)
            ], '»');
            if ($page >= $totalPages) {
                $nextA->setAttribute('tabindex', '-1');
                $nextA->setAttribute('aria-disabled', 'true');
            }
            $nextLi->content($nextA);
            $ul->addChild($nextLi);
        }
        
        $nav->content($ul);
        $colNav->content($nav);
        
        $row->content([$colInfo, $colNav]);
        return $row;
    }

    private function createPageItem(int $targetPage, int $currentPage): TagInterface
    {
        $li = Html::tag('li', ['class' => 'page-item ' . ($targetPage === $currentPage ? 'active' : '')]);
        $params = $_GET;
        $params['page'] = $targetPage;
        $a = Html::tag('a', [
            'class' => 'page-link',
            'href' => '?' . http_build_query($params)
        ], (string)$targetPage);
        $li->content($a);
        return $li;
    }

    private function createEllipsisItem(): TagInterface
    {
        $li = Html::tag('li', ['class' => 'page-item disabled']);
        $span = Html::tag('span', ['class' => 'page-link'], '...');
        $li->content($span);
        return $li;
    }
}

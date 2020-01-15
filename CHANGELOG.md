# Changelog

All notable changes to this project will be documented in this file.

## [2.0.0] - 2025-05-20

### Changed
- **BREAKING CHANGE**: All Bootstrap components now accept a single `array $options` in their constructor instead of positional parameters. This unifies the initialization pattern across the entire library.
- **BREAKING CHANGE**: `Bootstrap` facade methods now strictly act as bypasses to their respective component constructors, accepting only `array $options`.
- **Infrastructure**: Introduced `Higgs\Frontend\Contracts\ComponentInterface` which all components must implement.
- **Architectural Standard**: Defined strict `COMPONENT_STANDARDS.md` for consistent component development.

### Refactored Components
- **Interface**: Accordion, Alert, Badge, Button, ButtonGroup, Card, CardGroup, Carousel, Collapse, Dropdown, ListGroup, Modal, Offcanvas, Popover, Progress, Spinner, Toast, Tooltip.
- **Form**: Check, File, Form, FormControl, Input, InputGroup, Radio, Select, Textarea.
- **Navigation**: Breadcrumb, Nav, Navbar, Pagination.
- **Layout**: Col, Container, Grid, Row.
- **Content**: Figure, Image, Table, Typography.

### Added
- `Bootstrap::image(array $options)` method.
- `Bootstrap::offcanvas(array $options)` method.
- `Bootstrap::popover(array $options)` method.
- `Bootstrap::tooltip(array $options)` method.
- New components: `Offcanvas`, `Popover`, `Tooltip`, `Check`, `File`, `Form`, `FormControl`, `Input`, `InputGroup`, `Radio`, `Select`, `Textarea`, `Breadcrumb`, `Nav`, `Navbar`, `Pagination`, `Col`, `Container`, `Grid`, `Row`, `Figure`, `Image`, `Table`, `Typography`.

## [1.0.9] - 2025-05-20

### Fixed
- Fixed critical bug in `Bootstrap::card()` where parameters were not being correctly passed to the `Card` constructor due to the legacy method signature.

## [1.0.8] - 2025-05-20

### Fixed
- Refactor of `Card` component to fix logic in `render()` preventing title display.

## [1.0.7] - 2025-05-20

### Changed
- Improved `Card` header logic to support buttons and custom classes.
- Updated `Card` constructor to accept array options for header configuration.

## [1.0.6] - 2025-05-20

### Added
- Initial implementation of `Card` component.
- Basic `Bootstrap` facade.

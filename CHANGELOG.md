# Changelog

All notable changes to Kashiwazaki SEO Link Weaver will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.1] - 2025-10-07

### Added
- `idonly="on"` parameter for outputting only data attributes (also supports "1" for compatibility)
- Support for custom HTML elements with link functionality

### Improved
- Removed debug comments and console output from JavaScript
- Updated documentation (README.md, readme.txt, admin panel usage guide)
- Cleaned up codebase for production use

### Changed
- Made `text` attribute optional when using `idonly="on"`

## [1.0.0] - 2025-09-25

### Added
- Initial release of Kashiwazaki SEO Link Weaver plugin
- `[kswl_link]` shortcode implementation for JavaScript-driven links
- Two default design presets: text style and button style
- Custom CSS class support for complete design control
- URL obfuscation feature using Base64 encoding
- Target attribute support (_blank, _self)
- Comprehensive admin settings page
- Settings link in plugins list page
- User-friendly usage guide in admin panel
- Support for multiple links on the same page
- Data attribute based link management
- Footer JavaScript for click handling

### Features
- WordPress 5.0+ compatibility
- PHP 7.2+ compatibility
- Responsive design support
- Translation ready (textdomain: kashiwazaki-seo-link-weaver)
- Clean uninstall (settings preserved on deactivation)

### Security
- Direct file access prevention
- Proper data sanitization and escaping
- Nonce verification for settings

### Developer
- Created by Tsuyoshi Kashiwazaki
- Website: https://www.tsuyoshikashiwazaki.jp/
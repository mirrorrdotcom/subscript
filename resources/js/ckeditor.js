/**
 * The CSS selector to look for when initializing editors.
 * @type {string}
 */
const EDITOR_SELECTOR = "textarea.__editor";

/**
 * Initialize all editors.
 */
document.querySelectorAll(EDITOR_SELECTOR)
    .forEach(editor => { CKEDITOR.replace(editor.name); });

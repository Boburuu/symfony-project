import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
import AutoformatPlugin from '@ckeditor/ckeditor5-autoformat/src/autoformat';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline';
import Code from '@ckeditor/ckeditor5-basic-styles/src/code';
import BlockQuotePlugin from '@ckeditor/ckeditor5-block-quote/src/blockquote';
import HeadingPlugin from '@ckeditor/ckeditor5-heading/src/heading';
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link';
import ListPlugin from '@ckeditor/ckeditor5-list/src/list';
import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import FindAndReplace from '@ckeditor/ckeditor5-find-and-replace/src/findandreplace';
import Font from '@ckeditor/ckeditor5-font/src/font';
import Indent from '@ckeditor/ckeditor5-indent/src/indent';
import IndentBlock from '@ckeditor/ckeditor5-indent/src/indentblock';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import HtmlEmbed from '@ckeditor/ckeditor5-html-embed/src/htmlembed';
import CodeBlock from '@ckeditor/ckeditor5-code-block/src/codeblock';
import ListProperties from '@ckeditor/ckeditor5-list/src/listproperties';
import HorizontalLine from '@ckeditor/ckeditor5-horizontal-line/src/horizontalline';
import SourceEditing from '@ckeditor/ckeditor5-source-editing/src/sourceediting';

const form = document.querySelector('form[name="article"]');

if (form) {
    let editorInput = form.querySelector('#ckeditor');

    ClassicEditor
        .create(editorInput, {
            plugins: [
                EssentialsPlugin, AutoformatPlugin, Bold, Italic, Underline, Code,
                Font, Alignment, Indent, IndentBlock, BlockQuotePlugin, HeadingPlugin,
                LinkPlugin, ListPlugin, ParagraphPlugin, FindAndReplace, HtmlEmbed,
                CodeBlock, ListProperties, HorizontalLine, SourceEditing
            ],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'link', 'code', '|',
                    'numberedList', 'bulletedList', '|',
                    'outdent', 'indent', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'alignment', '|',
                    'htmlEmbed', 'codeBlock', '|',
                    'horizontalLine', '|',
                    'findAndReplace', 'selectAll', '|',
                    'blockQuote',
                    '|', 'sourceEditing', '|',
                    'undo',
                    'redo'
                ],
                // Ne va pas ?? la ligne si plus d'itemps mais affiche des ...
                shouldNotGroupWhenFull: false,
            },
            // Configure le plugin de titres
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                ]
            },
            list: {
                properties: {
                    styles: true,
                    // startIndex: true,
                    // reversed: true
                }
            },
            // Pour afficher l'aper??u
            htmlEmbed: {
                showPreviews: true
            },
            codeBlock: {
                languages: [
                    { language: 'plaintext', label: 'Plain text', class: '' },

                    // Use the "php-code" class for PHP code blocks.
                    { language: 'php', label: 'PHP', class: 'php-code' },

                    { langague: 'twig', label: 'Twig', class: 'code-language-twig', forceValue: true },

                    { language: 'yaml', label: 'YAML', class: 'lang-yaml' },

                    { language: 'bash', label: 'Bash', class: 'bash' },

                    // Use the "js" class for JavaScript code blocks.
                    // Note that only the first ("js") class will determine the language of the block when loading data.
                    { language: 'javascript', label: 'JavaScript', class: 'js javascript js-code' },

                    { langague: 'html', label: 'HTML', class: 'html' },

                    { langague: 'css', label: 'CSS', class: 'css' },

                    // Python code blocks will have the default "language-python" CSS class.
                    { language: 'python', label: 'Python' }
                ]
            }
        })
        // Promesse : D??s que la fonction ci-dessus est ex??cut??e, faire ce qui suit en cas d'erreur (r??cup??re ce que la fonction a fait):
        .then(editor=>{
            // Rattache l'??diteur ?? la fen??tre pour ??viter les pbs de compatibilit?? des navigateurs
            window.editor=editor;

            // Si form soumis tel que, ne sera pas envoy?? en BDD car ce n'est pas l'imput content.
            // Tout le contenu de la div sera inject?? directement dans l'input content
            form.addEventListener('submit', (element)=>{
                // "prevent default" casse l'utilisation native d'un ??l??ment
                // Ici le formulaire ne sera donc jamais soumis :
                element.preventDefault();
                let editorData = editor.data.get();
                let input = form.querySelector('#article_content');

                input.value = editorData;

                form.submit();
            })
        })
        .catch(error => {
            console.error(error);
        });
}
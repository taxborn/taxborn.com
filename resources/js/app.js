import 'alpinejs';
require('./bootstrap');

const hljs = require('highlight.js');
window.hljs = hljs;
require('highlightjs-line-numbers.js')

window.hljs.highlightAll()
window.hljs.initLineNumbersOnLoad()

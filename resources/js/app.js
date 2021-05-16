import 'alpinejs';
require('./bootstrap');

const hljs = require('highlight.js');
window.hljs = hljs;
require('highlightjs-line-numbers.js')

hljs.highlightAll();
hljs.initLineNumbersOnLoad();

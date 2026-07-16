const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(function(file) {
        file = dir + '/' + file;
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) { 
            results = results.concat(walk(file));
        } else { 
            if(file.endsWith('.blade.php')) results.push(file);
        }
    });
    return results;
}

const files = walk('resources/views');
files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    let original = content;

    // 1. Replace <script> with <script type="module">
    content = content.replace(/<script(?!\s+type="module\b)[^>]*>/g, (match) => {
        if(match.includes('src=')) return match; // skip external scripts just in case
        return match.replace('<script', '<script type="module"');
    });

    // 2. Replace panel with card
    content = content.replace(/panel-default/g, 'card bg-light');
    content = content.replace(/panel-heading/g, 'card-header');
    content = content.replace(/panel-body/g, 'card-body');
    content = content.replace(/panel-footer/g, 'card-footer');
    content = content.replace(/panel-title/g, 'card-title');
    content = content.replace(/class="([^"]*)panel([^"]*)"/g, (match, p1, p2) => {
        return `class="${p1}card${p2}"`;
    });

    // 3. Replace data-toggle, data-target, data-dismiss
    content = content.replace(/data-toggle=/g, 'data-bs-toggle=');
    content = content.replace(/data-target=/g, 'data-bs-target=');
    content = content.replace(/data-dismiss=/g, 'data-bs-dismiss=');

    if (content !== original) {
        fs.writeFileSync(file, content, 'utf8');
        console.log('Updated: ' + file);
    }
});
console.log('Done replacing blade templates.');

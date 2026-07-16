const fs = require('fs');

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

    content = content.replace(/btn-default/g, 'btn-secondary');
    content = content.replace(/pull-right/g, 'float-end');
    content = content.replace(/pull-left/g, 'float-start');
    content = content.replace(/text-right/g, 'text-end');
    content = content.replace(/text-left/g, 'text-start');

    if (content !== original) {
        fs.writeFileSync(file, content, 'utf8');
        console.log('Updated: ' + file);
    }
});
console.log('Done replacing common BS3/4 classes.');

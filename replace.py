import re

file_path = 'resources/views/users/tree.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

pattern = r'<span class="label">\{\{\s*link_to_route\(\'users\.tree\',\s*\$([a-zA-Z0-9_]+)->name,\s*\[\$([a-zA-Z0-9_]+)->id\],\s*\[\'title\'\s*=>\s*\$([a-zA-Z0-9_]+)->name\.\'\s*\(\'\.\$([a-zA-Z0-9_]+)->gender\.\'\)\'\]\)\s*\}\}</span>'

# Test pattern logic
def replace_func(match):
    var = match.group(1)
    return f"@include('users.partials.tree-node', ['userNode' => ${var}])"

new_content = re.sub(pattern, replace_func, content)

with open(file_path, 'w') as f:
    f.write(new_content)
